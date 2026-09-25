<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display batches.
     */
    public function index()
    {
        $batches = Batch::with([
            'course',
            'trainer'
        ])
        ->withCount('students')
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.batches.index',
            compact('batches')
        );
    }

    /**
     * Create batch.
     */
    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $trainers = Trainer::where('status', true)
            ->orderBy('name')
            ->get();

        $students = Student::with('user')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'super-admin.batches.create',
            compact(
                'courses',
                'trainers',
                'students'
            )
        );
    }

    /**
     * Store batch.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'course_id' =>
                'required|exists:courses,id',

            'trainer_id' =>
                'nullable|exists:trainers,id',

            'name' =>
                'required|string|max:255',

            'batch_code' =>
                'required|string|max:100|unique:batches,batch_code',

            'start_date' =>
                'required|date',

            'end_date' =>
                'nullable|date|after_or_equal:start_date',

            'start_time' =>
                'nullable|date_format:H:i',

            'end_time' =>
                'nullable|date_format:H:i|after:start_time',

            'training_mode' =>
                'required|in:online,offline,hybrid',

            'capacity' =>
                'required|integer|min:1|max:10000',

            'room' =>
                'nullable|string|max:255',

            'meeting_link' =>
                'nullable|url|max:2048',

            'description' =>
                'nullable|string',

            'status' =>
                'required|in:upcoming,ongoing,completed,cancelled',

            'students' =>
                'nullable|array',

            'students.*' =>
                'exists:students,id',
        ]);

        DB::transaction(function () use (
            $validated
        ) {

            $batch = Batch::create([
                'course_id' =>
                    $validated['course_id'],

                'trainer_id' =>
                    $validated['trainer_id'] ?? null,

                'name' =>
                    $validated['name'],

                'batch_code' =>
                    $validated['batch_code'],

                'start_date' =>
                    $validated['start_date'],

                'end_date' =>
                    $validated['end_date'] ?? null,

                'start_time' =>
                    $validated['start_time'] ?? null,

                'end_time' =>
                    $validated['end_time'] ?? null,

                'training_mode' =>
                    $validated['training_mode'],

                'capacity' =>
                    $validated['capacity'],

                'room' =>
                    $validated['room'] ?? null,

                'meeting_link' =>
                    $validated['meeting_link'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'status' =>
                    $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Students
            |--------------------------------------------------------------------------
            */

            $studentIds = $validated['students'] ?? [];

            if (count($studentIds) > $batch->capacity) {
                abort(
                    422,
                    'Selected students exceed batch capacity.'
                );
            }

            $enrollments = [];

            foreach ($studentIds as $studentId) {

                $enrollments[$studentId] = [
                    'enrolled_at' => now()->toDateString(),
                    'status' => 'active',
                ];
            }

            if (!empty($enrollments)) {
                $batch->students()->sync(
                    $enrollments
                );
            }
        });

        return redirect()
            ->route('super-admin.batches.index')
            ->with(
                'success',
                'Batch created successfully.'
            );
    }

    /**
     * Edit batch.
     */
    public function edit(Batch $batch)
    {
        $batch->load([
            'course',
            'trainer',
            'students'
        ]);

        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $trainers = Trainer::where('status', true)
            ->orderBy('name')
            ->get();

        $students = Student::with('user')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        $batchStudentIds = $batch
            ->students
            ->pluck('id')
            ->toArray();

        return view(
            'super-admin.batches.edit',
            compact(
                'batch',
                'courses',
                'trainers',
                'students',
                'batchStudentIds'
            )
        );
    }

    /**
     * Update batch.
     */
    public function update(
        Request $request,
        Batch $batch
    ) {
        $validated = $request->validate([

            'course_id' =>
                'required|exists:courses,id',

            'trainer_id' =>
                'nullable|exists:trainers,id',

            'name' =>
                'required|string|max:255',

            'batch_code' =>
                'required|string|max:100|unique:batches,batch_code,' .
                $batch->id,

            'start_date' =>
                'required|date',

            'end_date' =>
                'nullable|date|after_or_equal:start_date',

            'start_time' =>
                'nullable|date_format:H:i',

            'end_time' =>
                'nullable|date_format:H:i|after:start_time',

            'training_mode' =>
                'required|in:online,offline,hybrid',

            'capacity' =>
                'required|integer|min:1|max:10000',

            'room' =>
                'nullable|string|max:255',

            'meeting_link' =>
                'nullable|url|max:2048',

            'description' =>
                'nullable|string',

            'status' =>
                'required|in:upcoming,ongoing,completed,cancelled',

            'students' =>
                'nullable|array',

            'students.*' =>
                'exists:students,id',
        ]);

        $studentIds = $validated['students'] ?? [];

        if (count($studentIds) > $validated['capacity']) {

            return back()
                ->withInput()
                ->withErrors([
                    'students' =>
                        'Selected students exceed batch capacity.'
                ]);
        }

        DB::transaction(function () use (
            $validated,
            $studentIds,
            $batch
        ) {

            $batch->update([

                'course_id' =>
                    $validated['course_id'],

                'trainer_id' =>
                    $validated['trainer_id'] ?? null,

                'name' =>
                    $validated['name'],

                'batch_code' =>
                    $validated['batch_code'],

                'start_date' =>
                    $validated['start_date'],

                'end_date' =>
                    $validated['end_date'] ?? null,

                'start_time' =>
                    $validated['start_time'] ?? null,

                'end_time' =>
                    $validated['end_time'] ?? null,

                'training_mode' =>
                    $validated['training_mode'],

                'capacity' =>
                    $validated['capacity'],

                'room' =>
                    $validated['room'] ?? null,

                'meeting_link' =>
                    $validated['meeting_link'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'status' =>
                    $validated['status'],
            ]);

            $enrollments = [];

            foreach ($studentIds as $studentId) {

                $enrollments[$studentId] = [
                    'enrolled_at' =>
                        now()->toDateString(),

                    'status' =>
                        'active',
                ];
            }

            $batch->students()->sync(
                $enrollments
            );
        });

        return redirect()
            ->route('super-admin.batches.index')
            ->with(
                'success',
                'Batch updated successfully.'
            );
    }

    /**
     * Delete batch.
     */
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return redirect()
            ->route('super-admin.batches.index')
            ->with(
                'success',
                'Batch deleted successfully.'
            );
    }
}

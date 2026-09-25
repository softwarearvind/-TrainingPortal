<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\OnlineTest;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OnlineTestController extends Controller
{
    public function index()
    {
        $tests = OnlineTest::with([
            'course',
            'batch'
        ])
        ->withCount('questions')
        ->latest()
        ->paginate(10);

        return view(
            'super-admin.online-tests.index',
            compact('tests')
        );
    }

    public function create()
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.online-tests.create',
            compact('courses', 'batches')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'batch_id' => [
                'required',
                'exists:batches,id'
            ],

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'instructions' => [
                'nullable',
                'string'
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'min:1',
                'max:1440'
            ],

            'passing_marks' => [
                'required',
                'numeric',
                'min:0'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'status' => [
                'required',
                'in:draft,published,closed'
            ],
        ]);

        $data['slug'] = $this->generateUniqueSlug(
            $data['title']
        );

        $data['total_marks'] = 0;

        OnlineTest::create($data);

        return redirect()
            ->route('super-admin.online-tests.index')
            ->with(
                'success',
                'Online test created successfully.'
            );
    }

    public function show(OnlineTest $onlineTest)
    {
        $onlineTest->load([
            'course',
            'batch',
            'questions'
        ]);

        return view(
            'super-admin.online-tests.show',
            compact('onlineTest')
        );
    }

    public function edit(OnlineTest $onlineTest)
    {
        $courses = Course::where('status', true)
            ->orderBy('name')
            ->get();

        $batches = Batch::with('course')
            ->where('status', '!=', 'completed')
            ->orderBy('name')
            ->get();

        return view(
            'super-admin.online-tests.edit',
            compact(
                'onlineTest',
                'courses',
                'batches'
            )
        );
    }

    public function update(
        Request $request,
        OnlineTest $onlineTest
    ) {
        $data = $request->validate([

            'course_id' => [
                'required',
                'exists:courses,id'
            ],

            'batch_id' => [
                'required',
                'exists:batches,id'
            ],

            'title' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'instructions' => [
                'nullable',
                'string'
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'min:1',
                'max:1440'
            ],

            'passing_marks' => [
                'required',
                'numeric',
                'min:0'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],

            'status' => [
                'required',
                'in:draft,published,closed'
            ],
        ]);

        $onlineTest->update($data);

        $onlineTest->update([
            'total_marks' => $onlineTest
                ->questions()
                ->sum('marks')
        ]);

        return redirect()
            ->route('super-admin.online-tests.index')
            ->with(
                'success',
                'Online test updated successfully.'
            );
    }

    public function destroy(OnlineTest $onlineTest)
    {
        $onlineTest->delete();

        return back()->with(
            'success',
            'Online test deleted successfully.'
        );
    }

    public function toggleStatus(OnlineTest $onlineTest)
    {
        $nextStatus = match ($onlineTest->status) {
            'draft' => 'published',
            'published' => 'closed',
            default => 'draft',
        };

        $onlineTest->update([
            'status' => $nextStatus
        ]);

        return back()->with(
            'success',
            'Test status changed successfully.'
        );
    }

    private function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);

        $original = $slug;

        $count = 1;

        while (
            OnlineTest::where('slug', $slug)->exists()
        ) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

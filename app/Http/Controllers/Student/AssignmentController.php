<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        // Student ke assigned courses
        $courseIds = $student->courses()
            ->pluck('courses.id');

        // Student ke assigned batches
        $batchIds = $student->batches()
            ->pluck('batches.id');

        $assignments = Assignment::with([
                'course',
                'batch'
            ])
            ->where('status', 'published')
            ->where(function ($query) use ($courseIds, $batchIds) {

                $query->whereIn('course_id', $courseIds)
                      ->orWhereIn('batch_id', $batchIds);

            })
            ->latest()
            ->paginate(10);

        return view(
            'student.assignments.index',
            compact(
                'user',
                'student',
                'assignments'
            )
        );
    }
}

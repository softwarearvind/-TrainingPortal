<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $courses = $student->courses()
            ->where('courses.status', true)
            ->with('category')
            ->latest('courses.id')
            ->paginate(9);

        return view(
            'student.courses.index',
            compact(
                'user',
                'student',
                'courses'
            )
        );
    }
}

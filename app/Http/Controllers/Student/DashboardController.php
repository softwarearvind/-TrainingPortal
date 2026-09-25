<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $student->load([
            'batches.course',
            'courses.videos',
            'certificates.course',
        ]);

        $batches = $student->batches;

        $courses = $student->courses;

        $certificates = $student->certificates;

        // Student ke enrolled courses ke videos
        $videos = $courses
            ->pluck('videos')
            ->flatten()
            ->where('status', true)
            ->values();

        return view(
            'student.dashboard',
            compact(
                'user',
                'student',
                'batches',
                'courses',
                'videos',
                'certificates'
            )
        );
    }
}

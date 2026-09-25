<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
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

        // Sirf assigned courses ke materials
        $materials = StudyMaterial::with([
                'course'
            ])
            ->where('status', true)
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->paginate(12);

        return view(
            'student.materials.index',
            compact(
                'user',
                'student',
                'materials'
            )
        );
    }
}

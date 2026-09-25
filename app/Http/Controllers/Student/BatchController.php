<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            abort(403, 'Student profile not found.');
        }

        $batches = $student->batches()
            ->with([
                'course',
                'trainer'
            ])
            ->latest('batches.id')
            ->paginate(10);

        return view(
            'student.batches.index',
            compact(
                'user',
                'student',
                'batches'
            )
        );
    }
}

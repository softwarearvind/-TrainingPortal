<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $trainer = $user->trainer;

        if (!$trainer) {
            abort(403, 'Trainer profile not found.');
        }

        $trainer->load([
            'courses',
        ]);

        $courses = $trainer->courses;

        return view(
            'trainer.dashboard',
            compact(
                'user',
                'trainer',
                'courses'
            )
        );
    }
}

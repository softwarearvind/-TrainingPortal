<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('trainer.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            // Only Trainer can login
            if (!$user->hasRole('Trainer')) {

                Auth::guard('web')->logout();

                return back()
                    ->withErrors([
                        'email' => 'Only Trainer account can login here.',
                    ])
                    ->withInput($request->only('email'));
            }

            // Check account status
            if (!$user->status) {

                Auth::guard('web')->logout();

                return back()
                    ->withErrors([
                        'email' => 'Your account is inactive. Please contact administrator.',
                    ])
                    ->withInput($request->only('email'));
            }

             return redirect()->route('trainer.dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('trainer.login');
    }
}

<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('super-admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (
            Auth::guard('super_admin')
                ->attempt($credentials)
        ) {

            $request->session()->regenerate();

            $admin = Auth::guard('super_admin')->user();

            $admin->update([
                'last_login_at' => now(),
            ]);

            return redirect()->route(
                'super-admin.dashboard'
            );
        }

        return back()->withErrors([
            'email' => 'Invalid Super Admin credentials.',
        ]);
    }

    public function dashboard()
    {
         return view('super-admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('super_admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route(
            'super-admin.login'
        );
    }
}

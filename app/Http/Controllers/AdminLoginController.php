<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->isSuperAdmin() || Auth::user()->can_access_admin) {
                return redirect()->route('admin.dashboard'); 
            } else {
                Auth::logout();
                return redirect()->route('home')->with('error', 'Unauthorized Access.');
            }
        }

        return back()->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}

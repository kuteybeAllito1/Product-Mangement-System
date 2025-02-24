<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\Product;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at == null) {
                if ($request->filled('otp')) {
                    if (Auth::user()->verification_code == $request->otp) {
                        Auth::user()->email_verified_at = now();
                        Auth::user()->verification_code = null;
                        Auth::user()->save();

                        $products = Product::all();
                        return view('main.home', compact('products'));
                    } else {
                        Auth::logout(); 
                        return redirect()->route('login')
                            ->with('error', 'The code you entered is incorrect. Please try again.');
                    }
                } else {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Your account is not activated. Enter the verification code (OTP) in the field provided');
                }
            }

            $products = Product::all();
            return view('main.home', compact('products'));
        }

        return redirect()->route('login')
            ->with('error', 'Incorrect email or password!');
    }

}

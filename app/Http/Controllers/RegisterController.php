<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail; 
use Hash;
class RegisterController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        $otp = rand(100000, 999999); 
        $user->verification_code = $otp;
        if ($request->email === 'kuteybeallito20022002@gmail.com') {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }
        $user->save();

        Mail::to($user->email)->send(new VerificationMail($user));

        return redirect()->route('login')
                         ->with('success', 'Your account has been created successfully. We have sent you a verification code to your email.');
    }


    public function verifyEmail(Request $request)
{
    $email = $request->query('email');
    $code  = $request->query('code');
    
    $user = User::where('email', $email)
                ->where('verification_code', $code)
                ->first();

    if (!$user) {
        return redirect()->route('login')
                         ->with('error', 'Invalid verification code or user does not exist');
    }

    $user->email_verified_at = now();
    $user->verification_code = null;
    $user->save();

    return redirect()->route('login')->with('success', 'Your account has been activated successfully. You can log in now.');
}
}

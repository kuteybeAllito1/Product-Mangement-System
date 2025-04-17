<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
  public function showRequestForm()
  {
    return view('auth.passwords.email');
  }

  public function sendResetLink(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();
    if (!$user) {
      return back()->with('error', 'Email not found.');
    }

    $token = Str::random(64);

    DB::table('password_reset_tokens')->updateOrInsert(
      ['email' => $request->email],
      [
        'token' => $token,
        'created_at' => now()
      ]
    );

    $resetLink = url("/password/reset/{$token}?email=" . urlencode($request->email));
    Mail::raw("Click here to reset your password: {$resetLink}", function ($message) use ($request) {
      $message->to($request->email)
        ->subject('Password Reset');
    });

    return back()->with('success', 'We have emailed your password reset link!');
  }

  public function showResetForm(Request $request, $token)
  {
    $email = $request->query('email');
    return view('auth.passwords.reset', compact('token', 'email'));
  }
  public function updatePassword(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'token' => 'required',
      'password' => 'required|confirmed|min:6',
    ]);
    $record = DB::table('password_reset_tokens')
      ->where('email', $request->email)
      ->where('token', $request->token)
      ->first();
    if (!$record) {
      return back()->with('error', 'Invalid token!');
    }
    $user = User::where('email', $request->email)->first();
    if (!$user) {
      return back()->with('error', 'Email not found.');
    }
    $user->password = Hash::make($request->password);
    $user->save();
    DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    return redirect()->route('login')->with('success', 'Your password has been reset!');
  }
}

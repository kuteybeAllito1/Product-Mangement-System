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
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $products = Product::all();
        return view('main.home', compact('products'));
    }

    return redirect()->route('login')->with('error', 'E-posta veya şifre hatalı! Lütfen tekrar deneyin.');;
}

}

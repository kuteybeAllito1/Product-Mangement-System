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
        // التحقق من المدخلات الأساسية
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            // تحقق هل مفعل سابقًا
            if (Auth::user()->email_verified_at == null) {
                // المستخدم غير مفعّل
                // تحقق هل أدخل الكود في الطلب الحالي
                if ($request->filled('otp')) {
                    // هل الكود صحيح؟
                    if (Auth::user()->verification_code == $request->otp) {
                        // في حال صحيح → نفعل الحساب
                        Auth::user()->email_verified_at = now();
                        // ممكن نضع null لحقل verification_code بعد التفعيل
                        Auth::user()->verification_code = null;
                        Auth::user()->save();

                        // والآن نستمر في تسجيل الدخول بشكل طبيعي
                        $products = Product::all();
                        return view('main.home', compact('products'));
                    } else {
                        // الكود خاطئ
                        Auth::logout(); // نخرجه من حالة الدخول
                        return redirect()->route('login')
                            ->with('error', 'The code you entered is incorrect. Please try again.');
                    }
                } else {
                    // المستخدم لم يُدخل OTP بعد
                    // نسجل خروج ثم نطلب منه إدخال الكود
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Your account is not activated. Enter the verification code (OTP) in the field provided');
                }
            }

            // إذا كان مفعلًا أصلًا
            $products = Product::all();
            return view('main.home', compact('products'));
        }

        // فشل التحقق من البريد/كلمة المرور
        return redirect()->route('login')
            ->with('error', 'Incorrect email or password!');
    }

}

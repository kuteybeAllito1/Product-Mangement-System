<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;  // مهم لاستدعاء الإرسال
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

        // إنشاء المستخدم
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        // توليد كود تحقق بدل sha1(time()) يمكننا استخدام rand() لـ OTP رقمي مثلاً:
        $otp = rand(100000, 999999); // 6 أرقام
        $user->verification_code = $otp;

        // لن نضبط email_verified_at لأنها لم تُفعل بعد
        $user->save();

        // إرسال رسالة التحقق
        Mail::to($user->email)->send(new VerificationMail($user));

        return redirect()->route('login')
                         ->with('success', 'Your account has been created successfully. We have sent you a verification code to your email.');
    }


    public function verifyEmail(Request $request)
{
    // نستقبل email و code من الرابط
    $email = $request->query('email');
    $code  = $request->query('code');
    
    // نبحث عن المستخدم بهذه المعطيات
    $user = User::where('email', $email)
                ->where('verification_code', $code)
                ->first();

    if (!$user) {
        return redirect()->route('login')
                         ->with('error', 'Invalid verification code or user does not exist');
    }

    // إذا وصلنا هنا، معناها المستخدم موجود والكود صحيح
    // نقوم بتحديث email_verified_at
    $user->email_verified_at = now();
    // بإمكاننا جعل verification_code فارغًا أو null بعد التفعيل
    $user->verification_code = null;
    $user->save();

    return redirect()->route('login')->with('success', 'Your account has been activated successfully. You can log in now.');
}
}

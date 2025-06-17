<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showform()
    {
        return view('client.login');
    }

    public function showformRegister()
    {
        return view('client.register');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $status = Auth::attempt(['email' => $email, 'password' => $password]);
        if ($status) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('index');
            }
        }
        return back()->with('msg', 'email không chính xác');
    }

    public function register(Request $request) 
    {
        $result = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($result) {
            return redirect()->back()->with('success', 'Đăng ký tài khoản thành công, hãy đăng nhập');
        }
    }

    public function forgot()
    {
        return view('client.forgot.forgot');
    }

    public function sendOtpEmail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if(!$user) {
            return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống');
        }
        $time = now()->format('YmdHis');
        $base_string = $time.Auth::id();
        $hash = crc32($base_string);
        $otp = str_pad(substr($hash, -6), 6, '0', STR_PAD_LEFT);

        $result = ForgotPassword::create([
            'email' => $email,
            'code' => $otp
        ]);

        if($result) {
            Mail::to($email)->send(new UserMail($otp));

            return view('client.forgot.verify-otp', compact('email'));
        }
    }

    public function verify_otp(Request $request)
    {
        if(!is_array($request->otp) || count($request->otp) !== 6 || !ctype_digit(implode('', $request->otp))) {
            return redirect()->back()->with('error', 'OTP không hợp lệ');
        }

        $email = $request->email;
        $otp = implode('', $request->otp);

        $confirm = ForgotPassword::where('email', $email)->orderBy('id','desc')->first();

        if($otp == $confirm->code) {
            return view('client.forgot.new-password', compact('email'));
        } else {
            return redirect()->back()->with('error', 'OTP không trùng khớp, hãy thử lại');
        }
    }

    public function resetPassword(Request $request)
    {
        if($request->password == $request->password_confirm) {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công, hãy đăng nhập');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu và xác nhận mật khẩu không trùng khớp, hãy thử lại');
        }
    }
}

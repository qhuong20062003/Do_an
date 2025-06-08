<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return redirect()->route('categories.index');
            } else {
                return redirect()->route('index');
            }
        }
        return back()->with('msg', 'email kh chinh xac');
    }

    public function register(Request $request) 
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Đăng ký tài khoản thành công, hãy đăng nhập');
    }
}

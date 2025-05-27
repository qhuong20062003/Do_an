<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    
    public function loginAdmin(){
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postLoginAdmin(Request $request){
        $remember = $request->has('remember_me')? true :false;
        if(auth()->attempt([
            'email'=>$request->email,
            'password' => $request->password
        ],$remember)){
            return redirect()->to('home');
        }
        dd('sai');
        // return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');

    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}

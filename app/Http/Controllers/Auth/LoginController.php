<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function showform(){
        return view('auth.login');
        
    }
    public function login(Request $request){
            $email = $request->email;
            $password = $request->password;
            $status = Auth::attempt(['email'=>$email, 'password'=>$password]);
            if($status){
                $user = Auth::user();
                $urlRedirect ="/customer/home";
                if($user->role=== 'admin'){
                    $urlRedirect ="/home";

                }
                return redirect($urlRedirect);
            }
            return back()->with('msg','email kh chinh xac');
        }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}

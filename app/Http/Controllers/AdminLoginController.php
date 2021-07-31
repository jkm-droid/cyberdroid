<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    //show the index page
    public function admin_show_login(){
        return view('admin.login');
    }

    public function admin_login(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $info = $request->all();

        $credentials = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(Auth::guard('admin')->attempt(array($credentials=>$info['username'], 'password'=>$info['password'], 'is_admin'=>1))){
            return redirect()->intended('dashboard')->with('success', 'logged in successfully');
        }

        return redirect()->route('admin.show.login')->with('error', 'Error, login details are incorrect');
    }

    public function admin_logout(Request $request){
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();

            return redirect()->route('admin.show.login')->with('success', 'Logged out successfully');

        }
    }
}

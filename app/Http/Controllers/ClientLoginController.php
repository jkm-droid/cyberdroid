<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ClientLoginController extends Controller{
    public function __construct(){
        $this->middleware('guest')->except('portal', 'dashboard', 'logout');
    }
    //show the index page
    public function show_login(){
        return view('user.login');
    }

    public function login(Request $request){

        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);

        $info = $request->all();

        $credentials = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(Auth::attempt(array($credentials=>$info['username'], 'password'=>$info['password'], 'is_verified'=>1))){
            return redirect()->intended('portal')->with('success', 'logged in successfully');
        }
        else if(Auth::attempt(array($credentials=>$info['username'], 'password'=>$info['password'], 'is_verified'=>0))){
            return redirect()->intended('setup')->with('success', 'logged in successfully');
        }

        return redirect()->route('show.login')->with('error', 'Error, login details are incorrect');
    }

    public function show_register()
    {
        return view('user.register');
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
        ]);

        $user_data = $request->all();
        $this->create($user_data);

        return redirect()->route('show.login')->with('success', 'Registered successfully, you can now login');
    }

    public function create(array $data){
        return User::create([
            'username'=>$data['username'],
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password'])
        ]);
    }

    public function logout(Request $request){
        if (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            $request->session()->invalidate();

            return redirect()->route('admin.show.login')->with('success', 'Logged out successfully');
        }else {
            Auth::logout();
            Session::flush();

            $request->session()->invalidate();
            return redirect()->route('show.login')->with('success', 'Logged out successfully');
        }
    }
}

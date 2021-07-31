<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function portal(){
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->is_verified == 1) {
                return view('portal.index')->with('user', $user);
            }else{
                return view('portal.setup')->with('user', $user);
            }
        }

        return redirect()->route('show.login')->with('error', 'Error, Access denied');
    }

    public function setup(){
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            if ($user->is_verified == 0) {
                return view('portal.setup')->with('user', $user);
            }else{
                return view('portal.index')->with('user', $user);
            }
        }

        return redirect()->route('show.login')->with('error', 'Error, Access denied');
    }
}

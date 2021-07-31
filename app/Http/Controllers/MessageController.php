<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $phone_numbers = Message::select('phone_number','contact_name', 'id')->groupBy('phone_number')->paginate(10);
        $names = Message::select('phone_number', 'id', 'contact_name')->groupBy('phone_number')->get();
        $contacts = DB::table('contacts')->get();

        foreach ($names as $name){
            foreach ($contacts as $contact){
                if ($name->phone_number == $contact->phone_number){
                    $message = Message::where('phone_number',$name->phone_number)->first();
                    $message->update(['contact_name'=>$contact->contact_name]);
                }
            }
        }

        return view('messages.index', compact('phone_numbers','names'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function get_conversation($phone_number){
        $conversations = Message::where('phone_number',$phone_number)->get();
        $title = Message::where('phone_number',$phone_number)->first();
        if ($title->contact_name == ''){
            $new_title = $phone_number;
        }else{
            $new_title = $title->contact_name;
        }

        return view('messages.conversation', compact('conversations'))->with('title', $new_title);
    }
}

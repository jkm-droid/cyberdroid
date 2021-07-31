<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $user = User::find(Auth::user()->id);

        return view('dashboard.admin')->with('user', $user);
    }

    public function users(){
        $users = User::latest()->paginate(10);

        return view('dashboard.users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function messages(){
        $messages = Message::select('device', 'id')->groupBy('device')->paginate(10);
        $messages_no = Message::select('device', 'id')->groupBy('device')->count();

        return view('dashboard.messages.index', compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('messages_no', $messages_no);
    }

    public function get_messages_by_device($device){
        $messages = Message::where('device', $device)->groupBy('phone_number')->paginate(20);
        $messages_no = Message::where('device', $device)->groupBy('phone_number');

//        dd($messages);
        $device = '';
        foreach ($messages as $msg){
            $device = $msg->device;
        }
        return view('dashboard.messages.show', compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device);
    }

    public function contacts(){
        $contacts = Contact::select('device', 'id')->groupBy('device')->paginate(10);
        $contact_no = Contact::select('device', 'id')->groupBy('device')->count();

        return view('dashboard.contacts.index', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('contact_no', $contact_no);
    }

    public function get_contacts_by_device($device){
        $contacts = Contact::where('device', $device)->latest()->paginate(20);
        $device = '';
        foreach ($contacts as $phone_number){
            $device = $phone_number->device;
        }
        return view('dashboard.contacts.show', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device);
    }
}

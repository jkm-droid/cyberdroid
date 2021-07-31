<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $phone_numbers = Contact::latest()->paginate(20);

        foreach ($phone_numbers as $phone_number){
            $device = $phone_number->device;
        }
        return view('contacts.index', compact('phone_numbers'))
            ->with('i', (request()->input('page', 1) - 1) * 10)
            ->with('device', $device);
    }

}

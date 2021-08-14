<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($spy_key){
        $images = Images::where('spy_key', $spy_key)->latest()->paginate(20);

        $device = "";
        foreach ($images as $image){
            $device = $image->device;
        }
        return view('portal.images.index', compact('images'))
            ->with('i', (request()->input('page', 1) - 1) * 20)
            ->with('device', $device);
    }
}

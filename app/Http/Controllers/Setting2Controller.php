<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get existing setting record
        $settings = Setting::all();
        dd($settings);
        return view('setting.index')->with($settings);
    }
    public function updateVideo(Request $request)
    {
        
    }


}

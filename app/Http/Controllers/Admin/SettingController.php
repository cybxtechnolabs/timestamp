<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $user = Auth::user();
        // if($user->user_type == 'admin') {
        //     $setting = Setting::find(1);
        //     return view('setting.index')->with(compact('setting'));
        // } else {
        //     return redirect('/');
        // }
    }

    public function edit()
    {
        $user = Auth::user();
        $Setting = Setting::find(1);
        //dd($Setting);
        return view('admin.setting.edit')->with(compact('Setting'));
    }

    public function update(Request $request, $id=1)  
    {  
        //validation
        $request->validate([  
            'multiple_record_time'=>'required|numeric',
            //'skip_mask'=>'required',
            'threshold_temperature'=>'required|numeric',
            'max_hours_per_day'=>'required|numeric',
        ]);
        $skip_mask = $request->skip_mask == 1 ? 1: 0;
        
        $user = Auth::user();
        $Setting = Setting::find(1);
        $Setting->multiple_record_time = $request->multiple_record_time;
        $Setting->skip_mask = $skip_mask;
        $Setting->threshold_temperature = $request->threshold_temperature;
        $Setting->max_hours_per_day = $request->max_hours_per_day;
        $Setting->save();

        //redirect to galleries list
        return redirect('admin/setting')->with('success', 'Record Successfully Updated!');
       // return view('gallery.index')->with('userGalleries', $Galleries);
        //return redirect('setting.edit')->with('success', 'Gallery Successfully Updated!');
    } 


}

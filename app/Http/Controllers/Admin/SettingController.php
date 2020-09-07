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
        $Setting = Setting::where('user_id', '=', $user->id)->first();
        //dd($Setting);
        if($Setting !== null) {
            return view('admin.setting.edit')->with(compact('Setting'));
        } else {
            return view('admin.setting.create');
        }
        
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
        $skip_unknown = $request->skip_unknown == 1 ? 1: 0;

        $user = Auth::user();
            //dd($skip_unknown);
        //check if user has settings if not create 
        //if user have settings then update

        $user_settings = Setting::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'user_id'   => Auth::user()->id,
        ],[
            'multiple_record_time' => $request->multiple_record_time,
            'skip_mask' => $skip_mask,
            'threshold_temperature' => $request->threshold_temperature,
            'skip_unknown' =>  $skip_unknown,
            'max_hours_per_day' => $request->max_hours_per_day,
        ]);

        //redirect to galleries list
        return redirect('setting')->with('success', 'Record Successfully Updated!');
       // return view('gallery.index')->with('userGalleries', $Galleries);
        //return redirect('setting.edit')->with('success', 'Gallery Successfully Updated!');
    } 


}

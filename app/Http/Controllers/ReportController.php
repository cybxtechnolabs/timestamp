<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Admin\Setting;
use App\Setting;

class ReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //pass the current user_id
        $user_id = Auth::user()->id;
        //get current settings
        $Setting = Setting::find(1);

        return view('report.index')->with('user_id', $user_id)->with('setting', $Setting);
    }

    public function generateReport() {
        //get current user id

        //get filters start date and end date
        //get settings available
        //get all records filter with settings(skip mask/temperature imported by current user)
        //set in and out time from data(max time to skip)
        //build proper array structure to display in table
        //return value

        dd('working..');
    }
}

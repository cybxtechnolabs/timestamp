<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $Admin = ($user->user_type == 'admin') ? 'Admin' : '';
            
      //  if($user->user_type == 'admin') {
           // $videoThumbnail = Setting::where('slug', 'video-thumbnail')->first();
            return view('dashboard')->with('Admin' , $Admin);
       // } else {
           // return redirect('/');
      //  }
    }
}

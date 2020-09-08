<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Setting;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $Admin = ($user->user_type == 'admin') ? 'Admin' : '';
       
        $users = User::latest()->paginate(10);
        return view('admin.users.index')->with('users', $users)->with('Admin', $Admin);
    }

    public function approve(Request $request, $user_id )
    {
        $request->validate([  
            //'name'=>'required',
        ]);

        $user = Auth::user();
        $User = User::find($user_id);
        $User->is_active = 1;
        $User->save();

        $Admin = ($user->user_type == 'admin') ? 'Admin' : '';
        $users = User::latest()->paginate(10);

        //also add default settings for this user
        $Settings = new Setting;
        $Settings->user_id = $user_id;
        $Settings->multiple_record_time = 3;
        $Settings->skip_mask = 1;
        $Settings->threshold_temperature = 100;
        $Settings->max_hours_per_day = 10;
        $Settings->skip_unknown = 1;

        return redirect('admin/users')->with('success', 'User been approved. Default settings also added for him.');
        
    }
}

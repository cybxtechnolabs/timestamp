<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.users.index')->with('users', $users)->with('Admin', $Admin)->with('success', 'User been approved');
        
    }
}

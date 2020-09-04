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
}

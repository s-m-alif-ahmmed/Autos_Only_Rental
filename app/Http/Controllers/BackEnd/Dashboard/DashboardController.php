<?php

namespace App\Http\Controllers\BackEnd\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function userProfile(){

        $role = Auth::user()->role;
        $user_name = Auth::user()->name;

        if($role == 'User')
        {
            return view('web.layouts.dashboard.dashboard',compact('user_name'));
        }
        else
        {
            return view('auth.login');
        }
    }

    public function dashboard(){

        $role = Auth::user()->role;
        $user_name = Auth::user()->name;

        if ($role == 'Admin')
        {
            return view('backend.layouts.dashboard.dashboard',compact('user_name'));
        }
        else
        {
            return view('auth.login');
        }
    }
}

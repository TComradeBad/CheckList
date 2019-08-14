<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminPage()
    {
        return view('adminPages.dominationpage');
    }

    public function userInfo()
    {
        return view("adminPages.usersinfo",["users" => User::all()]);
    }

    public function usersDelete()
    {
        return view("adminPages.deleteusers",["users" => User::all()]);
    }
}

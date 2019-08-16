<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is-auth');
        $this->middleware('is-banned');
    }

    public function myCheckLists(User $user)
    {
        return view("userPages.myCheckLists",["user"=>$user]);
    }
}

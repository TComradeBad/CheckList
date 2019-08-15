<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('is-auth');
        $this->middleware('is-banned');
        $this->middleware('is-admin');
    }

    public function adminPage()
    {
        return view('adminPages.dominationpage');
    }

    public function usersInfoView()
    {
        return view("adminPages.usersinfo", ["users" => User::all()]);
    }

    public function userInformationView(User $user)
    {

        return view('adminPages.userinformation', ['user' => $user]);
    }

    public function usersDeleteView()
    {
        return view("adminPages.deleteusers", ["users" => User::all()]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        if (!$user->hasAnyRole(["admin", "super-admin"])) {
            $user->delete();
            return redirect("/delete_users");
        } else {
            return abort(404);
        }

    }

    public function banUsersView()
    {
        return view("adminPages.setban", ["users" => User::all()]);
    }

    public function banUser(User $user)
    {
        if (!$user->hasAnyRole(["admin", "super-admin"])) {
            $user->setAttribute("banned", "1");
            $user->update();
            return redirect("/ban_users");
        } else {
            return abort(404);
        }
    }

    public function unbanUser(User $user)
    {
        $user->setAttribute("banned", "0");
        $user->update();
        return redirect("/ban_users");

    }

    public function setUsersRolesView()
    {
        return view("adminPages.setroles", ["users" => User::all()]);
    }
}

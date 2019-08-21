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
        return view("adminPages.setRoles", ["users" => User::all()]);
    }

    public function setUserRole(User $user)
    {
        return view("adminPages.userRolesSettings", ["user" => $user]);
    }

    public function setUserRolePost(Request $request, User $user)
    {
        switch ($request->input("role")) {
            case "user":
                $user->syncRoles('user');
                break;
            case "moderator":
                $user->syncRoles("moderator");
                break;
            case "admin":
                $user->syncRoles("admin");
                break;
        }

        return redirect("/set_user_role/" . $user->id);
    }

    public function setUsersCLCountView()
    {
        return view("adminPages.setCheckListCount", ["users" => User::all()]);
    }

    public function setUserCLCount(User $user)
    {
        return view("adminPages.setUserCLCount", ["user" => $user]);
    }

    public function setUserCLCountPost(Request $request, User $user)
    {
        $value1 = $request->input("max_cl");
        $value2 = $request->input("max_item");
        $user->setAttribute("max_check_lists_count", isset($value1) ? $value1 : 10);
        $user->setAttribute("max_check_list_items_count", isset($value2) ? $value2 : 10);
        $user->update();
        return redirect("/set_user_cl_count/" . $user->id);
    }
    public function viewUserCheckLists(User $user)
    {
        return view("adminPages.usersCheckLists",["check_lists" => $user->checkLists()->get()]);
    }
}

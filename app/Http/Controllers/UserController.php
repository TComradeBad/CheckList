<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\CheckListItem;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('is-auth');
        $this->middleware('is-banned');
    }

    public function myCheckLists()
    {
        return view("userPages.myCheckLists",
            [
                "user" => \Auth::user(),
                "checkLists" => \Auth::user()->checkLists()->get()
            ]);
    }

    public function addCheckListView()
    {
        return view("userPages.addCheckList", ["user" => \Auth::user()]);
    }

    public function addCheckListPost(Request $request, User $user)
    {
        $checkList = new CheckList();
        $checkList->setAttribute("name", $request->input("check_list_name"));
        $user->checkLists()->save($checkList);
        foreach ($request->input("items") as $item) {
            if (isset($item)) {
                $ckitems = new CheckListItem();
                $ckitems->setAttribute("name", $item);
                $checkList->items()->save($ckitems);
            }
        }

        return redirect('/my_checklists');

    }

    public function CheckListView(CheckList $ck_list)
    {
        if(\Auth::user()->id != $ck_list->user()->first()->id)
        {
            return abort(404);
        }else{
            return view("userPages.checkList",["checkList"=>$ck_list]);
        }
    }
    public function CheckListItemDonePost(CheckList $ck_list,CheckListItem $item)
    {

        $item->setAttribute("done",!$item->done);
        $item->update();
        return redirect("/check_list/".$ck_list->id);
    }
}

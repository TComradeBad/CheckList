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
        $user = \Auth::user();
        if ($user->checkLists()->count() == $user->max_check_lists_count) {
            return view("userPages.myCheckLists", [
                "user" => \Auth::user(),
                "checkLists" => \Auth::user()->checkLists()->get(),
                "error" => "Вы исчерпали лимит чеклистов"

            ]);
        }
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

    public function addCheckListPost(Request $request)
    {
        $user = \Auth::user();

        if ($user->checkLists()->count() >= $user->max_check_lists_count) {

            return redirect('/my_checklists');
        } else {
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

    }

    public function CheckListView(CheckList $ck_list)
    {
        if (\Auth::user()->id != $ck_list->user()->first()->id) {
            return abort(404);
        } else {
            return view("userPages.checkList", ["checkList" => $ck_list]);
        }
    }

    public function CheckListItemDonePost(CheckList $ck_list, CheckListItem $item)
    {
        $item->setAttribute("done", !$item->done);
        $item->update();
        if ($ck_list->items()->where("done", 0)->count() == 0) {
            $ck_list->setAttribute("done", 1);
            $ck_list->update();
        }else
        {
            $ck_list->setAttribute("done", 0);
            $ck_list->update();
        }
        return redirect("/check_list/" . $ck_list->id);
    }

    /**
     * @param CheckList $checkList
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     * @throws \Exception
     */
    public function CheckListDeletePost(CheckList $checkList)
    {
        if ($checkList->user()->first()->id != \Auth::user()->id) {
            return abort(404);
        } else {
            $checkList->delete();
            return redirect("/my_checklists");
        }

    }
}

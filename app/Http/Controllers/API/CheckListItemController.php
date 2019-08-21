<?php

namespace App\Http\Controllers\API;

use App\CheckList;
use App\CheckListItem;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CheckListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach (\Auth::user()->checkLists()->get() as $checkList) {
            $items [] = $checkList->items()->get();
        }
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->json()->get("user_id");
        $checkListId = $request->json()->get("check_list_id");
        $checkListItem = User::findOrFail($user_id)->checkLists()->findOrFail($checkListId)->items()->create($request->json()->all());
        return response()->json($checkListItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items  = \Auth::user()->checkLists()->findOrFail($id)->items()->get();


        return response()->json($items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = $request->json()->get("user_id");
        $checkListId = $request->json()->get("check_list_id");
        $checkListItem = User::findOrFail($user_id)->checkLists()->findOrFail($checkListId)->items()->findOrFail($id);
        $checkListItem->update($request->json()->all());
        return response()->json($checkListItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (CheckListItem::findOrFail($id)->delete()) {
            return response()->json(null, 204);
        }
    }
}

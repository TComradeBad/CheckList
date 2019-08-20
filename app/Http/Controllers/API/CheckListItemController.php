<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\CheckListItem;
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
        return response()->json(CheckListItem::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkListId = $request->json()->get("check_list_id");
        $checkListItem = CheckList::findOrFail($checkListId)->items()->create($request->json()->all());
        return response()->json($checkListItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(CheckListItem::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $checkListId = $request->json()->get("check_list_id");
        $checkListItem = CheckList::findOrFail($checkListId)->items()->findOrFail($id);
        $checkListItem->update($request->json()->all());
        return response()->json($checkListItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id     *
     * @throws \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CheckListItem::findOrFail($id)->delete())
        {
            return response()->json(null,204);
        }
    }
}

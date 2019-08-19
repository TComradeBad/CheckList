<?php

namespace App\Http\Controllers;

use App\CheckList;
use App\CheckListItem;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Translation\Extractor\ChainExtractor;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CheckList::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->json()->get("user_id");
        $checkList = User::findOrFail($id)->checkLists()->create($request->all());
        file_put_contents(__DIR__."/logs.txt",$id);
        return response()->json($checkList);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(CheckList::findOrFail($id));
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
        $checkList = User::findOrFail($user_id)->checkLists()->findOrFail($id);
        $checkList->update($request->json()->all());
        return response()->json($checkList);
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
        if(CheckList::findOrFail($id)->delete())
        {
            return response()->json(null,204);
        }

    }
}

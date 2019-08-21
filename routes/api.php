<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group(["middleware" => "auth:api"], function () {
    Route::get("/logout", "API\RegisterController@logout");

    /**
     * CheckList Routes
     */

    Route::get("/check_list", "API\CheckListController@index");

    Route::get("/check_list/{id}", "API\CheckListController@show");

    Route::post("/check_list", "API\CheckListController@store")->middleware(["put-auth-id-to-json","count-checkLists","count-check-lists-items"]);

    Route::post("/check_list/{id}", "API\CheckListController@update")->middleware("put-auth-id-to-json");

    Route::delete("/check_list/{id}", "API\CheckListController@destroy")->middleware("put-auth-id-to-json");


    /**
     * CheckListItem Routes
     */

    Route::get("/check_list_item", "API\CheckListItemController@index");

    Route::get("/check_list_item/{id}", "API\CheckListItemController@show");

    Route::post("/check_list_item", "API\CheckListItemController@store")->middleware(["put-auth-id-to-json","count-check-lists-items"]);

    Route::post("/check_list_item/{id}", "API\CheckListItemController@update")->middleware("put-auth-id-to-json");

    Route::delete("/check_list_item/{id}", "API\CheckListItemController@destroy")->middleware("put-auth-id-to-json");


});

/**
 * Register, login Routes
 */
Route::post("/register", "API\RegisterController@register");

Route::post("/login", "API\RegisterController@login");

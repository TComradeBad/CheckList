<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mainpage');
})->middleware('is-banned');

Auth::routes();

Route::get('/you_are_banned',function (){
    if(!Auth::user()->banned){
return abort(404);
    }else return view("banpage");
})->middleware('is-auth');

/**
 * Admin Routes
 */
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin_page', 'AdminController@adminPage')->middleware('is-admin');

Route::get('/users_info', 'AdminController@usersInfoView')->middleware('view-users-info');

Route::get('/user_info/{user}', 'AdminController@userInformationView')->middleware('view-users-info')
    ->where('user', '[0-9]+');

Route::get('/delete_users', 'AdminController@usersDeleteView')->middleware('delete-users');

Route::post('/delete_user/{user}', 'AdminController@deleteUser')->middleware('delete-users')
    ->where('user', '[0-9]+');

Route::get('/ban_users', 'AdminController@banUsersView')->middleware('ban-users');

Route::post('/ban_user/{user}', 'AdminController@banUser')->middleware('ban-users')
    ->where('user', '[0-9]+');

Route::post('/unban_user/{user}', 'AdminController@unbanUser')->middleware('ban-users')
    ->where('user', '[0-9]+');

Route::get("/set_users_roles","AdminController@setUsersRolesView")->middleware('set-permissions');

Route::get("/set_user_role","AdminController@setUsersRoles")->middleware('set-permissions');

/**
 * User routes
 */
Route::get('/my_checklists',"UserController@myCheckLists");

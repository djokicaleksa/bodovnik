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
    if(Auth::check()) {
        $route = "Početna";
        return view('index', compact('route'));
    }

    return redirect('login');
});

Auth::routes();
Route::resource('teams', 'TeamController');
Route::resource('users', 'UsersController');
Route::resource('activities', 'ActivityController');
Route::post('/activities-user', 'UsersController@userActivityStore');
Route::get('/home', 'HomeController@index');
Route::get('/profile', 'ProfileController@edit');

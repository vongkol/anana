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
    return view('fronts.index');
});

Auth::routes();
Route::get('/login', function(){
    // some route
});
Route::get('/home', 'HomeController@index')->name('home');

// Admin Route
Route::prefix('anana-admin')->group(function () {
    Route::get('/', "DashboardController@index");

    Route::get('login', function(){
        return redirect('/login');
    });
    Route::get('logout', "UserController@logout");
    
    Route::get('dashboard', "DashboardController@index");

    Route::get('users', function () {
        
        return view('layouts.app');
    });
    // user and role
    Route::get('user', 'UserController@index');
    Route::get('role', "RoleController@index");
    Route::get('role/create', "RoleController@create");
    Route::get('role/edit/{id}', "RoleController@edit");
    Route::get('role/delete/{id}', "RoleController@delete");
});
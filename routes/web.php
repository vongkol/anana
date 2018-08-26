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
// Route::get('login', function(){
//     return redirect('anana-admin/login');
// });
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sign-in', 'FrontSecurityController@sign_in');
Route::get('/sign-up', 'FrontSecurityController@sign_up');
Route::get('/forgot-password', 'FrontSecurityController@forget');
Route::get('/reset', 'FrontSecurityController@reset');

// Admin Route
Route::prefix('anana-admin')->group(function () {
    Route::get('/', "DashboardController@index");

    Route::get('login', function(){
        return view('auth.login');
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
    Route::get('role/delete', "RoleController@delete");
    Route::post('role/save', "RoleController@save");
    Route::get('role/edit/{id}', "RoleController@edit");
    Route::post('role/update', "RoleController@update");

    // supply
    Route::get('supply', "SupplyController@index");
    Route::get('supply/edit/{id}', "SupplyController@edit");
    Route::post('supply/update', "SupplyController@update");
});

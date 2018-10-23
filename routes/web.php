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
Route::get('term', 'FrontController@term');
Route::get('/dashboard', "MemberController@dashboard");
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sign-in', 'FrontSecurityController@sign_in');
Route::get('/sign-up', 'FrontSecurityController@sign_up');
Route::get('/forgot-password', 'FrontSecurityController@forget');
Route::get('/reset', 'FrontSecurityController@reset');
// investment
Route::get('/investment', "FrontController@investment");
// member route
Route::get('/confirm/{id}', "MemberController@confirm");
Route::get('/member/logout', "MemberController@logout");
Route::post('/member/register', 'MemberController@register');
Route::post('/member/signin', 'MemberController@signin');
Route::get('/member/profile/{id}', 'MemberController@profile');
Route::get('/member/account/{id}', 'MemberController@my_account');
// investment
Route::get('member/investment/start', 'InvestmentController@start');
Route::post('member/investment/save', 'InvestmentController@save');
Route::get('member/investment/{id}', 'InvestmentController@index');
// wallet
Route::get('member/earning', 'EarningController@index');
// transfer
Route::get('member/transfer/register', "MemberTransferController@to_own_register_wallet");
Route::get('member/transfer/bwallet', "MemberTransferController@to_b_wallet");
Route::get('member/transfer/anc', "MemberTransferController@to_anc");
Route::get('member/transfer/anywallet', "MemberTransferController@to_any_wallet");
Route::get('member/transfer/anyregister', "MemberTransferController@to_any_register");
Route::post('member/transfer/anyregister/save', "MemberTransferController@save_register");
Route::post('member/transfer/anc/save', "MemberTransferController@save_to_anc");
Route::post('member/transfer/bwallet/save', "MemberTransferController@save_b_wallet");
Route::post('member/transfer/register/save', "MemberTransferController@save_register_wallet");
Route::post('member/transfer/anywallet/save', "MemberTransferController@save_any_wallet");
// payment request
Route::get('member/payment', "PaymentController@index");
Route::post('member/payment/save', "PaymentController@save");
// transaction
Route::get('member/transaction', 'TransactionController@index');
// network
Route::get('member/network', 'NetworkController@index');
// get rate api
Route::get('rate/get', 'RateController@index');

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
    Route::get('user/create', 'UserController@create');
    Route::get('user/delete', 'UserController@delete');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::get('user/profile/{id}', 'UserController@profile');
    Route::post('user/save', 'UserController@save');
    Route::post('user/update', 'UserController@update');

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
    // block
    Route::get('block', "BlockController@index");
    Route::get('block/create', "BlockController@create");
    Route::get('block/edit/{id}', "BlockController@edit");
    Route::get('block/delete', "BlockController@delete");
    Route::post('block/save', "BlockController@save");
    Route::post('block/update', "BlockController@update");
    // package
    Route::get('package', "PackageController@index");
    Route::get('package/create', "PackageController@create");
    Route::get('package/edit/{id}', "PackageController@edit");
    Route::get('package/delete', "PackageController@delete");
    Route::post('package/save', "PackageController@save");
    Route::post('package/update', "PackageController@update");
    // exchange
    Route::get('exchange', 'ExchangeController@index');
    Route::get('exchange/create', 'ExchangeController@create');
    Route::get('exchange/edit/{id}', 'ExchangeController@edit');
    Route::get('exchange/delete', 'ExchangeController@delete');
    Route::post('exchange/save', 'ExchangeController@save');
    Route::post('exchange/update', 'ExchangeController@update');
    // member
    Route::get('member', "MemberAdminController@index");
    Route::get('member/transfer', "MemberAdminController@transfer");
    Route::get('member/delete/{id}', "MemberAdminController@delete");
    Route::get('member/detail/{id}', "MemberAdminController@detail");
    Route::get('/member/reset-password/{id}', "MemberAdminController@reset_password");
    Route::post('/member/change-password', "MemberAdminController@change_password");
    Route::get('/member/reset-security-pin/{id}', "MemberAdminController@reset_pin");
    Route::post('/member/change-security-pin', "MemberAdminController@change_pin");
    // credit
    Route::get('member/credit/{id}', 'MemberAdminController@credit');
    Route::post('member/credit/save', 'MemberAdminController@save_credit');
});

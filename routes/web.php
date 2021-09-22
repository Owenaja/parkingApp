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

Auth::routes();

Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm');
Route::post('/login/customer', 'Auth\LoginController@CustomerLogin');
Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm');
Route::post('/register/customer', 'Auth\RegisterController@createCustomer');

Route::group(['middleware' => ['auth:customer']], function () {

    Route::get('/dashboard_customer', function () {
        return view('dashboard_customer');
    });

    Route::get('/create_ticket', 'TransactionController@create_ticket')->name('customer.create.ticket');
    Route::post('/store_ticket', 'TransactionController@store_ticket')->name('customer.store.ticket');
    Route::get('/ticket/qrcode/{id}', 'TransactionController@generate_customer')->name('generate_ticket');

});


Route::group(['middleware' => ['auth:user']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::resource('/nonmember', 'NonMemberTransactionController');
    Route::resource('/member', 'NonMemberTransactionController');
    Route::resource('/tickets', 'TicketController');
    Route::resource('/parkingslots', 'ParkingSlotController');
    Route::resource('/transactions', 'TransactionController');
    Route::resource('/customers', 'CustomerController');
    Route::resource('/topups', 'TopupController');

    Route::get('transactions/qrcode/{id}', 'TransactionController@generate')->name('generate');
    Route::get('/scan_in', 'TransactionController@scanIn')->name('scan_in');
    Route::post('/scan_in/confirm', 'TransactionController@scanInConfirm')->name('scan_in.confirm');
    Route::get('/scan_out', 'TransactionController@scanOut')->name('scan_out');
    Route::post('/scan_out/confirm', 'TransactionController@scanOutConfirm')->name('scan_out.confirm');
    Route::get('ajax/{id}', 'TransactionController@ajax');

    Route::get('/', 'TransactionController@index')->name('home');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

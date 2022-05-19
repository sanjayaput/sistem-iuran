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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/users')->name('api.users')->uses('UserController@userData');
Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/roles')->name('api.roles')->uses('RoleController@rolesData');
    Route::get('/users')->name('api.users')->uses('UserController@userData');
    Route::get('/pemasukan')->name('api.pemasukan')->uses('PemasukanController@api_pemasukan');
    Route::get('/pengeluaran')->name('api.pengeluaran')->uses('PengeluaranController@api_pengeluaran');
    Route::get('/iuran')->name('api.iuran')->uses('IuranController@api_iuran');
});

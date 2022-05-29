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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // echo phpinfo();
    // $users = \App\User::all();
    // foreach ($users as $key => $user) {
    //     $user->password = bcrypt('asdasdasd');
    //     $user->save();
    // }
    return redirect('/chart');
});


Auth::routes();

// Disable route register
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/error', 'ErrorController@index')->name('error');
Route::post('/tiny-image-upload', 'TinyUploadController@uploadImage');

# User Route
Route::middleware(['auth'])->group(function () {
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users/store', 'UserController@store'); 
    Route::get('/users/edit/{id}', 'UserController@edit');
    Route::post('/users/delete/{id}', 'UserController@destroy');
    Route::put('/users/update/{id}', 'UserController@update');

    Route::get('/profil-desa', 'ProfilDesaController@edit')->name('profil-desa');
    Route::post('/profil-desa/update-create', 'ProfilDesaController@updateOrCreate');

    Route::get('/roles', 'RoleController@index')->name('roles');
    Route::get('/roles/create', 'RoleController@create');
    Route::post('/roles/store', 'RoleController@store'); 
    Route::get('/roles/edit/{id}', 'RoleController@edit');
    Route::post('/roles/delete/{id}', 'RoleController@destroy');
    Route::post('/roles/update/{id}', 'RoleController@update');

    Route::get('/pemasukan', 'PemasukanController@index')->name('pemasukan');
    Route::get('/pemasukan/create', 'PemasukanController@create');
    Route::post('/pemasukan/store', 'PemasukanController@store'); 
    Route::get('/pemasukan/edit/{id}', 'PemasukanController@edit');
    Route::post('/pemasukan/delete/{id}', 'PemasukanController@destroy');
    Route::post('/pemasukan/update/{id}', 'PemasukanController@update');
    Route::get('/pemasukan/report/pdf', 'PemasukanController@report_pdf');

    Route::get('/pengeluaran', 'PengeluaranController@index')->name('pengeluaran');
    Route::get('/pengeluaran/create', 'PengeluaranController@create');
    Route::post('/pengeluaran/store', 'PengeluaranController@store'); 
    Route::get('/pengeluaran/edit/{id}', 'PengeluaranController@edit');
    Route::post('/pengeluaran/delete/{id}', 'PengeluaranController@destroy');
    Route::post('/pengeluaran/update/{id}', 'PengeluaranController@update');
    Route::get('/pengeluaran/report/pdf', 'PengeluaranController@report_pdf');

    Route::get('/iuran', 'IuranController@index')->name('iuran');
    Route::get('/iuran/create', 'IuranController@create');
    Route::post('/iuran/store', 'IuranController@store'); 
    Route::get('/iuran/edit/{id}', 'IuranController@edit');
    Route::post('/iuran/delete/{id}', 'IuranController@destroy');
    Route::post('/iuran/update/{id}', 'IuranController@update');
    Route::get('/iuran/report/pdf', 'IuranController@report_pdf');

    Route::get('/chart', 'ChartController@index');
    Route::post('/chart/generate', 'ChartController@generateChart');
    
});

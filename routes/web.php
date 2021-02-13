<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

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
    return view('welcome');

    // if(auth()->user()->hasRole('hrd')){return 'ok';}
    // auth()->user()->assignRole('kebersihan');
    // auth()->user()->syncRoles(['admin']);
});

Auth::routes();

// Dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/dashboard/blnini', 'HomeController@dataNilaiBlnIni')->name('dashboard.ini');
Route::get('/dashboard/blndpn', 'HomeController@getkaryawanHbsKntrkBlnDpn')->name('dashboard.dpn');
Route::post('/dashboard', 'HomeController@test');

// Karyawan
Route::get('/info_karyawan', 'KryawanController@index')->middleware('role:admin');
Route::get('/info_karyawan/create', 'KryawanController@create')->middleware('role:admin');
Route::get('/info_karyawan/list', 'KryawanController@getKaryawan')->name('info_karyawan.list')->middleware('role:admin');
Route::get('/info_karyawan/{karyawan}', 'KryawanController@show')->middleware('role:admin');
Route::post('/info_karyawan', 'KryawanController@store');
Route::get('/info_karyawan/{karyawan}/edit', 'KryawanController@edit')->middleware('role:admin');
Route::put('/info_karyawan/{karyawan}', 'KryawanController@update');

// Habis Kontrak
Route::group(['middleware' => 'role:admin', 'prefix' => 'habis_kontrak'], function(){
    Route::get('/', 'KryawanController@habisKontrak');
    Route::get('/get', 'KryawanController@getHabisKontrak')->name('habis_kontrak.get');
    Route::get('/{departemen}/print', 'KryawanController@printHbsKntrk');
});

// Penilaian
Route::get('/penilaian', 'KryawanController@penilaian')->name('penilaian.true');
Route::post('/penilaian', 'KryawanController@storePenilaian');
Route::get('/penilaian/pen', 'KryawanController@getPenilaian')->name('penilaian.pen');
Route::get('/penilaian/{karyawan}/input', 'KryawanController@inputPenilaian');
Route::delete('/penilaian/{id}', 'KryawanController@destroy');
Route::get('/penilaian/{nilai}/nilai/{bulan}', 'KryawanController@getNilai');
Route::get('/penilaian/{nilai}/detail/{bulan}', 'KryawanController@getNilaiDetail');
Route::get('/penilaian/{id}/nilai/{bulan}/print', 'KryawanController@printNilai');

// Putus kontrak
Route::get('/putus_kontrak', 'KryawanController@putusKontrak')->middleware('role:admin');
Route::get('/putus_kontrak/putus', 'KryawanController@getPutusKontrak')->name('putus_kontrak.pts')->middleware('role:admin');

// Metode SMART
Route::get('/smart_method', 'KryawanController@smart')->middleware('role:admin');
Route::get('/smart_method/kriteria', 'KryawanController@getKriteria')->middleware('role:admin');

// Upload Foto
Route::post('/upload/{karyawan}', 'KryawanController@uploadFoto')->middleware('role:admin');


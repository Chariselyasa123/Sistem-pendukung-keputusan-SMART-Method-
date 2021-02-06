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
Route::get('/dashboard/blnini', 'HomeController@getkaryawanHbsKntrkBlnIni')->name('dashboard.ini');
Route::get('/dashboard/blndpn', 'HomeController@getkaryawanHbsKntrkBlnDpn')->name('dashboard.dpn');
Route::get('/dashboard/office', 'HomeController@getKaryawanOffice')->name('dashboard.off');
Route::get('/dashboard/intake', 'HomeController@getKaryawanIntake')->name('dashboard.int');
Route::get('/dashboard/warehouse', 'HomeController@getKaryawanWarehouse')->name('dashboard.war');
Route::get('/dashboard/produksi', 'HomeController@getKaryawanProduksi')->name('dashboard.prod');
Route::get('/dashboard/ga', 'HomeController@getKaryawanGa')->name('dashboard.ga');
Route::get('/dashboard/qclab', 'HomeController@getKaryawanQclab')->name('dashboard.qc');
Route::get('/dashboard/Truck', 'HomeController@getKaryawanTruck')->name('dashboard.truck');
Route::get('/dashboard/premix', 'HomeController@getKaryawanPremix')->name('dashboard.pre');
Route::get('/dashboard/maintance', 'HomeController@getKaryawanMaintance')->name('dashboard.main');
Route::get('/dashboard/kebersihan', 'HomeController@getKaryawanKebersihan')->name('dashboard.keb');
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
Route::get('/habis_kontrak', 'KryawanController@habisKontrak')->middleware('role:admin');
Route::get('/habis_kontrak/office', 'KryawanController@getHabisKontrakOffice')->name('habis_kontrak.office')->middleware('role:admin');
Route::get('/habis_kontrak/intake', 'KryawanController@getHabisKontrakIntake')->name('habis_kontrak.intake')->middleware('role:admin');
Route::get('/habis_kontrak/warehousing', 'KryawanController@getHabisKontrakWarehouse')->name('habis_kontrak.warehousing')->middleware('role:admin');
Route::get('/habis_kontrak/produksi', 'KryawanController@getHabisKontrakProduksi')->name('habis_kontrak.produksi')->middleware('role:admin');
Route::get('/habis_kontrak/qclab', 'KryawanController@getHabisKontrakQclab')->name('habis_kontrak.qclab')->middleware('role:admin');
Route::get('/habis_kontrak/ga', 'KryawanController@getHabisKontrakGa')->name('habis_kontrak.ga')->middleware('role:admin');
Route::get('/habis_kontrak/truckscale', 'KryawanController@getHabisKontrakTruckScale')->name('habis_kontrak.truckscale')->middleware('role:admin');
Route::get('/habis_kontrak/premix', 'KryawanController@getHabisKontrakPremix')->name('habis_kontrak.premix')->middleware('role:admin');
Route::get('/habis_kontrak/maintance', 'KryawanController@getHabisKontrakMaintance')->name('habis_kontrak.maintance')->middleware('role:admin');
Route::get('/habis_kontrak/kebersihan', 'KryawanController@getHabisKontrakKebersihan')->name('habis_kontrak.kebersihan')->middleware('role:admin');
Route::get('/habis_kontrak/{departemen}/print', 'KryawanController@printHbsKntrk')->middleware('role:admin');

// Penilaian
Route::get('/penilaian', 'KryawanController@penilaian')->name('penilaian.true');
Route::post('/penilaian', 'KryawanController@storePenilaian');
Route::get('/penilaian/pen', 'KryawanController@getPenilaian')->name('penilaian.pen');
Route::get('/penilaian/{karyawan}/input', 'KryawanController@inputPenilaian');
Route::delete('/penilaian/{id}', 'KryawanController@destroy');
Route::get('/penilaian/{nilai}/nilai', 'KryawanController@getNilai');
Route::get('/penilaian/{nilai}/detail', 'KryawanController@getNilaiDetail');
Route::get('/penilaian/{id}/nilai/print', 'KryawanController@printNilai');

// Putus kontrak
Route::get('/putus_kontrak', 'KryawanController@putusKontrak')->middleware('role:admin');
Route::get('/putus_kontrak/putus', 'KryawanController@getPutusKontrak')->name('putus_kontrak.pts')->middleware('role:admin');

// Upload Foto
Route::post('/upload/{karyawan}', 'KryawanController@uploadFoto')->middleware('role:admin');


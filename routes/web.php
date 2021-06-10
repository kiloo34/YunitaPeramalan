<?php

use App\CurahHujan;
use App\Http\Controllers\Mantri\HomeController as MantriDashboard;
use App\Http\Controllers\Mantri\ProfilController;
// use App\Http\Controllers\Mantri\ProduksiController;
use Mantri\ProduksiController;
use Mantri\CurahHujanController;
use Mantri\KecamatanController;
use Mantri\PeriodeController;
use Mantri\PermintaanController;
use App\Http\Controllers\Mantri\PeramalanController;

use App\Http\Controllers\Holtikultura\HomeController as HoltikulturaDashboard;
use App\Http\Controllers\Holtikultura\ProduksiController as HoltikulturaProduksiController;

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
    return view('wellcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['role:mantri']], function () {
        //Dashboard
        Route::get('/dash', [MantriDashboard::class, 'index'])->name('mantri.dashboard');
        //Produksi
        Route::resource('produksi', ProduksiController::class, ['except' => ['create', 'edit']]);
        Route::get('produksi/create/{kecamatan}', [App\Http\Controllers\Mantri\ProduksiController::class, 'create'])->name('produksi.create');
        Route::get('produksi/{kecamatan}/edit/{produksi}', [App\Http\Controllers\Mantri\ProduksiController::class, 'edit'])->name('produksi.edit');
        Route::get('produksi/{tahun}/periode', [App\Http\Controllers\Mantri\ProduksiController::class, 'getPeriode'])->name('produksi.getPeriode');
        // Permintaan
        Route::resource('permintaan', PermintaanController::class, ['except' => ['create', 'edit']]);
        Route::get('permintaan/create/{kecamatan}', [App\Http\Controllers\Mantri\PermintaanController::class, 'create'])->name('permintaan.create');
        Route::get('permintaan/{kecamatan}/edit/{permintaan}', [App\Http\Controllers\Mantri\PermintaanController::class, 'edit'])->name('permintaan.edit');
        //Curah Hujan
        Route::resource('hujan', CurahHujanController::class);
        //Kecamatan
        Route::resource('kecamatan', KecamatanController::class);
        //Periode
        Route::resource('periode', PeriodeController::class);
        //Profil
        Route::get('mantri', [ProfilController::class, 'index'])->name('mantri.index');
        Route::post('mantri/{user}', [ProfilController::class, 'update'])->name('mantri.update');
        // Peramalan
        Route::get('forecast/produksi', [PeramalanController::class, 'produksi'])->name('forecast.produksi.index');
        Route::post('forecast/produksi/{kecamatan}', [PeramalanController::class, 'prosesProduksi'])->name('forecast.produksi.proses');
        Route::get('forecast/permintaan', [PeramalanController::class, 'permintaan'])->name('forecast.permintaan.index');
        Route::get('forecast/permintaan/{kecamatan}', [PeramalanController::class, 'prosesPermintaan'])->name('forecast.permintaan.proses');
    });

    Route::group(['middleware' => ['role:holtikultura']], function () {
        // Dashboard
        Route::get('/dashboard', [HoltikulturaDashboard::class, 'index'])->name('holtikultura.dashboard');
        // Produksi
        Route::get('pembuatan', [HoltikulturaProduksiController::class, 'index'])->name('holtikulturia.produksi.index');
        // Profil
        Route::get('holtikultura', [ProfilController::class, 'index'])->name('holtikultura.index');
    });
});

Route::get('/landing', 'HomeController@index')->name('landing');

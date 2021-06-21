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
use Holtikultura\KecamatanController as HoltikulturaKecamatanController;
use Holtikultura\CurahHujanController as HoltikulturaCurahHujanController;
use Holtikultura\PeriodeController as HoltikulturaPeriodeController;
use App\Http\Controllers\Holtikultura\PermintaanController as HoltikulturaPermintaanController;
use App\Http\Controllers\Holtikultura\PeramalanController as HoltikulturaPeramalanController;
use App\Http\Controllers\Holtikultura\ProfilController as HoltikulturaProfilController;

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
        Route::resource('hujan', CurahHujanController::class, ['except' => ['create', 'edit', 'destroy', 'update', 'show', 'store']]);
        //Kecamatan
        Route::resource('kecamatan', KecamatanController::class, ['except' => ['create', 'edit', 'destroy', 'update', 'show', 'store']]);
        //Periode
        Route::resource('periode', PeriodeController::class, ['except' => ['create', 'edit', 'destroy', 'update', 'show', 'store']]);
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
        Route::get('dashboard', [HoltikulturaDashboard::class, 'index'])->name('holtikultura.dashboard');
        // Produksi
        Route::get('production', [HoltikulturaProduksiController::class, 'index'])->name('production.index');
        Route::get('production/{production}/show', [HoltikulturaProduksiController::class, 'show'])->name('production.show');
        Route::get('production/rekap', [HoltikulturaProduksiController::class, 'rekap'])->name('production.rekap');
        // Permintaan
        Route::get('request', [HoltikulturaPermintaanController::class, 'index'])->name('request.index');
        Route::get('request/{req}/show', [HoltikulturaPermintaanController::class, 'show'])->name('request.show');
        Route::get('request/rekap', [HoltikulturaPermintaanController::class, 'rekap'])->name('request.rekap');
        // Curah Hujan
        Route::resource('rainfall', HoltikulturaCurahHujanController::class);
        // Periode
        Route::resource('period', HoltikulturaPeriodeController::class);
        // Kecamatan
        Route::resource('kec', HoltikulturaKecamatanController::class);
        // Profil
        Route::get('holtikultura', [HoltikulturaProfilController::class, 'index'])->name('holtikultura.index');
        Route::post('holtikultura/{user}', [HoltikulturaProfilController::class, 'update'])->name('holtikultura.update');
        // Peramalan
        Route::get('forecast/production', [HoltikulturaPeramalanController::class, 'produksi'])->name('forecast.production.index');
        Route::post('forecast/production/{kecamatan}', [HoltikulturaPeramalanController::class, 'prosesProduksi'])->name('forecast.production.proses');
        Route::get('forecast/req', [HoltikulturaPeramalanController::class, 'permintaan'])->name('forecast.req.index');
        Route::get('forecast/req/{kecamatan}', [HoltikulturaPeramalanController::class, 'prosesPermintaan'])->name('forecast.req.proses');
    });
});

Route::get('/landing', 'HomeController@index')->name('landing');

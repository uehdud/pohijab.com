<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\InputProduk;
use App\Http\Controllers\GudangBahan;
use App\Http\Controllers\TestJoinsController;

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

Route::redirect('/', 'login');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    /* Start Route aplikasi Gudang */
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('returonline', \App\Http\Controllers\Gudang\ReturOnlineController::class);
    });
    Route::group(['middleware' => 'role:gudang', 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
        Route::resource('gudangs', \App\Http\Controllers\Gudang\GudangController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('gudangs', \App\Http\Controllers\Gudang\GudangController::class);
    });
    Route::group(['middleware' => 'role:gudang', 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
        Route::resource('suratjalan', \App\Http\Controllers\Gudang\SuratJalanController::class);
    });
    Route::group(['middleware' => 'role:gudang', 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
        Route::resource('notakeluar', \App\Http\Controllers\Gudang\StokOutMakkataController::class);
    });
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('suratjalan', \App\Http\Controllers\Gudang\SuratJalanController::class);
    });
    Route::group(['middleware' => 'role:gudang', 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
        Route::resource('stokout', \App\Http\Controllers\Gudang\StokOutController::class);
    });
    /* End Route aplikasi Gudang */

    /* Start Route aplikasi Gudang */
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('sjonline', \App\Http\Controllers\GudangOnline\SuratJalanOnline::class);
    });

    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('gudangstudio', \App\Http\Controllers\Gudang\GudangStudioController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('inout', \App\Http\Controllers\Admin\InoutController::class);
    });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('stok', \App\Http\Controllers\Admin\StokController::class);
    });
    Route::group(['middleware' => 'role:gudang', 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
        Route::resource('stok', \App\Http\Controllers\Admin\StokController::class);
    });
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('stokout', \App\Http\Controllers\Gudang\StokOutController::class);
    });
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('stokpusat', \App\Http\Controllers\GudangPusat\GudangPusatController::class);
    });
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('sjout', \App\Http\Controllers\GudangOnline\SuratJalanOnline::class);
    });
    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('printsjout', \App\Http\Controllers\GudangOnline\PrintSjRetur::class);
    });

    Route::group(['middleware' => 'role:admingudang', 'prefix' => 'admingudang', 'as' => 'admingudang.'], function () {
        Route::resource('stokonline', \App\Http\Controllers\StokOnline\StokOnlineController::class);
    });
    /* End Route aplikasiInout Produksi */

    /* Start Route aplikasi Foto */
    Route::group(['middleware' => 'role:foto', 'prefix' => 'foto', 'as' => 'foto.'], function () {
        Route::resource('fotos', \App\Http\Controllers\Foto\FotoController::class);
    });

    Route::group(['middleware' => 'role:foto', 'prefix' => 'foto', 'as' => 'foto.'], function () {
        Route::resource('fotoplanet', \App\Http\Controllers\Foto\ListFotoPlanetController::class);
    });
    Route::group(['middleware' => 'role:foto', 'prefix' => 'foto', 'as' => 'foto.'], function () {
        Route::resource('fotomakkata', \App\Http\Controllers\Foto\ListFotoMakkataController::class);
    });
    Route::group(['middleware' => 'role:foto', 'prefix' => 'foto', 'as' => 'foto.'], function () {
        Route::resource('fotoclanela', \App\Http\Controllers\Foto\ListFotoClanelaController::class);
    });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('fotos', \App\Http\Controllers\Foto\FotoController::class);
    });



    /* End Route aplikasi Foto */

    /* start Route aplikasi gudang online */
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('stokonline', \App\Http\Controllers\StokOnline\StokOnlineController::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('stokonlinemakkata', \App\Http\Controllers\StokOnline\StokOnlineMakkataController::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('kontrolstok', \App\Http\Controllers\StokOnline\KontrolStokController::class);
    });

    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('gudangonline', \App\Http\Controllers\StokOnline\GudangOnline::class);
    });

    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('stokklik', \App\Http\Controllers\GudangOnline\StokKlikController::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('sjonline', \App\Http\Controllers\GudangOnline\SuratJalanOnline::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('printsjretur', \App\Http\Controllers\GudangOnline\PrintSjRetur::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::get('stokpixel', [\App\Http\Controllers\GudangOnline\GudangOnlineController::class, 'stokpixel'])->name('stokpixel');
        Route::get('fotopixel/{$kode_barang}', [\App\Http\Controllers\GudangOnline\GudangOnlineController::class, 'fotostokpixel'])->name('fotostokpixel');
        Route::resource('fotostokpixel', \App\Http\Controllers\GudangOnline\GudangOnlineController::class,);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('sjout', \App\Http\Controllers\GudangOnline\SuratJalanOnline::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('terimasj', \App\Http\Controllers\GudangOnline\TerimaSuratJalanController::class);
    });

    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('editproduk', \App\Http\Controllers\StokOnline\EditProdukController::class);
    });
    Route::group(['middleware' => 'role:online', 'prefix' => 'online', 'as' => 'online.'], function () {
        Route::resource('gudangstudio', \App\Http\Controllers\Gudang\GudangStudioController::class);
    });
    /* End Route aplikasi gudang online */
});

<?php

use App\Http\Controllers\API\FotoController;
use App\Http\Controllers\API\ProdukPixelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apigudang;
use App\Http\Controllers\ProdukController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apigudang', [apigudang::class, 'index']);
Route::get('/apigudang/{$id}', [apigudang::class, 'show']);

Route::apiResource('produk-pixel', ProdukPixelController::class);
Route::apiResource('studio', FotoController::class);

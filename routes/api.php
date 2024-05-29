<?php

use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/donors', 'App\Http\Controllers\DonorsController@getDonors');
Route::get('/donors/{id}', 'App\Http\Controllers\DonorsController@getDonorById');
Route::get('/darah', [StockController::class, 'getAllStock']);
Route::get('/darah/{id}', [StockController::class, 'getStockById']);
Route::get('/darah/faskes', [StockController::class, 'getSelfStock']);

Route::get('/donor', [DonorsController::class, 'getDonors']);
Route::get('/donor/{id}', [DonorsController::class, 'getDonorById']);
Route::get('/donor/semua', [DonorsController::class, 'getDonorsAll']);
Route::post('/donor/tambah', [DonorsController::class, 'createDonor']);
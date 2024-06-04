<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BloodDonationController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorsController;
use App\Models\BloodDonation;
use App\Http\Controllers\BloodUsageController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\HealthFacilityController;

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

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/faskes', [AuthController::class, 'getFaskes']);
        Route::get('/faskes/{faskesid}', [HealthFacilityController::class, 'getOtherFaskes']);

        Route::get('/darah', [StockController::class, 'getAllStock']);
        Route::get('/darah/{id}', [StockController::class, 'getStockById']);
        Route::get('/darah/faskes', [StockController::class, 'getSelfStock']);

        Route::get('/donor', [DonorsController::class, 'getDonors']);
        Route::get('/donor/{id}', [DonorsController::class, 'getDonorById']);
        Route::post('/donor-tambah', [DonorsController::class, 'createDonor']);

        Route::post('/tambah-stok', [BloodDonationController::class, 'store']);
        Route::post('/pakai-stok', [BloodUsageController::class, 'usage']);
        Route::get('/riwayat-pakai', [BloodUsageController::class, 'list']);

        Route::get('/all-faskes', [HealthFacilityController::class, 'index']);
        Route::post('/minta-darah', [BloodRequestController::class, 'request']);
    }
);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

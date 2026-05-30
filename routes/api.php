<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\FormController;
use App\Http\Controllers\Api\Backend\CourseController;
use App\Http\Controllers\Api\Public\CertificateController;
use App\Http\Controllers\Api\Payment\VirtualPayment;
use App\Http\Controllers\Api\ApiDashboard;

/*
|--------------------------------------------------------------------------
| Public API Routes (no auth)
|--------------------------------------------------------------------------
*/
Route::prefix('v1/public')->group(function () {
    Route::get('certificate', [CertificateController::class, 'index']);
    Route::get('certificate/key/{code}', [CertificateController::class, 'show']);
    Route::post('midtrans/va/create', [VirtualPayment::class, 'virtualAccountMidtrans']);
    Route::get('data/{id}', [ApiDashboard::class, 'dataUserDashboard']);
    Route::get('statistics', [ApiDashboard::class, 'Statistics']);
});

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('form', [FormController::class, 'index']);
        Route::get('logout', [AuthController::class, 'destroy']);

        Route::prefix('course')->group(function () {
            Route::get('index', [CourseController::class, 'index']);
            Route::post('store', [CourseController::class, 'store']);
            Route::post('{id}/update', [CourseController::class, 'update']);
            Route::get('delete/{id}', [CourseController::class, 'destroy']);
        });
    });
});

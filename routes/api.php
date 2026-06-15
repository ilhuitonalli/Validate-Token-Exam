<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TokenApiController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rutas protegidas (requieren JWT)
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/keys', [TokenApiController::class, 'storeToken']);
    Route::get('/keys', [TokenApiController::class, 'showToken']);
    Route::post('/keys/{id}/revoke', [TokenApiController::class, 'revokeToken']);
    Route::post('/keys/validate', [TokenApiController::class, 'validateToken']);
});
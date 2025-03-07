<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonasiController;
use Illuminate\Support\Facades\Route;

// Rute Auth (tanpa autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
 // User yang login bisa melakukan donasi
 Route::post('/donasi', [DonasiController::class, 'store']);
 

// Rute yang membutuhkan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
   
    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::get('/donasi', [DonasiController::class, 'index']); // Admin melihat semua donasi
        Route::put('/donasi/{id}', [DonasiController::class, 'update']); // Admin verifikasi donasi
        Route::delete('/donasi/{id}', [DonasiController::class, 'destroy']); // Admin hapus donasi
    });
});

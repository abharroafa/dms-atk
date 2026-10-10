<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditController;

// ========================================
// HALAMAN LOGIN
// ========================================

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// Proses login web
Route::post('/login', [WebAuthController::class, 'login'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('login.process');


// ========================================
// HALAMAN REGISTER
// ========================================

Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware(['guest', 'throttle:5,1'])
    ->name('register.process');


// ========================================
// HALAMAN SETELAH LOGIN
// ========================================

Route::middleware('auth')->group(function () {

    // Logout web
    Route::post('/logout', [WebAuthController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Unggah nota
    Route::view('/nota/upload', 'nota.upload')
        ->name('nota.upload');

    // Arsip nota
    Route::view('/nota', 'nota.index')
        ->name('nota.index');

    // Rekap nota
    Route::view('/rekap', 'rekap.index')
        ->name('rekap.index');

    // Log audit
    Route::get('/audit', [AuditController::class, 'index'])
        ->middleware('role:pemilik')
        ->name('audit.index');

});
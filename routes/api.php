<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AuditLogController;

// ========================================
// AUTENTIKASI API
// ========================================

// Login API untuk memperoleh token
Route::post('/auth/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('api.auth.login');


// ========================================
// API YANG MEMBUTUHKAN TOKEN
// Admin dan Pemilik
// ========================================

Route::middleware('auth:sanctum')->group(function () {

    // Informasi pengguna yang sedang login
    Route::get('/auth/me', [AuthController::class, 'me'])
        ->name('api.auth.me');

    // Logout API dan cabut token aktif
    Route::post('/auth/logout', [AuthController::class, 'logout'])
        ->name('api.auth.logout');


    // ========================================
    // API KHUSUS PEMILIK
    // Tambahkan endpoint setelah controller siap
    // ========================================


    // ========================================
    // API KHUSUS PEMILIK
    // ========================================

    Route::middleware('role:pemilik')->group(function () {

        // Mengubah data nota yang sudah tersimpan
        Route::put('/notas/{id}', [NotaController::class, 'update'])
            ->name('api.notas.update');

        // Menghapus nota dengan soft delete
        Route::delete('/notas/{id}', [NotaController::class, 'destroy'])
            ->name('api.notas.destroy');

        // Melihat log audit
        Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->name('api.audit-logs.index');
    });
});
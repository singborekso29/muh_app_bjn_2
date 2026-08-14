<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\TapAbsensiController;

// ============================================
// ROUTE UNTUK GURU (role:guru)
// ============================================
Route::middleware(['auth', 'role:guru'])->group(function () {

    // Dashboard guru
    Route::get('/dashboard-guru', function () {
        return view('dashboard.guru');
    })->name('guru.dashboard');

    // Profile guru
    Route::get('/profile-guru', [GuruController::class, 'profile'])->name('guru.profile');

    // TAP ABSENSI
Route::prefix('tap')->group(function () {
    Route::get('/', [TapAbsensiController::class, 'index'])->name('tap.index');
    Route::post('/tap', [TapAbsensiController::class, 'tap'])->name('tap.process');
});
});
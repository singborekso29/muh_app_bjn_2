<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\AbsensiController;
use App\Http\Controllers\Master\TapAbsensiController;

// ============================================
// ROUTE UNTUK SISWA (role:siswa)
// ============================================
Route::middleware(['auth', 'role:siswa'])->group(function () {

    // Dashboard siswa
    Route::get('/dashboard-siswa', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

    // Profile siswa
    Route::get('/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::get('/profile/cetak-pdf', [SiswaController::class, 'cetakProfilePDF'])->name('siswa.cetak-profile');

    // TAP ABSENSI
    Route::prefix('tap')->group(function () {
    Route::get('/', [TapAbsensiController::class, 'index'])->name('tap.index');
    Route::post('/tap', [TapAbsensiController::class, 'tap'])->name('tap.process');
});
});
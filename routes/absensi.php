<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\AbsensiController;
use App\Http\Controllers\Master\TapAbsensiController;

// ======================================================
// ABSENSI
// ADMIN, GURU, SISWA
// ======================================================

Route::middleware(['role:admin,guru,siswa'])
    ->prefix('absensi')
    ->group(function () {

        // Halaman utama absensi
        Route::get('/', [AbsensiController::class, 'index'])
            ->name('absensi.index');

        // Absensi siswa
        Route::get('/siswa', [AbsensiController::class, 'absensiSiswa'])
            ->name('absensi.siswa');

        // Absensi guru
        Route::get('/guru', [AbsensiController::class, 'absensiGuru'])
            ->name('absensi.guru');

        // Absensi karyawan
        Route::get('/karyawan', [AbsensiController::class, 'absensiKaryawan'])
            ->name('absensi.karyawan');

        // Form input absensi
        Route::get('/create', [AbsensiController::class, 'create'])
            ->name('absensi.create');

        // Simpan absensi
        Route::post('/', [AbsensiController::class, 'store'])
            ->name('absensi.store');

        // Pulang
        Route::get('/pulang/{id}', [AbsensiController::class, 'pulang'])
            ->name('absensi.pulang');

        // Laporan
        Route::get('/laporan', [AbsensiController::class, 'laporan'])
            ->name('absensi.laporan');

        // Rekap
        Route::get('/rekap', [AbsensiController::class, 'rekap'])
            ->name('absensi.rekap');

        // Detail
        Route::get('/detail/{id}', [AbsensiController::class, 'detail'])
            ->name('absensi.detail');
    });


// ======================================================
// TAP / QR / RFID ABSENSI
// ADMIN, GURU, SISWA
// ======================================================

Route::middleware(['role:admin,guru,siswa'])
    ->prefix('tap')
    ->group(function () {

        Route::get('/', [TapAbsensiController::class, 'index'])
            ->name('tap.index');

        Route::post('/tap', [TapAbsensiController::class, 'tap'])
            ->name('tap.process');

        Route::post('/rfid', [TapAbsensiController::class, 'tapRfid'])
            ->name('tap.rfid');
    });
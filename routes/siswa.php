<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\SiswaController;

Route::middleware('role:admin,guru')->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

    Route::get('/siswa/cetak-semua-pdf', [SiswaController::class, 'cetakSemuaPDF'])
        ->name('siswa.cetak-semua');

    Route::get('/siswa/{id}/cetak-pdf', [SiswaController::class, 'cetakPDF'])
        ->whereNumber('id')
        ->name('siswa.cetak-pdf');

    Route::get('/siswa/{id}', [SiswaController::class, 'show'])
        ->whereNumber('id')
        ->name('siswa.show-siswa');

});

Route::middleware('role:siswa')->group(function () {

    Route::get('/profile', [SiswaController::class, 'profile'])
        ->name('siswa.profile');

    Route::get('/profile/cetak-pdf', [SiswaController::class, 'cetakProfilePDF'])
        ->name('siswa.cetak-profile');

});
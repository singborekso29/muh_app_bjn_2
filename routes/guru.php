<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\GuruController;

Route::middleware('role:admin,guru')->group(function () {

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');

    Route::get('/guru/cetak-semua-pdf', [GuruController::class, 'cetakSemuaPDF'])
        ->name('guru.cetak-semua');

    Route::get('/guru/{id}/download-berkas', [GuruController::class, 'downloadBerkas'])
        ->whereNumber('id')
        ->name('guru.download-berkas');

    Route::get('/guru/{id}/cetak-pdf', [GuruController::class, 'cetakPDF'])
        ->whereNumber('id')
        ->name('guru.cetak-pdf');

    Route::get('/guru/{id}', [GuruController::class, 'show'])
        ->whereNumber('id')
        ->name('guru.show');

});
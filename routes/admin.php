<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\TahunPelajaranController;
use App\Http\Controllers\Master\MataPelajaranController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Master\PembagianKelasController;
use App\Http\Controllers\Master\JadwalPelajaranController;
use App\Http\Controllers\Master\AbsensiController;
use App\Http\Controllers\Master\TapAbsensiController;
use App\Http\Controllers\Master\SiswaImportController;


// ======================================================
// ADMIN
// ======================================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // KELAS
    Route::resource('kelas', KelasController::class);

    // PEMBAGIAN KELAS
    Route::get('/pembagian-kelas', [PembagianKelasController::class, 'index'])
        ->name('pembagian-kelas.index');

    Route::post('/pembagian-kelas', [PembagianKelasController::class, 'tambahKeKelas'])
        ->name('pembagian-kelas.tambah');

    Route::delete('/pembagian-kelas/{siswaId}', [PembagianKelasController::class, 'keluarkanDariKelas'])
        ->name('pembagian-kelas.keluarkan');

    Route::get('/pembagian-kelas/rekap', [PembagianKelasController::class, 'rekap'])
        ->name('pembagian-kelas.rekap');


    // USER MANAGEMENT
    Route::resource('users', UserController::class);


    // TAHUN PELAJARAN
    Route::resource('tahun-pelajaran', TahunPelajaranController::class);


    // MATA PELAJARAN
    Route::resource('mata-pelajaran', MataPelajaranController::class);

    // JADWAL
    Route::resource('jadwal', JadwalPelajaranController::class);

    // IMPORT SISWA
    Route::get('/siswa/import', [SiswaImportController::class, 'index'])
        ->name('siswa.import');

    Route::post('/siswa/import', [SiswaImportController::class, 'import'])
        ->name('siswa.import.store');

    Route::get('/siswa/import/template', [SiswaImportController::class, 'downloadTemplate'])
        ->name('siswa.import.template');


        /// ==================================================
        // GURU - CRUD ADMIN
        // ==================================================

        Route::get('/guru', [GuruController::class, 'index'])
            ->name('guru.index');

        Route::get('/guru/create', [GuruController::class, 'create'])
            ->name('guru.create');

        Route::post('/guru', [GuruController::class, 'store'])
            ->name('guru.store');

        // DETAIL GURU
        Route::get('/guru/{id}', [GuruController::class, 'show'])
            ->whereNumber('id')
            ->name('guru.show');

        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])
            ->whereNumber('id')
            ->name('guru.edit');

        Route::put('/guru/{id}', [GuruController::class, 'update'])
            ->whereNumber('id')
            ->name('guru.update');

        Route::delete('/guru/{id}', [GuruController::class, 'destroy'])
            ->whereNumber('id')
            ->name('guru.destroy');

        Route::post('/guru/{id}/buat-akun', [GuruController::class, 'buatAkun'])
            ->whereNumber('id')
            ->name('guru.buat-akun');

        Route::get('/guru/cetak-semua-pdf', [GuruController::class, 'cetakSemuaPDF'])
            ->name('guru.cetak-semua');

        Route::get('/guru/{id}/cetak-pdf', [GuruController::class, 'cetakPDF'])
            ->whereNumber('id')
            ->name('guru.cetak-pdf');

        Route::get('/guru/{id}/download-berkas', [GuruController::class, 'downloadBerkas'])
            ->whereNumber('id')
            ->name('guru.download-berkas');

// ==================================================
            // SISWA - CRUD ADMIN
            // ==================================================

            Route::get('/siswa/create', [SiswaController::class, 'create'])
                ->name('siswa.create');

            Route::post('/siswa', [SiswaController::class, 'store'])
                ->name('siswa.store');

            Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])
                ->whereNumber('id')
                ->name('siswa.edit');

            Route::put('/siswa/{id}', [SiswaController::class, 'update'])
                ->whereNumber('id')
                ->name('siswa.update');

            Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
                ->whereNumber('id')
                ->name('siswa.destroy');
        });


// ======================================================
// SISWA - ADMIN & GURU
// HANYA MELIHAT DATA
// ======================================================

Route::middleware(['auth', 'role:admin,guru'])->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index'])
        ->name('siswa.index');

    Route::get('/siswa/{id}', [SiswaController::class, 'show'])
        ->whereNumber('id')
        ->name('siswa.show');

    Route::get('/siswa/{id}/cetak-pdf', [SiswaController::class, 'cetakPDF'])
        ->whereNumber('id')
        ->name('siswa.cetak-pdf');

    Route::get('/siswa/cetak-semua-pdf', [SiswaController::class, 'cetakSemuaPDF'])
        ->name('siswa.cetak-semua');
});

// // ======================================================
// // DATA GURU - ADMIN & GURU
// // HANYA MELIHAT DATA
// // ======================================================

// Route::middleware(['auth', 'role:admin,guru'])->group(function () {

//     // CRUD Guru
//     Route::resource('guru', GuruController::class);

//     // Buat akun login untuk guru
//     Route::post('/guru/{id}/buat-akun', [GuruController::class, 'buatAkun'])
//         ->whereNumber('id')
//         ->name('guru.buat-akun');

//     // Cetak semua guru
//     Route::get('/guru/cetak-semua-pdf', [GuruController::class, 'cetakSemuaPDF'])
//         ->name('guru.cetak-semua');

//     // Cetak PDF satu guru
//     Route::get('/guru/{id}/cetak-pdf', [GuruController::class, 'cetakPDF'])
//         ->whereNumber('id')
//         ->name('guru.cetak-pdf');

//     // Download berkas guru
//     Route::get('/guru/{id}/download-berkas', [GuruController::class, 'downloadBerkas'])
//         ->whereNumber('id')
//         ->name('guru.download-berkas');
// });
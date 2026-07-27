<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\GuruController;
use App\Http\Controllers\Master\SiswaController;
use App\Http\Controllers\Master\TahunPelajaranController;
use App\Http\Controllers\Master\MataPelajaranController;
use App\Http\Controllers\Master\KelasController;
use App\Http\Controllers\Akademik\PembagianSiswaController;


Route::prefix('akademik')->group(function () {

    Route::get(
        '/pembagian-siswa',
        [PembagianSiswaController::class,'index']
    )->name('pembagian-siswa.index');

    Route::get(
        '/pembagian-siswa/load',
        [PembagianSiswaController::class,'loadData']
    )->name('pembagian-siswa.load');

    Route::post(
        '/pembagian-siswa/store',
        [PembagianSiswaController::class,'store']
    )->name('pembagian-siswa.store');

});

Route::middleware('role:admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */
     // CRUD KELAS
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas.show');
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->whereNumber('id')->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->whereNumber('id')->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->whereNumber('id')->name('users.destroy');
    Route::resource('tahun-pelajaran', TahunPelajaranController::class);
    Route::resource('mata-pelajaran',  MataPelajaranController::class);

    /*
    |--------------------------------------------------------------------------
    | GURU CRUD
    |--------------------------------------------------------------------------
    */

    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->whereNumber('id')->name('guru.edit');
    Route::put('/guru/{id}', [GuruController::class, 'update'])->whereNumber('id')->name('guru.update');
    Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->whereNumber('id')->name('guru.destroy');

    /*
    |--------------------------------------------------------------------------
    | SISWA CRUD
    |--------------------------------------------------------------------------
    */

    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->whereNumber('id')->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->whereNumber('id')->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->whereNumber('id')->name('siswa.destroy');

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// ============================================
// ROUTE UNTUK SEMUA USER YANG LOGIN
// ============================================
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    require __DIR__.'/admin.php';
    require __DIR__.'/guru.php';
    require __DIR__.'/siswa.php';
    require __DIR__.'/absensi.php';
});

// Route test
Route::get('/test', function () {
    return 'PROJECT BERJALAN';
});

Route::get('/debug-role', function () {
    return [
        'name'  => auth()->user()->name,
        'email' => auth()->user()->email,
        'role'  => auth()->user()->role,
    ];
})->middleware('auth');

require __DIR__.'/auth.php';
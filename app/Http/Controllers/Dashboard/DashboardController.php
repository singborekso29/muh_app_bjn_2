<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = $user->role;

        // Redirect berdasarkan role
        if ($role == 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        if ($role == 'guru') {
            return redirect()->route('guru.dashboard');
        }

        // Admin - tampilkan dashboard admin
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalKaryawan = User::where('role', 'karyawan')->count();
        $totalUser = User::count();

        $today = date('Y-m-d');
        $hadir = Absensi::where('tanggal', $today)->where('status', 'hadir')->count();
        $izin = Absensi::where('tanggal', $today)->where('status', 'izin')->count();
        $sakit = Absensi::where('tanggal', $today)->where('status', 'sakit')->count();
        $alfa = Absensi::where('tanggal', $today)->where('status', 'alfa')->count();

        return view('dashboard.index', compact(
            'totalSiswa', 'totalGuru', 'totalKaryawan', 'totalUser',
            'hadir', 'izin', 'sakit', 'alfa'
        ));
    }
}
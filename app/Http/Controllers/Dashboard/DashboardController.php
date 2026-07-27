<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = Guru::count();
        $totalUser = User::count();
        $totalSiswa = Siswa::count();

        return view('dashboard.index', compact(
            'totalGuru',
            'totalUser',
            'totalSiswa'
        ));
    }
}
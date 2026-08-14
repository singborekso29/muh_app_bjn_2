<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Dashboard Absensi
    public function index()
    {
        $today = date('Y-m-d');

        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalKaryawan = User::where('role', 'karyawan')->count();

        $hadir = Absensi::where('tanggal', $today)->where('status', 'hadir')->count();
        $izin = Absensi::where('tanggal', $today)->where('status', 'izin')->count();
        $sakit = Absensi::where('tanggal', $today)->where('status', 'sakit')->count();
        $alfa = Absensi::where('tanggal', $today)->where('status', 'alfa')->count();

        $absensi = Absensi::with('user')
            ->where('tanggal', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('absensi.index', compact(
            'totalSiswa', 'totalGuru', 'totalKaryawan',
            'hadir', 'izin', 'sakit', 'alfa',
            'absensi'
        ));
    }

    // Form absensi harian
    public function create()
{
    $today = date('Y-m-d');
    $user = auth()->user();
    $role = $user->role;

    // Cek apakah sudah absen hari ini
    $cekAbsen = Absensi::where('user_id', $user->id)
        ->where('tanggal', $today)
        ->first();

    if ($cekAbsen) {
        return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
    }

    return view('absensi.create', compact('role'));
}

    // Simpan absensi
    public function store(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'status' => 'required|in:hadir,izin,sakit,alfa',
        'catatan' => 'nullable|string'
    ]);

    $today = date('Y-m-d');

    // Cek apakah sudah absen hari ini
    $cek = Absensi::where('user_id', $user->id)
        ->where('tanggal', $today)
        ->first();

    if ($cek) {
        return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
    }

    Absensi::create([
        'role' => $user->role,
        'user_id' => $user->id,
        'nama' => $user->name,
        'tanggal' => $today,
        'jam_masuk' => date('H:i:s'),
        'status' => $request->status,
        'metode' => 'manual',
        'catatan' => $request->catatan
    ]);

    return redirect()->route('dashboard')
        ->with('success', 'Absensi berhasil dicatat!');
}

    // Absensi pulang
    public function pulang($id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($absensi->jam_pulang) {
            return redirect()->back()->with('error', 'Sudah absen pulang!');
        }

        $absensi->update([
            'jam_pulang' => date('H:i:s'),
            'keterangan' => 'pulang'
        ]);

        return redirect()->route('absensi.index')
            ->with('success', 'Absensi pulang berhasil dicatat!');
    }

    // Laporan Absensi
    public function laporan(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $role = $request->role ?? 'semua';

        $query = Absensi::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        if ($role != 'semua') {
            $query->where('role', $role);
        }

        $absensi = $query->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('absensi.laporan', compact('absensi', 'bulan', 'tahun', 'role'));
    }

    // Detail Absensi per User
    public function detail($id)
    {
        $absensi = Absensi::where('user_id', $id)
            ->orderBy('tanggal', 'desc')
            ->paginate(30);

        $user = User::findOrFail($id);

        return view('absensi.detail', compact('absensi', 'user'));
    }

    // Rekap Absensi
    public function rekap()
    {
        $today = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        $rekap = Absensi::selectRaw('role, status, COUNT(*) as total')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->groupBy('role', 'status')
            ->get();

        return view('absensi.rekap', compact('rekap', 'bulan', 'tahun'));
    }
// Riwayat Absensi Siswa
public function riwayatSiswa()
{
    $absensi = Absensi::where('user_id', auth()->id())
        ->where('role', 'siswa')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);

    return view('absensi.riwayat-siswa', compact('absensi'));
}

// Riwayat Absensi Guru
public function riwayatGuru()
{
    $absensi = Absensi::where('user_id', auth()->id())
        ->where('role', 'guru')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);

    return view('absensi.riwayat-guru', compact('absensi'));
}

}
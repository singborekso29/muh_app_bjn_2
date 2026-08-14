<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPelajaran::with(['kelas', 'mataPelajaran', 'guru', 'tahunPelajaran'])
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
{
    $kelas = Kelas::orderBy('nama_kelas')->get();
    $mataPelajaran = MataPelajaran::orderBy('nama_mapel')->get(); // ← Ganti 'nama' menjadi 'nama_mapel'
    $guru = Guru::orderBy('nama')->get();
    $tahunPelajaran = TahunPelajaran::orderBy('tahun', 'desc')->get();

    return view('jadwal.create', compact('kelas', 'mataPelajaran', 'guru', 'tahunPelajaran'));
}

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'nullable|exists:gurus,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan' => 'nullable|string|max:255',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'keterangan' => 'nullable|string'
        ]);

        JadwalPelajaran::create($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal pelajaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        $jadwal = JadwalPelajaran::with(['kelas', 'mataPelajaran', 'guru', 'tahunPelajaran'])
            ->findOrFail($id);

        return view('jadwal.show', compact('jadwal'));
    }

    public function edit($id)
{
    $jadwal = JadwalPelajaran::findOrFail($id);
    $kelas = Kelas::orderBy('nama_kelas')->get();
    $mataPelajaran = MataPelajaran::orderBy('nama_mapel')->get(); // ← Ganti 'nama' menjadi 'nama_mapel'
    $guru = Guru::orderBy('nama')->get();
    $tahunPelajaran = TahunPelajaran::orderBy('tahun', 'desc')->get();

    return view('jadwal.edit', compact('jadwal', 'kelas', 'mataPelajaran', 'guru', 'tahunPelajaran'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'guru_id' => 'nullable|exists:gurus,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan' => 'nullable|string|max:255',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'keterangan' => 'nullable|string'
        ]);

        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal pelajaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal pelajaran berhasil dihapus!');
    }
}
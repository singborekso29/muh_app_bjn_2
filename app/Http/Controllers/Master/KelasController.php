<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Menampilkan semua data kelas dengan search & pagination
    public function index(Request $request)
    {
        $search = $request->search;

        $kelas = Kelas::when($search, function ($query) use ($search) {
            $query->where('nama_kelas', 'like', "%{$search}%")
                  ->orWhere('tingkat', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%")
                  ->orWhere('wali_kelas', 'like', "%{$search}%");
        })
        ->with(['guru', 'tahunPelajaran']) // Eager loading
        ->orderBy('tingkat')
        ->orderBy('nama_kelas')
        ->paginate(10)
        ->withQueryString();

        return view('kelas.index', compact('kelas', 'search'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        // Hanya admin yang bisa tambah
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        $gurus = Guru::orderBy('nama')->get();
        $tahunPelajarans = TahunPelajaran::orderBy('tahun', 'desc')->get();

        return view('kelas.create', compact('gurus', 'tahunPelajarans'));
    }

    // Menyimpan data kelas baru
    public function store(Request $request)
    {
        // Hanya admin yang bisa menyimpan
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|in:VII,VIII,IX',
            'jurusan' => 'nullable|string|max:50',
            'guru_id' => 'nullable|exists:gurus,id',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'kapasitas' => 'nullable|integer|min:1|max:100',
            'keterangan' => 'nullable|string'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'guru_id' => $request->guru_id, // Simpan ID guru
            'wali_kelas' => $request->guru_id ? Guru::find($request->guru_id)->nama : null, // Simpan nama guru
            'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
            'kapasitas' => $request->kapasitas ?? 30,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/kelas')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    // Menampilkan detail kelas
    public function show($id)
    {
        $kelas = Kelas::with(['guru', 'tahunPelajaran'])->findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    // Menampilkan form edit kelas
    public function edit($id)
    {
        // Hanya admin yang bisa edit
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data!');
        }
        
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::orderBy('nama')->get();
        $tahunPelajarans = TahunPelajaran::orderBy('tahun', 'desc')->get();

        return view('kelas.edit', compact('kelas', 'gurus', 'tahunPelajarans'));
    }

    // Mengupdate data kelas
    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa update
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data!');
        }
        
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|in:VII,VIII,IX',
            'jurusan' => 'nullable|string|max:50',
            'guru_id' => 'nullable|exists:gurus,id',
            'tahun_pelajaran_id' => 'required|exists:tahun_pelajarans,id',
            'kapasitas' => 'nullable|integer|min:1|max:100',
            'keterangan' => 'nullable|string'
        ]);

        $data = [
            'nama_kelas' => $request->nama_kelas,
            'tingkat' => $request->tingkat,
            'jurusan' => $request->jurusan,
            'guru_id' => $request->guru_id,
            'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
            'kapasitas' => $request->kapasitas ?? 30,
            'keterangan' => $request->keterangan
        ];

        // Update wali_kelas dengan nama guru jika guru_id diisi
        if ($request->guru_id) {
            $guru = Guru::find($request->guru_id);
            $data['wali_kelas'] = $guru ? $guru->nama : null;
        } else {
            $data['wali_kelas'] = null;
        }

        $kelas->update($data);

        return redirect('/kelas')->with('success', 'Data kelas berhasil diperbarui!');
    }

    // Menghapus data kelas
    public function destroy($id)
    {
        // Hanya admin yang bisa hapus
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data!');
        }
        
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect('/kelas')->with('success', 'Data kelas berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    // Menampilkan semua data mata pelajaran
    public function index(Request $request)
    {
        $search = $request->search;

        $mataPelajaran = MataPelajaran::when($search, function ($query) use ($search) {
            $query->where('nama_mapel', 'like', "%{$search}%")
                  ->orWhere('kode_mapel', 'like', "%{$search}%")
                  ->orWhere('kelompok', 'like', "%{$search}%");
        })
        ->orderBy('nama_mapel')
        ->paginate(10)
        ->withQueryString();

        return view('mata-pelajaran.index', compact('mataPelajaran'));
    }

    // Menampilkan form tambah mata pelajaran
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }

        return view('mata-pelajaran.create');
    }

    // Menyimpan data mata pelajaran baru
    public function store(Request $request)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }

        $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kelompok' => 'nullable|string|max:100',
            'jam_pelajaran' => 'required|integer|min:1|max:20',
            'is_active' => 'required|boolean',
        ]);

        MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kelompok' => $request->kelompok,
            'jam_pelajaran' => $request->jam_pelajaran,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    // Menampilkan detail mata pelajaran
    public function show(string $id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.show', compact('mataPelajaran'));
    }

    // Menampilkan form edit mata pelajaran
    public function edit(string $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data!');
        }

        $mataPelajaran = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.edit', compact('mataPelajaran'));
    }

    // Mengupdate data mata pelajaran
    public function update(Request $request, string $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data!');
        }

        $mataPelajaran = MataPelajaran::findOrFail($id);

        $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:255',
            'kelompok' => 'nullable|string|max:100',
            'jam_pelajaran' => 'required|integer|min:1|max:20',
            'is_active' => 'required|boolean',
        ]);

        $mataPelajaran->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'kelompok' => $request->kelompok,
            'jam_pelajaran' => $request->jam_pelajaran,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    // Menghapus data mata pelajaran
    public function destroy(string $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data!');
        }

        $mataPelajaran = MataPelajaran::findOrFail($id);
        $mataPelajaran->delete();

        return redirect()->route('mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil dihapus!');
    }
}

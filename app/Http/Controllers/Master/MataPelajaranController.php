<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataPelajaranController extends Controller
{
    // Menampilkan semua data mata pelajaran (server-side DataTables)
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MataPelajaran::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('status', function ($item) {
                    return $item->is_active
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-secondary">Tidak Aktif</span>';
                })
                ->addColumn('aksi', function ($item) {
                    $btn = '';
                    if (auth()->user()->role == 'admin') {
                        $btn .= '<a href="' . route('mata-pelajaran.edit', $item->id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                        $btn .= '<button type="button" class="btn btn-danger btn-sm btn-hapus-mapel" data-id="' . $item->id . '" data-nama="' . e($item->nama_mapel) . '">Hapus</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['status', 'aksi'])
                ->make(true);
        }

        return view('mata-pelajaran.index');
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

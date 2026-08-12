<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class TahunPelajaranController extends Controller
{
    public function index()
    {
        $tahunPelajaran = TahunPelajaran::orderBy('tahun', 'desc')->paginate(10);

        return view('tahun-pelajaran.index', compact('tahunPelajaran'));
    }

    public function create()
    {
        return view('tahun-pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        TahunPelajaran::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Tahun pelajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahunPelajaran = TahunPelajaran::findOrFail($id);

        return view('tahun-pelajaran.edit', compact('tahunPelajaran'));
    }

    public function update(Request $request, $id)
    {
        $tahunPelajaran = TahunPelajaran::findOrFail($id);

        $request->validate([
            'tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $tahunPelajaran->update([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Tahun pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tahunPelajaran = TahunPelajaran::findOrFail($id);

        $tahunPelajaran->delete();

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Tahun pelajaran berhasil dihapus.');
    }
}
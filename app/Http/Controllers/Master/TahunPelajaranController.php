<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class TahunPelajaranController extends Controller
{
    public function index()
    {
        $tahunPelajaran = TahunPelajaran::latest()->paginate(10);

        return view('tahun-pelajaran.index', compact('tahunPelajaran'));
    }

    public function create()
    {
        return view('tahun-pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'is_active' => 'required'
        ]);

        if ($request->is_active == 1) {
            TahunPelajaran::query()->update([
                'is_active' => 0
            ]);
        }

        TahunPelajaran::create([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Tahun Pelajaran berhasil ditambahkan.');
    }

    public function edit(TahunPelajaran $tahun_pelajaran)
    {
        return view('tahun-pelajaran.edit', compact('tahun_pelajaran'));
    }

    public function update(Request $request, TahunPelajaran $tahun_pelajaran)
    {
        $request->validate([
            'tahun' => 'required',
            'semester' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'is_active' => 'required'
        ]);

        if ($request->is_active == 1) {
            TahunPelajaran::query()->update([
                'is_active' => 0
            ]);
        }

        $tahun_pelajaran->update([
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy(TahunPelajaran $tahun_pelajaran)
    {
        $tahun_pelajaran->delete();

        return redirect()
            ->route('tahun-pelajaran.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
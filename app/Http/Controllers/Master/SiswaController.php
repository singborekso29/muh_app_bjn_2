<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    // Menampilkan semua data siswa
    public function index(Request $request)
{
    $query = Siswa::query();

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('nisn', 'like', "%{$search}%")
              ->orWhere('nik', 'like', "%{$search}%")
              ->orWhere('jenis_kelamin', 'like', "%{$search}%");

        });

    }

    $siswa = $query
                ->orderBy('nama')
                ->paginate(10)
                ->withQueryString();
        
        // Jika role siswa, tampilkan view khusus siswa
        if (auth()->user()->role == 'siswa') {
            return view('siswa.index', compact('siswa'));
        }
        
        // Jika role guru, tampilkan view khusus guru
        if (auth()->user()->role == 'guru') {
            return view('siswa.index', compact('siswa'));
        }
        
        // Untuk admin, tampilkan view dengan semua tombol
        return view('siswa.index', compact('siswa'));
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        // Hanya admin yang bisa tambah
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        return view('siswa.create');
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        // Hanya admin yang bisa menyimpan
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|string|unique:siswas,nisn',
            'nik' => 'required|string|unique:siswas,nik',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer|min:1|max:100',
            'agama' => 'required',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'jumlah_saudara' => 'required|integer|min:0',
            'asal_sekolah' => 'required|string|max:255',
            'diterima_di_sekolah' => 'required|string',
            'no_ijazah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $nama_file = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_file = time() . '-' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_siswa'), $nama_file);
        }

        Siswa::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'agama' => $request->agama,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'jumlah_saudara' => $request->jumlah_saudara,
            'asal_sekolah' => $request->asal_sekolah,
            'diterima_di_sekolah' => $request->diterima_di_sekolah,
            'no_ijazah' => $request->no_ijazah,
            'alamat' => $request->alamat,
            'foto' => $nama_file
        ]);

        return redirect('/siswa')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Menampilkan detail siswa (untuk admin dan guru)
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        // Jika role siswa, tampilkan view khusus siswa
        if (auth()->user()->role == 'siswa') {
            return view('siswa.show-siswa', compact('siswa'));
        }
        
        // Jika role guru, tampilkan view khusus guru
        if (auth()->user()->role == 'guru') {
            return view('siswa.show-siswa', compact('siswa'));
        }
        
        // Untuk admin, tampilkan view dengan semua tombol
        return view('siswa.show-siswa', compact('siswa'));
    }

    // Menampilkan detail siswa untuk role siswa (khusus)
    public function showSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show-siswa', compact('siswa'));
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        // Hanya admin yang bisa edit
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data!');
        }
        
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    // Mengupdate data siswa
    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa update
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data!');
        }
        
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|string|unique:siswas,nisn,'.$id,
            'nik' => 'required|string|unique:siswas,nik,'.$id,
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer|min:1|max:100',
            'agama' => 'required',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'jumlah_saudara' => 'required|integer|min:0',
            'asal_sekolah' => 'required|string|max:255',
            'diterima_di_sekolah' => 'required|string',
            'no_ijazah' => 'required|string|max:255',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->except('_token', '_method', 'foto');

        if ($request->hasFile('foto')) {
            if ($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto))) {
                unlink(public_path('foto_siswa/' . $siswa->foto));
            }

            $file = $request->file('foto');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('foto_siswa'), $fileName);
            $data['foto'] = $fileName;
        }

        $siswa->update($data);

        return redirect('/siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Menghapus data siswa
    public function destroy($id)
    {
        // Hanya admin yang bisa hapus
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data!');
        }
        
        $siswa = Siswa::findOrFail($id);

        if ($siswa->foto && file_exists(public_path('foto_siswa/' . $siswa->foto))) {
            unlink(public_path('foto_siswa/' . $siswa->foto));
        }

        $siswa->delete();

        return redirect('/siswa')->with('success', 'Data siswa berhasil dihapus!');
    }

    // Menampilkan profil siswa yang sedang login
    public function profile()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            $siswa = Siswa::where('nama', auth()->user()->name)->first();
        }
        
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan. Hubungi administrator.');
        }
        
        return view('siswa.profile', compact('siswa'));
    }

    // Cetak PDF profil siswa
    public function cetakProfilePDF()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        
        if (!$siswa) {
            $siswa = Siswa::where('nama', auth()->user()->name)->first();
        }
        
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan. Hubungi administrator.');
        }
        
        $pdf = Pdf::loadView('siswa.cetak-pdf', compact('siswa'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('profil-siswa-'.$siswa->nama.'.pdf');
    }

    // Cetak PDF semua data siswa (hanya admin)
    public function cetakSemuaPDF()
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses!');
        }
        
        $siswa = Siswa::all();
        $pdf = Pdf::loadView('siswa.cetak-semua-pdf', compact('siswa'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('semua-data-siswa.pdf');
    }

    // Cetak PDF satu siswa
    public function cetakPDF($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $pdf = Pdf::loadView('siswa.cetak-pdf', compact('siswa'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('data-siswa-'.$siswa->nama.'.pdf');
    }
}
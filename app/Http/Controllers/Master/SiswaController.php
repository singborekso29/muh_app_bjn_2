<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    // Menampilkan halaman data siswa (server-side DataTables)
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Siswa::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('foto', function ($item) {
                    if ($item->foto && file_exists(public_path('foto_siswa/' . $item->foto))) {
                        return '<img src="' . asset('foto_siswa/' . $item->foto) . '" width="45" height="45" style="object-fit:cover;border-radius:50%;">';
                    }
                    return '<i class="fas fa-user-circle" style="font-size:35px;color:#ccc;"></i>';
                })
                ->addColumn('aksi', function ($item) {
                    $btn = '<a href="' . route('siswa.show', $item->id) . '" class="btn btn-info btn-sm text-white">Detail</a> ';
                    $btn .= '<a href="' . route('siswa.cetak-pdf', $item->id) . '" class="btn btn-danger btn-sm" target="_blank">PDF</a> ';

                    if (auth()->user()->role == 'admin') {
                        $btn .= '<a href="' . route('siswa.edit', $item->id) . '" class="btn btn-warning btn-sm text-white">Edit</a> ';
                        $btn .= '<button type="button" class="btn btn-danger btn-sm btn-hapus-siswa" data-id="' . $item->id . '" data-nama="' . e($item->nama) . '">Hapus</button>';
                    }

                    return $btn;
                })
                ->rawColumns(['foto', 'aksi'])
                ->make(true);
        }

        return view('siswa.index');
    }

    // Menampilkan form tambah siswa
    public function create()
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        return view('siswa.create');
    }

    // Menyimpan data siswa baru
    public function store(Request $request)
    {
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

    // Menampilkan detail siswa
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        if (auth()->user()->role == 'siswa') {
            return view('siswa.show-siswa', compact('siswa'));
        }
        
        if (auth()->user()->role == 'guru') {
            return view('siswa.show-siswa', compact('siswa'));
        }
        
        return view('siswa.show-siswa', compact('siswa'));
    }

    public function showSiswa($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.show-siswa', compact('siswa'));
    }

    // Menampilkan form edit siswa
    public function edit($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data!');
        }
        
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    // Mengupdate data siswa
    public function update(Request $request, $id)
    {
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

    // ============================================
    // PROFILE SISWA (HANYA 1 METHOD)
    // ============================================
    public function profile()
    {
        $user = auth()->user();
        $siswa = Siswa::where('user_id', $user->id)->first();
        
        if (!$siswa) {
            $siswa = Siswa::where('nama', $user->name)->first();
        }
        
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan. Hubungi administrator.');
        }
        
        return view('siswa.profile', compact('siswa'));
    }

    // ============================================
    // CETAK PROFILE PDF (HANYA 1 METHOD)
    // ============================================
    public function cetakProfilePDF()
    {
        $user = auth()->user();
        $siswa = Siswa::where('user_id', $user->id)->first();
        
        if (!$siswa) {
            $siswa = Siswa::where('nama', $user->name)->first();
        }
        
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan. Hubungi administrator.');
        }
        
        $pdf = Pdf::loadView('siswa.cetak-pdf', compact('siswa'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('profil-siswa-'.$siswa->nama.'.pdf');
    }

    // ============================================
    // Cetak PDF semua data siswa (hanya admin dan guru)
    // ============================================
    

    public function cetakSemuaPDF()
    {
        // Hanya admin dan guru yang bisa cetak semua
        if (auth()->user()->role != 'admin' && auth()->user()->role != 'guru') {
            abort(403, 'Anda tidak memiliki akses!');
        }
        
        $siswa = Siswa::all();
        $pdf = Pdf::loadView('siswa.cetak-semua-pdf', compact('siswa'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('semua-data-siswa.pdf');
    }
    public function cetakPDF($id)
{
    $siswa = Siswa::findOrFail($id);

    $fotoBase64 = null;

    if ($siswa->foto) {
        $fotoPath = public_path('foto_siswa/' . $siswa->foto);

        if (file_exists($fotoPath)) {
            $fotoBase64 = 'data:image/' .
                strtolower(pathinfo($fotoPath, PATHINFO_EXTENSION)) .
                ';base64,' .
                base64_encode(file_get_contents($fotoPath));
        }
    }

    $pdf = Pdf::setOption([
        'isRemoteEnabled' => false,
        'isHtml5ParserEnabled' => true,
        'isPhpEnabled' => false,
        'dpi' => 96,
        'defaultFont' => 'Arial',
    ])->loadView('siswa.cetak-pdf', [
        'siswa' => $siswa,
        'fotoBase64' => $fotoBase64,
    ]);

    $pdf->setPaper('A4', 'portrait');

    return $pdf->stream(
        'data-siswa-' . preg_replace('/[^A-Za-z0-9\-]/', '-', $siswa->nama) . '.pdf'
    );
}

    // Dashboard siswa
public function dashboard()
{
    $user = auth()->user();
    $myAbsensi = Absensi::where('user_id', $user->id)
        ->where('tanggal', date('Y-m-d'))
        ->first();

    return view('dashboard.siswa', compact('myAbsensi'));
}
}
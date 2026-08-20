<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    // Menampilkan semua data guru
    public function index(Request $request)
{
    $search = $request->search;

    $guru = Guru::when($search, function ($query) use ($search) {

        $query->where('nama', 'like', "%{$search}%")
              ->orWhere('nip', 'like', "%{$search}%")
              ->orWhere('mapel', 'like', "%{$search}%");

    })
    ->orderBy('nama')
    ->paginate(10)
    ->withQueryString();
    
    // Jika role siswa, tampilkan view khusus siswa
    if (auth()->user()->role == 'siswa') {
        return view('guru.index', compact('guru'));
    }
    
    // Jika role guru, tampilkan view khusus guru (hanya lihat)
    if (auth()->user()->role == 'guru') {
        return view('guru.index', compact('guru'));
    }
    
    // Untuk admin, tampilkan view dengan semua tombol
    return view('guru.index', compact('guru'));
}

    // Menampilkan form tambah guru
    public function create()
    {
        // Hanya admin yang bisa tambah
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        return view('guru.create');
    }

    // Menyimpan data guru baru
    public function store(Request $request)
    {
        // Hanya admin yang bisa menyimpan
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data!');
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'status_kepegawaian' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

                // Konversi tanggal ke format YYYY-MM-DD
            $tanggal_lahir = null;
            if ($request->tanggal_lahir) {
                $tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
            }

          
        // Upload foto
        $nama_file = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_file = time() . '-' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_guru'), $nama_file);
        }

        // Simpan ke database
        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'jurusan' => $request->jurusan,
            'status_kepegawaian' => $request->status_kepegawaian,
            'mapel' => $request->mapel,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'foto' => $nama_file
        ]);

        return redirect('/guru')->with('success', 'Data guru berhasil ditambahkan!');
    }


    /**
 * Membuat akun login untuk guru
 */
public function buatAkun($id)
{
    // Hanya admin
    if (auth()->user()->role != 'admin') {
        abort(403, 'Anda tidak memiliki akses untuk membuat akun guru!');
    }

    // Ambil data guru
    $guru = Guru::findOrFail($id);

    // Cek apakah guru sudah mempunyai akun
    if ($guru->user_id) {
        return redirect('/guru')
            ->with('error', 'Guru ' . $guru->nama . ' sudah memiliki akun login.');
    }

    /*
    |--------------------------------------------------------------------------
    | Buat username dari nama guru
    |--------------------------------------------------------------------------
    */

    // Contoh:
    // "Fernanda Chairunnisa, S.Pd, Gr"
    // menjadi:
    // "fernandachairunnisa"
    $usernameDasar = Str::of($guru->nama)
        ->lower()
        ->replaceMatches('/[^a-z0-9]+/', '')
        ->toString();

    $username = $usernameDasar;

    $counter = 1;

    // Pastikan username unik
    while (User::where('username', $username)->exists()) {

        $username = $usernameDasar . $counter;

        $counter++;
    }

    /*
    |--------------------------------------------------------------------------
    | Buat email otomatis
    |--------------------------------------------------------------------------
    */

    $emailDasar = $username . '@sekolah.com';

    $email = $emailDasar;

    $counter = 1;

    // Pastikan email unik
    while (User::where('email', $email)->exists()) {

        $email = $username . $counter . '@sekolah.com';

        $counter++;
    }

    /*
    |--------------------------------------------------------------------------
    | Password sementara
    |--------------------------------------------------------------------------
    */

    $passwordSementara = 'Sekolah@123';

    /*
    |--------------------------------------------------------------------------
    | Buat User
    |--------------------------------------------------------------------------
    */

    $user = User::create([
        'name' => $guru->nama,
        'username' => $username,
        'email' => $email,
        'password' => Hash::make($passwordSementara),
        'role' => 'guru',
        'is_active' => true,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Hubungkan User dengan Guru
    |--------------------------------------------------------------------------
    */

    $guru->update([
        'user_id' => $user->id,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Kembali ke halaman Guru
    |--------------------------------------------------------------------------
    */

    return redirect('/guru')->with(
        'success',
        'Akun guru berhasil dibuat. ' .
        'Username: ' . $username .
        ' | Password sementara: ' . $passwordSementara
    );
}




    // Menampilkan detail guru
    public function show($id)
{
    $guru = Guru::findOrFail($id);
    
    // Jika role siswa, tampilkan view khusus siswa
    if (auth()->user()->role == 'siswa') {
        return view('guru.show-siswa', compact('guru'));
    }
    
    // Jika role guru, tampilkan view khusus guru (hanya lihat)
    if (auth()->user()->role == 'guru') {
        return view('guru.show', compact('guru'));
    }
    
    // Untuk admin, tampilkan view dengan semua tombol
    return view('guru.show', compact('guru'));
}

    // Menampilkan form edit guru
    public function edit($id)
    {
        // Hanya admin yang bisa edit
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data!');
        }
        
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    // Mengupdate data guru
    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa update
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate data!');
        }
        
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip,'.$id.'|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'status_kepegawaian' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->except('_token', '_method', 'foto');

        // Konversi tanggal ke format YYYY-MM-DD
        if (isset($data['tanggal_lahir']) && $data['tanggal_lahir']) {
            $data['tanggal_lahir'] = date('Y-m-d', strtotime($data['tanggal_lahir']));
        }

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto))) {
                unlink(public_path('foto_guru/' . $guru->foto));
            }

            $file = $request->file('foto');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('foto_guru'), $fileName);
            $data['foto'] = $fileName;
        }

        $guru->update($data);

        return redirect('/guru')->with('success', 'Data guru berhasil diperbarui!');
    }

    // Menghapus data guru
    public function destroy($id)
    {
        // Hanya admin yang bisa hapus
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data!');
        }
        
        $guru = Guru::findOrFail($id);

        if ($guru->foto && file_exists(public_path('foto_guru/' . $guru->foto))) {
            unlink(public_path('foto_guru/' . $guru->foto));
        }

        $guru->delete();

        return redirect('/guru')->with('success', 'Data guru berhasil dihapus!');
    }

    // Download berkas guru
    public function downloadBerkas($id)
    {
        $guru = Guru::findOrFail($id);
        
        if ($guru->berkas && file_exists(public_path('berkas_guru/' . $guru->berkas))) {
            return response()->download(public_path('berkas_guru/' . $guru->berkas));
        }
        
        return redirect('/guru')->with('error', 'File tidak ditemukan!');
    }

    // Cetak PDF satu guru
    public function cetakPDF($id)
    {
        $guru = Guru::findOrFail($id);
        $pdf = Pdf::loadView('guru.cetak-pdf', compact('guru'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('data-guru-'.$guru->nama.'.pdf');
    }

    // Cetak PDF semua guru
    public function cetakSemuaPDF()
    {
        $guru = Guru::all();
        $pdf = Pdf::loadView('guru.cetak-semua-pdf', compact('guru'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('semua-data-guru.pdf');
    }
}
<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\KelasSiswa;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class PembagianKelasController extends Controller
{
    /**
     * Halaman Pembagian Siswa
     */
    public function index(Request $request)
    {
        // Pastikan hanya admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | Semua Tahun Pelajaran
        |--------------------------------------------------------------------------
        */
        $tahunPelajarans = TahunPelajaran::orderByDesc('id')->get();

        /*
        |--------------------------------------------------------------------------
        | Tahun Pelajaran Aktif
        |--------------------------------------------------------------------------
        */
        $tahunPelajaranAktif = TahunPelajaran::where('is_active', 1)->first();

        /*
        |--------------------------------------------------------------------------
        | Tahun Pelajaran yang dipilih
        |--------------------------------------------------------------------------
        */
        $tahunPelajaranId = $request->input('tahun_pelajaran_id')
            ?? optional($tahunPelajaranAktif)->id;

        /*
        |--------------------------------------------------------------------------
        | Pastikan tahun pelajaran tersedia
        |--------------------------------------------------------------------------
        */
        if (!$tahunPelajaranId && $tahunPelajarans->count() > 0) {
            $tahunPelajaranId = $tahunPelajarans->first()->id;
        }

        /*
        |--------------------------------------------------------------------------
        | Daftar kelas hanya untuk tahun pelajaran yang dipilih
        |--------------------------------------------------------------------------
        */
        $daftarKelas = collect();

        if ($tahunPelajaranId) {
            $daftarKelas = Kelas::with(['tahunPelajaran', 'guru'])
                ->where('tahun_pelajaran_id', $tahunPelajaranId)
                ->orderBy('tingkat')
                ->orderBy('nama_kelas')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Kelas yang dipilih
        |--------------------------------------------------------------------------
        */
        $kelasId = $request->input('kelas_id');

        $kelasTerpilih = null;
        $siswaDiKelasIni = collect();
        $siswaBelumPunyaKelas = collect();

        // Jika kelas dipilih
if ($kelasId && $tahunPelajaranId) {

    /*
    |--------------------------------------------------------------------------
    | Pastikan kelas sesuai tahun pelajaran
    |--------------------------------------------------------------------------
    */
    $kelasTerpilih = Kelas::where('id', $kelasId)
        ->where('tahun_pelajaran_id', $tahunPelajaranId)
        ->firstOrFail();


    /*
    |--------------------------------------------------------------------------
    | Siswa yang sudah berada di kelas tersebut
    |--------------------------------------------------------------------------
    */
    $siswaDiKelasIni = Siswa::whereHas('kelas', function ($query) use (
        $kelasId,
        $tahunPelajaranId
    ) {
        $query->where('kelas.id', $kelasId)
            ->where(
                'kelas_siswa.tahun_pelajaran_id',
                $tahunPelajaranId
            );
    })
    ->orderBy('nama')
    ->get();


    /*
    |--------------------------------------------------------------------------
    | Siswa yang belum memiliki kelas pada tahun pelajaran tersebut
    |--------------------------------------------------------------------------
    */
    $siswaBelumPunyaKelas = Siswa::whereDoesntHave(
        'kelas',
        function ($query) use ($tahunPelajaranId) {

            $query->where(
                'kelas_siswa.tahun_pelajaran_id',
                $tahunPelajaranId
            );
        }
    )
    ->orderBy('nama')
    ->get();
}

        return view(
            'pembagian-kelas.index',
            compact(
                'tahunPelajarans',
                'tahunPelajaranAktif',
                'tahunPelajaranId',
                'daftarKelas',
                'kelasTerpilih',
                'siswaDiKelasIni',
                'siswaBelumPunyaKelas'
            )
        );
    }


    /**
     * Menambahkan siswa ke kelas
     */
    public function tambahKeKelas(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'tahun_pelajaran_id' => [
                'required',
                'exists:tahun_pelajarans,id'
            ],

            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],

            'siswa_ids' => [
                'required',
                'array',
                'min:1'
            ],

            'siswa_ids.*' => [
                'exists:siswas,id'
            ],
        ]);

        $tahunPelajaranId = $validated['tahun_pelajaran_id'];
        $kelasId = $validated['kelas_id'];
        $siswaIds = $validated['siswa_ids'];

        /*
        |--------------------------------------------------------------------------
        | Pastikan kelas sesuai dengan tahun pelajaran
        |--------------------------------------------------------------------------
        */
        $kelas = Kelas::where('id', $kelasId)
            ->where('tahun_pelajaran_id', $tahunPelajaranId)
            ->first();

        if (!$kelas) {
            return back()
                ->withErrors([
                    'kelas_id' => 'Kelas tidak sesuai dengan tahun pelajaran yang dipilih.'
                ])
                ->withInput();
        }

        $jumlahBerhasil = 0;

        /*
        |--------------------------------------------------------------------------
        | Masukkan siswa satu per satu
        |--------------------------------------------------------------------------
        */
        foreach ($siswaIds as $siswaId) {

            /*
            |--------------------------------------------------------------------------
            | Cek apakah siswa sudah memiliki kelas
            | pada tahun pelajaran tersebut
            |--------------------------------------------------------------------------
            */
            $sudahAda = KelasSiswa::where('siswa_id', $siswaId)
                ->where('tahun_pelajaran_id', $tahunPelajaranId)
                ->exists();

            if ($sudahAda) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan pembagian kelas
            |--------------------------------------------------------------------------
            */
            KelasSiswa::create([
                'siswa_id' => $siswaId,
                'kelas_id' => $kelasId,
                'tahun_pelajaran_id' => $tahunPelajaranId,
                'status' => 'Aktif',
            ]);

            $jumlahBerhasil++;
        }

        /*
        |--------------------------------------------------------------------------
        | Kembali ke halaman pembagian kelas
        |--------------------------------------------------------------------------
        */
        return redirect()->route(
            'pembagian-kelas.index',
            [
                'tahun_pelajaran_id' => $tahunPelajaranId,
                'kelas_id' => $kelasId,
            ]
        )->with(
            'success',
            $jumlahBerhasil . ' siswa berhasil dimasukkan ke kelas.'
        );
    }


    /**
     * Mengeluarkan siswa dari kelas
     */
    public function keluarkanDariKelas(
        Request $request,
        string $siswaId
    ) {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'tahun_pelajaran_id' => [
                'required',
                'exists:tahun_pelajarans,id'
            ],

            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],
        ]);

        $tahunPelajaranId = $validated['tahun_pelajaran_id'];
        $kelasId = $validated['kelas_id'];

        /*
        |--------------------------------------------------------------------------
        | Hapus siswa dari kelas
        |--------------------------------------------------------------------------
        */
        KelasSiswa::where('siswa_id', $siswaId)
            ->where('kelas_id', $kelasId)
            ->where('tahun_pelajaran_id', $tahunPelajaranId)
            ->delete();

        /*
        |--------------------------------------------------------------------------
        | Kembali
        |--------------------------------------------------------------------------
        */
        return redirect()->route(
            'pembagian-kelas.index',
            [
                'tahun_pelajaran_id' => $tahunPelajaranId,
                'kelas_id' => $kelasId,
            ]
        )->with(
            'success',
            'Siswa berhasil dikeluarkan dari kelas.'
        );
    }

    // Menampilkan rekap semua siswa yang sudah dibagi ke kelasnya masing-masing
    public function rekap(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $tahunPelajarans = TahunPelajaran::orderByDesc('id')->get();
        $tahunPelajaranAktif = TahunPelajaran::where('is_active', 1)->first();

        $tahunPelajaranId = $request->input('tahun_pelajaran_id')
            ?? optional($tahunPelajaranAktif)->id
            ?? optional($tahunPelajarans->first())->id;

        $daftarKelas = collect();
        $totalSudahDibagi = 0;
        $totalBelumDibagi = 0;

        if ($tahunPelajaranId) {
            $daftarKelas = Kelas::with(['siswa' => function ($query) use ($tahunPelajaranId) {
                    $query->wherePivot('tahun_pelajaran_id', $tahunPelajaranId);
                }])
                ->where('tahun_pelajaran_id', $tahunPelajaranId)
                ->orderBy('tingkat')
                ->orderBy('nama_kelas')
                ->get();

            $totalSudahDibagi = Siswa::whereHas('kelas', function ($query) use ($tahunPelajaranId) {
                $query->where('kelas_siswa.tahun_pelajaran_id', $tahunPelajaranId);
            })->count();

            $totalBelumDibagi = Siswa::whereDoesntHave('kelas', function ($query) use ($tahunPelajaranId) {
                $query->where('kelas_siswa.tahun_pelajaran_id', $tahunPelajaranId);
            })->count();
        }

        return view('pembagian-kelas.rekap', compact(
            'tahunPelajarans',
            'tahunPelajaranId',
            'daftarKelas',
            'totalSudahDibagi',
            'totalBelumDibagi'
        ));
    }
}
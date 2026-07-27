<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\TahunPelajaran;

use Illuminate\Http\Request;

class PembagianSiswaController extends Controller
{

    public function index()
    {

        $tahun = TahunPelajaran::where('is_active',1)->first();

        $kelas = Kelas::orderBy('tingkat')
                        ->orderBy('nama_kelas')
                        ->get();

        return view(
            'akademik.pembagian-siswa.index',
            compact(
                'tahun',
                'kelas'
            )
        );

    }

    public function loadData(Request $request)
{

    $kelas = $request->kelas;

    $tahun = $request->tahun;

    /*
    |--------------------------------------------------------------------------
    | siswa yang BELUM mempunyai kelas
    |--------------------------------------------------------------------------
    */

    $belum = Siswa::whereDoesntHave('kelasSiswa', function ($q) use ($tahun){

        $q->where('tahun_pelajaran_id',$tahun);

    })
    ->orderBy('nama')
    ->get();

    /*
    |--------------------------------------------------------------------------
    | siswa yang SUDAH di kelas
    |--------------------------------------------------------------------------
    */

    $sudah = KelasSiswa::with('siswa')

        ->where('kelas_id',$kelas)

        ->where('tahun_pelajaran_id',$tahun)

        ->get();

    return response()->json([

        'belum'=>$belum,

        'sudah'=>$sudah

    ]);

}

}
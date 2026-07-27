<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{

    protected $table='kelas_siswa';

    protected $fillable=[

        'kelas_id',

        'siswa_id',

        'tahun_pelajarans_id',

        'status'

    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function tahun()
    {
        return $this->belongsTo(TahunPelajaran::class,'tahun_pelajarans_id');
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajarans';

    protected $fillable = [
        'kelas_id',
        'mata_pelajaran_id',
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'tahun_pelajaran_id',
        'keterangan'
    ];

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Mata Pelajaran
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke Tahun Pelajaran
    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tahun_pelajaran_id');
    }
}
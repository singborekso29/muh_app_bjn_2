<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'tahun_pelajaran_id',
        'jurusan',
        'kapasitas',
        'guru_id',
        'wali_kelas',
        'keterangan',
    ];

    /**
     * Relasi ke Tahun Pelajaran
     */
    public function tahunPelajaran()
    {
        return $this->belongsTo(
            TahunPelajaran::class,
            'tahun_pelajaran_id'
        );
    }

    /**
     * Relasi ke Guru
     */
    public function guru()
    {
        return $this->belongsTo(
            Guru::class,
            'guru_id'
        );
    }

    /**
     * Relasi ke pembagian siswa
     * melalui tabel kelas_siswa
     */
    public function kelasSiswa()
    {
        return $this->hasMany(
            KelasSiswa::class,
            'kelas_id'
        );
    }

    /**
     * Relasi many-to-many ke Siswa
     * melalui tabel kelas_siswa
     */
    public function siswa()
    {
        return $this->belongsToMany(
            Siswa::class,
            'kelas_siswa',
            'kelas_id',
            'siswa_id'
        )->withPivot([
            'tahun_pelajaran_id',
            'status',
        ])->withTimestamps();
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nis',
        'nisn',
        'nik',
        'kelas',
        'jenis_kelamin',
        'umur',
        'agama',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'jumlah_saudara',
        'asal_sekolah',
        'diterima_di_sekolah',
        'no_ijazah',
        'alamat',
        'foto',
        'user_id',
    ];

        public function kelasSiswa()
    {
        return $this->hasMany(
            KelasSiswa::class,
            'siswa_id'
        );
    }

    public function kelas()
    {
        return $this->belongsToMany(
            Kelas::class,
            'kelas_siswa',
            'siswa_id',
            'kelas_id'
        )
        ->withPivot([
            'tahun_pelajaran_id',
            'status',
        ])
        ->withTimestamps();
    }
}
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
        'user_id'  // ← TAMBAHKAN INI
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
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
        'jurusan',
        'guru_id',
        'wali_kelas',
        'tahun_pelajaran_id',
        'kapasitas',
        'keterangan'
    ];

    // Relasi ke Guru (Wali Kelas)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke Tahun Pelajaran
    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tahun_pelajaran_id');
    }

    public function kelasSiswa()
{
    return $this->hasMany(KelasSiswa::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'kelas_id',
        'status_pembagian'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kelas (Many-to-Many via tabel kelas_siswa)
    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'siswa_id');
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

    // Relasi ke Absensi (via user_id)
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id', 'user_id');
    }

    // Relasi ke Kelas (langsung via kelas_id - untuk siswa yang sudah punya kelas tetap)
    public function kelasSekarang()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Accessor untuk menampilkan nama lengkap dengan kelas
    public function getNamaLengkapAttribute()
    {
        $kelas = $this->kelasSekarang ? $this->kelasSekarang->nama_kelas : 'Belum Ada Kelas';
        return $this->nama . ' - ' . $kelas;
    }

    // Scope untuk filter berdasarkan kelas
    public function scopeByKelas($query, $kelasId)
    {
        return $query->where('kelas_id', $kelasId);
    }

    // Scope untuk filter berdasarkan tingkat
    public function scopeByTingkat($query, $tingkat)
    {
        return $query->whereHas('kelasSekarang', function ($q) use ($tingkat) {
            $q->where('tingkat', $tingkat);
        });
    }

    public function nilaiMapel(): HasMany
{
    return $this->hasMany(
        NilaiMapel::class,
        'siswa_id'
    );
}

public function capaianKompetensi(): HasMany
{
    return $this->hasMany(
        CapaianKompetensi::class,
        'siswa_id'
    );
}

public function catatanWaliKelas(): HasMany
{
    return $this->hasMany(
        CatatanWaliKelas::class,
        'siswa_id'
    );
}
}
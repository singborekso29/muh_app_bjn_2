<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'jurusan',
        'status_kepegawaian',
        'mapel',
        'no_telepon',
        'alamat',
        'foto',
        'berkas'
    ];

    // ============================================
    // RELASI
    // ============================================

    /**
     * Relasi ke User (One-to-One)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Absensi (One-to-Many)
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id', 'user_id');
    }

    /**
     * Relasi ke Penilaian (One-to-Many)
     */
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class, 'guru_id');
    }

    /**
     * Relasi ke Catatan Wali Kelas (One-to-Many)
     */
    public function catatanWaliKelas(): HasMany
    {
        return $this->hasMany(CatatanWaliKelas::class, 'guru_id');
    }

    /**
     * Relasi ke Kelas (Wali Kelas)
     */
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }

    /**
     * Relasi ke Jadwal Pelajaran
     */
    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'guru_id');
    }

    /**
     * Relasi ke Nilai (One-to-Many)
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'guru_id');
    }

    // ============================================
    // ACCESSOR
    // ============================================

    /**
     * Nama lengkap guru
     */
    public function getNamaLengkapAttribute()
    {
        return $this->nama;
    }

    /**
     * Nama dengan gelar (opsional)
     */
    public function getNamaWithGelarAttribute()
    {
        $gelar = $this->pendidikan_terakhir ?? '';
        if ($gelar) {
            return $this->nama . ', ' . $gelar;
        }
        return $this->nama;
    }

    /**
     * Status kepegawaian badge
     */
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'PNS' => 'primary',
            'Honorer' => 'warning',
            'GTY' => 'success',
            'Kontrak' => 'info'
        ];

        $color = $colors[$this->status_kepegawaian] ?? 'secondary';
        return '<span class="badge bg-' . $color . '">' . $this->status_kepegawaian . '</span>';
    }

    // ============================================
    // SCOPE
    // ============================================

    /**
     * Scope untuk filter berdasarkan mapel
     */
    public function scopeByMapel($query, $mapel)
    {
        return $query->where('mapel', 'like', '%' . $mapel . '%');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_kepegawaian', $status);
    }
}
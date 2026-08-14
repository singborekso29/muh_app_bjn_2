<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'role',
        'user_id',
        'nama',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan',
        'catatan'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope untuk filter berdasarkan role
    public function scopeSiswa($query)
    {
        return $query->where('role', 'siswa');
    }

    public function scopeGuru($query)
    {
        return $query->where('role', 'guru');
    }

    public function scopeKaryawan($query)
    {
        return $query->where('role', 'karyawan');
    }

    // Accessor untuk menampilkan status dengan badge
    public function getStatusBadgeAttribute()
    {
        $colors = [
            'hadir' => 'success',
            'izin' => 'warning',
            'sakit' => 'info',
            'alfa' => 'danger'
        ];

        return '<span class="badge bg-' . ($colors[$this->status] ?? 'secondary') . '">' . ucfirst($this->status) . '</span>';
    }

    // Accessor untuk jam masuk dengan format
    public function getJamMasukFormattedAttribute()
    {
        return $this->jam_masuk ? date('H:i', strtotime($this->jam_masuk)) : '-';
    }

    public function getJamPulangFormattedAttribute()
    {
        return $this->jam_pulang ? date('H:i', strtotime($this->jam_pulang)) : '-';
    }
}
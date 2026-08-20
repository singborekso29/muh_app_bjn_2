<?php

namespace App\Models;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Guru;  // ← PERBAIKI IMPORT (HAPUS \Master\)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
        'qr_code',
        'card_uid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    // ============================================
    // RELASI
    // ============================================

    /**
     * Relasi ke Siswa (One-to-One)
     */
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    /**
     * Relasi ke Guru (One-to-One)
     */
    public function guru()
    {
        return $this->hasOne(Guru::class, 'user_id');
    }

    /**
     * Relasi ke Absensi (One-to-Many)
     */
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id');
    }

    // ❌ HAPUS METHOD INI (TIDAK PERLU)
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // ============================================
    // CEK ROLE
    // ============================================

    /**
     * Cek apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah guru
     */
    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    /**
     * Cek apakah user adalah siswa
     */
    public function isSiswa(): bool
    {
        return $this->role === 'siswa';
    }

    /**
     * Cek apakah user adalah karyawan
     */
    public function isKaryawan(): bool
    {
        return $this->role === 'karyawan';
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // ============================================
    // ACCESSOR & MUTATOR
    // ============================================

    /**
     * Get role label
     */
    public function getRoleLabelAttribute(): string
    {
        $labels = [
            'admin' => 'Administrator',
            'guru' => 'Guru',
            'siswa' => 'Siswa',
            'karyawan' => 'Karyawan'
        ];

        return $labels[$this->role] ?? $this->role;
    }

    /**
     * Get status badge
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->is_active) {
            return '<span class="badge bg-success">Aktif</span>';
        }
        return '<span class="badge bg-danger">Tidak Aktif</span>';
    }

    /**
     * Get nama lengkap dengan role
     */
    public function getNamaWithRoleAttribute(): string
    {
        return $this->name . ' (' . $this->role_label . ')';
    }

    // ============================================
    // SCOPE
    // ============================================

    /**
     * Scope untuk user aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk user tidak aktif
     */
    public function scopeTidakAktif($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // ============================================
    // QR CODE
    // ============================================

    /**
     * Generate QR Code untuk user
     */
    public function generateQRCode()
    {
        if (!$this->qr_code) {
            $this->qr_code = $this->id . '-' . $this->email;
            $this->save();
        }
        return $this->qr_code;
    }
}
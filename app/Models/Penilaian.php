<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $fillable = [
        'tahun_pelajaran_id',
        'semester',
        'kelas_id',
        'mata_pelajaran_id',
        'guru_id',
        'jenis_penilaian',
        'keterangan',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function tahunPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            TahunPelajaran::class,
            'tahun_pelajaran_id'
        );
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(
            Kelas::class,
            'kelas_id'
        );
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            MataPelajaran::class,
            'mata_pelajaran_id'
        );
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(
            Guru::class,
            'guru_id'
        );
    }

    public function nilaiMapel(): HasMany
    {
        return $this->hasMany(
            NilaiMapel::class,
            'penilaian_id'
        );
    }
}
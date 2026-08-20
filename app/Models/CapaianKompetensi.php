<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CapaianKompetensi extends Model
{
    protected $table = 'capaian_kompetensi';

    protected $fillable = [
        'siswa_id',
        'tahun_pelajaran_id',
        'mata_pelajaran_id',
        'semester',
        'capaian',
        'perlu_ditingkatkan',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class,
            'siswa_id'
        );
    }

    public function tahunPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            TahunPelajaran::class,
            'tahun_pelajaran_id'
        );
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            MataPelajaran::class,
            'mata_pelajaran_id'
        );
    }
}
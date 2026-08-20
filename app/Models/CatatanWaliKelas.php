<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanWaliKelas extends Model
{
    protected $table = 'catatan_wali_kelas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_pelajaran_id',
        'guru_id',
        'semester',
        'catatan',
        'sakit',
        'izin',
        'alpa',
        'status_kenaikan',
    ];

    protected $casts = [
        'sakit' => 'integer',
        'izin' => 'integer',
        'alpa' => 'integer',
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

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(
            Kelas::class,
            'kelas_id'
        );
    }

    public function tahunPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            TahunPelajaran::class,
            'tahun_pelajaran_id'
        );
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(
            Guru::class,
            'guru_id'
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiMapel extends Model
{
    protected $table = 'nilai_mapel';

    protected $fillable = [
        'penilaian_id',
        'siswa_id',
        'nilai',
        'nilai_pengetahuan',
        'nilai_keterampilan',
        'nilai_akhir',
        'predikat',
        'deskripsi',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'nilai_pengetahuan' => 'decimal:2',
        'nilai_keterampilan' => 'decimal:2',
        'nilai_akhir' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function penilaian(): BelongsTo
    {
        return $this->belongsTo(
            Penilaian::class,
            'penilaian_id'
        );
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class,
            'siswa_id'
        );
    }
}
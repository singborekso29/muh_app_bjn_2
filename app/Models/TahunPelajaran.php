<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
   protected $fillable = [
        'tahun',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
    ];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];

    public function kelasSiswa()
{
    return $this->hasMany(KelasSiswa::class);
}
    
}
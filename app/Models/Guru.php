<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
{
    return $this->belongsTo(User::class);
}
    // Relasi ke Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'user_id', 'user_id');
    }

}
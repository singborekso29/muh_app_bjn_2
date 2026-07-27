<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_siswa', function (Blueprint $table) {

            $table->id();

            $table->foreignId('siswa_id')
                  ->constrained('siswas')
                  ->cascadeOnDelete();

            $table->foreignId('kelas_id')
                  ->constrained('kelas')
                  ->cascadeOnDelete();

            $table->foreignId('tahun_pelajarans_id')
                  ->constrained('tahun_pelajarans')
                  ->cascadeOnDelete();

            $table->enum('status', [
                'Aktif',
                'Naik',
                'Pindah',
                'Lulus',
                'Keluar'
            ])->default('Aktif');

            $table->timestamps();

            $table->unique([
                'siswa_id',
                'kelas_id',
                'tahun_pelajarans_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_siswa');
    }
};
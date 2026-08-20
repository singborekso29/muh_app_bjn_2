<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();

            // Relasi tahun pelajaran
            $table->foreignId('tahun_pelajaran_id')
                ->constrained('tahun_pelajarans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Semester
            $table->enum('semester', ['ganjil', 'genap']);

            // Relasi kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Relasi mata pelajaran
            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajarans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Guru yang melakukan penilaian
            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Jenis penilaian
            $table->string('jenis_penilaian')->nullable();

            // Keterangan
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // Mencegah penilaian ganda
            $table->unique([
                'tahun_pelajaran_id',
                'semester',
                'kelas_id',
                'mata_pelajaran_id',
                'guru_id',
            ], 'penilaian_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
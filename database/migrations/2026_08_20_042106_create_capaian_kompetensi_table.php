<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capaian_kompetensi', function (Blueprint $table) {
            $table->id();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Tahun Pelajaran
            $table->foreignId('tahun_pelajaran_id')
                ->constrained('tahun_pelajarans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Mata Pelajaran
            $table->foreignId('mata_pelajaran_id')
                ->constrained('mata_pelajarans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Semester
            $table->enum('semester', ['ganjil', 'genap']);

            // Capaian
            $table->text('capaian')->nullable();

            // Kompetensi yang perlu ditingkatkan
            $table->text('perlu_ditingkatkan')->nullable();

            // Status capaian
            $table->string('status')->nullable();

            $table->timestamps();

            $table->unique([
                'siswa_id',
                'tahun_pelajaran_id',
                'mata_pelajaran_id',
                'semester',
            ], 'capaian_kompetensi_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capaian_kompetensi');
    }
};
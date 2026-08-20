<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatan_wali_kelas', function (Blueprint $table) {
            $table->id();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Tahun Pelajaran
            $table->foreignId('tahun_pelajaran_id')
                ->constrained('tahun_pelajarans')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Wali kelas
            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Semester
            $table->enum('semester', ['ganjil', 'genap']);

            // Catatan wali kelas
            $table->text('catatan')->nullable();

            // Sakit
            $table->unsignedInteger('sakit')->default(0);

            // Izin
            $table->unsignedInteger('izin')->default(0);

            // Tanpa keterangan
            $table->unsignedInteger('alpa')->default(0);

            // Status kenaikan kelas
            $table->string('status_kenaikan')->nullable();

            $table->timestamps();

            $table->unique([
                'siswa_id',
                'tahun_pelajaran_id',
                'semester',
            ], 'catatan_wali_kelas_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_wali_kelas');
    }
};
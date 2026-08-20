<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_mapel', function (Blueprint $table) {
            $table->id();

            // Penilaian
            $table->foreignId('penilaian_id')
                ->constrained('penilaian')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Siswa
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Nilai
            $table->decimal('nilai', 5, 2)->nullable();

            // Nilai pengetahuan
            $table->decimal('nilai_pengetahuan', 5, 2)->nullable();

            // Nilai keterampilan
            $table->decimal('nilai_keterampilan', 5, 2)->nullable();

            // Nilai akhir
            $table->decimal('nilai_akhir', 5, 2)->nullable();

            // Predikat A/B/C/D
            $table->string('predikat', 5)->nullable();

            // Deskripsi capaian
            $table->text('deskripsi')->nullable();

            $table->timestamps();

            // Satu siswa hanya boleh mempunyai satu nilai
            // pada satu penilaian
            $table->unique(
                ['penilaian_id', 'siswa_id'],
                'nilai_mapel_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_mapel');
    }
};
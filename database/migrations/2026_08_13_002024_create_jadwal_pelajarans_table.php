<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan')->nullable(); // ← TAMBAHKAN INI
            $table->foreignId('tahun_pelajaran_id')->nullable()->constrained('tahun_pelajarans')->onDelete('set null');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['siswa', 'guru', 'karyawan']);
            $table->unsignedBigInteger('user_id'); // ID dari tabel users
            $table->string('nama');
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alfa'])->default('hadir');
            $table->enum('keterangan', ['masuk', 'terlambat', 'pulang_cepat', ''])->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Index untuk mempercepat query
            $table->index(['tanggal', 'role']);
            $table->index(['user_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('kelas')->nullable(); // Tingkat/nama kelas berupa teks (VII, VIII, IX, dst)
            $table->string('jenis_kelamin')->nullable();
            $table->integer('umur')->nullable();
            $table->string('agama')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('diterima_di_sekolah')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaian_sidang', function (Blueprint $table) {
            $table->id('id_penilaian_sidang');
            $table->unsignedBigInteger('id_mahasiswa_pkl');
            $table->unsignedBigInteger('id_dosen');
            $table->string('posisi')->nullable();
            $table->string('bahasa')->nullable(); // Skor Bahasa dan Tata Tulis Laporan
            $table->string('analisis')->nullable(); // Skor Analisis Masalah
            $table->string('sikap')->nullable(); // Skor Nilai Sikap
            $table->string('komunikasi')->nullable(); // Skor Komunikasi
            $table->string('penyajian')->nullable(); // Skor Sistematika Penyajian
            $table->string('penguasaan')->nullable();
            $table->double('total_nilai');
            $table->timestamps();

            $table->foreign('id_mahasiswa_pkl')->references('id_mahasiswa_pkl')->on('mahasiswa_pkl')->onDelete('cascade');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_sidang');
    }
};

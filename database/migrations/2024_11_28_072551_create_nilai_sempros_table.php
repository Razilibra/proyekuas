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
        Schema::create('nilai_sempros', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('id_pengajuan')->nullable();
            $table->string('jabatan_sidang')->nullable();
            //penelitian

            $table->string('latar_belakang_penelitian')->nullable();
            $table->string('landasan_teori')->nullable();
            $table->string('rumusan_masalah')->nullable();

            //presentasi
            $table->string('penyampaian_materi')->nullable();
            $table->string('pemahaman_materi')->nullable();
            $table->string('ketepatan_jawaban')->nullable();

            //sikap
            $table->string('gaya_bahasa')->nullable();
            $table->string('berpakaian')->nullable();
            $table->string('sikap_mahasiswa')->nullable();

            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pengajuan')->references('id_tugasakhir')->on('pengajuans')->onDelete('cascade');

            $table->string('komentar')->nullable();
            $table->string('total_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sempros');
    }
};

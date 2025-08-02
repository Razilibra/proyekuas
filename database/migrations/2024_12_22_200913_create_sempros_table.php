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
        Schema::create('sempros', function (Blueprint $table) {
            $table->id('id_sempro');
            $table->unsignedBigInteger( 'id_mahasiswa')->nullable();
            $table->unsignedBigInteger( 'id_pengajuan')->nullable();
            $table->string('file_sempro')->nullable();
            $table->unsignedBigInteger('pembimbing_1')->nullable();
            $table->unsignedBigInteger('pembimbing_2')->nullable();
            $table->unsignedBigInteger('penguji_sempro')->nullable();
            $table->unsignedBigInteger('id_sesi')->nullable();
            $table->unsignedBigInteger('id_ruangan')->nullable();
            $table->string('tgl_seminar')->nullable();
            $table->timestamps();

            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onDelete('cascade');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_pengajuan')->references('id_tugasakhir')->on('pengajuans')->onDelete('cascade');
            $table->foreign('pembimbing_1')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('pembimbing_2')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('penguji_sempro')->references('id_dosen')->on('dosens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sempros');
    }
};

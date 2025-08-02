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
        Schema::create('mahasiswa_pkl_log_book', function (Blueprint $table) {
            $table->id('id_mahasiswa_pkl_log_book');
            $table->unsignedBigInteger('id_registrasi_pkl')->nullable();
            $table->date('tanggal_kegiatan_awal');
            $table->date('tanggal_kegiatan_akhir');
            $table->text('kegiatan');
            $table->text('file_dokumentasi');
            $table->text('komentar');
            $table->enum('validasi',['0','1'])->default('0')->comment('0: Belum Validasi, 1: Validasi');

            $table->timestamps();

            $table->foreign('id_registrasi_pkl')->references('id_registrasi_pkl')->on('registrasi_pkl')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_pkl_log_book');
    }
};

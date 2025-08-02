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
        Schema::create('mahasiswa_pkl', function (Blueprint $table) {
            $table->id('id_mahasiswa_pkl');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->text('judul');
            $table->string('ruangan_sidang')->nullable();
            $table->unsignedBigInteger('id_sesi')->nullable();
            $table->unsignedBigInteger('id_tempat_pkl')->nullable();
            $table->unsignedBigInteger('id_registrasi_pkl')->nullable();
            $table->string('tahun_pkl')->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->string('dosen_penguji')->nullable();
            $table->string('pembimbing_pkl')->nullable();
            $table->double('nilai_pembimbing_pkl')->nullable();
            $table->double('nilai_pembimbing_industri')->nullable();
            $table->double('nilai_dosen_penguji')->nullable();
            $table->double('nilai_dosen_pembimbing')->nullable();
            $table->text('dokument_nilai_industri')->nullable() ;
            $table->text('dokument_pkl')->nullable() ;
            $table->text('dokument_pkl_revisi')->nullable() ;
            $table->text('dokument_kuisioner')->nullable() ;
            $table->date('tanggal_sidang')->nullable() ;
            $table->string('rekomendasi')->nullable() ;
            $table->text('informasi_detail')->nullable() ;
            $table->string('total_nilai')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();


            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tempat_pkl')->references('id_tempat_pkl')->on('tempat_pkl')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_registrasi_pkl')->references('id_registrasi_pkl')->on('registrasi_pkl')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_pkl');
    }
};

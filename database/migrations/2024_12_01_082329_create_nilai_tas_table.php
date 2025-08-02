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
        Schema::create('nilai_tas', function (Blueprint $table) {
            $table->id('id_nilai_ta');
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->unsignedBigInteger('id_pengajuan')->nullable();
            $table->string('jabatan_sidang')->nullable();

            //bimbingan
            $table->string('sikap_dan_penampilan')->nullable();
            $table->string('komunikasi_dan_sistematika')->nullable();
            $table->string('penguasaan_materi')->nullable();

            //makalah
            $table->string('identifikasi_masalah_tujuan_dan_kontribusi_penelitian')->nullable();
            $table->string('relevansi_teori')->nullable();
            $table->string('metode_yang_digunakan')->nullable();
            $table->string('hasil_dan_pembahasan')->nullable();
            $table->string('kesimpulan_dan_saran')->nullable();
            $table->string('penggunaan_bahasa_dan_tata_tulis')->nullable();

            //produk
            $table->string('kesesuaian_fungsionalitas_sistem')->nullable();

            $table->string('revisi')->nullable();
            $table->string('total_nilai')->nullable();

            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pengajuan')->references('id_tugasakhir')->on('pengajuans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_tas');
    }
};

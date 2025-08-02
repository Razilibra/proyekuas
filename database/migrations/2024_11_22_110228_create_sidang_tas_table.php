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
        Schema::create('sidang_tas', function (Blueprint $table) {
            $table->id('id_sidang');
            $table->unsignedBigInteger(column: 'id_pengajuan')->nullable();
            $table->unsignedBigInteger(column: 'id_mhs')->nullable();
            $table->unsignedBigInteger(column: 'pembimbing_1')->nullable();
            $table->unsignedBigInteger(column: 'pembimbing_2')->nullable();
            $table->unsignedBigInteger(column: 'sekretaris',)->nullable();
            $table->unsignedBigInteger(column: 'anggota_1',)->nullable();
            $table->unsignedBigInteger(column: 'anggota_2',)->nullable();
            $table->string(column: 'full_ta',)->nullable();
            $table->string(column: 'bab_1',)->nullable();
            $table->string(column: 'poster',)->nullable();
            $table->string(column: 'status_ta',)->nullable();
            $table->unsignedBigInteger(column: 'id_sesi')->nullable();
            $table->unsignedBigInteger(column: 'id_ruangan')->nullable();
            $table->string(column: 'tgl_sidang',)->nullable();
            $table->string(column: 'kelompok_penelitian',)->nullable();

            $table->foreign('id_pengajuan')->references('id_tugasakhir')->on('pengajuans')->onDelete('cascade');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesi')->onDelete('cascade');
            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('cascade');
            $table->foreign('id_mhs')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('pembimbing_1')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('pembimbing_2')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('sekretaris')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('anggota_1')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('anggota_2')->references('id_dosen')->on('dosens')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidang_tas');
    }
};

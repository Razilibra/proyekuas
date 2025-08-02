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
        Schema::create('nilai_pkl', function (Blueprint $table) {
            $table->id('id_nilai_pkl');
            $table->unsignedBigInteger('id_dosen');
            $table->unsignedBigInteger('id_mahasiswa_pkl');
        $table->string('keaktifan_bimbingan')->nullable();
        $table->string('komunikatif')->nullable();
        $table->string('problem_solving')->nullable();
        $table->string('total_nilai')->nullable();
        $table->string('keterangan')->nullable();    


            $table->timestamps();


            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade');
            $table->foreign('id_mahasiswa_pkl')->references('id_mahasiswa_pkl')->on('mahasiswa_pkl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilaipkl');
    }
};

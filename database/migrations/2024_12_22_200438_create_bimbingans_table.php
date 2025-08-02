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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id(); // Sudah otomatis primary key
            $table->text('pembahasan');
            $table->unsignedBigInteger('dosen_id');
            // $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->timestamps();

            // Relasi foreign key dengan tabel dosen dan mahasiswa
            $table->foreign('dosen_id')->references('id_dosen')->on('dosens')->onDelete('cascade');
            // $table->foreign('dosen_id')->references('id')->on('pengajuans')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingans');
    }
};

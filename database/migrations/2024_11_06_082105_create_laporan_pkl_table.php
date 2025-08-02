<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPklTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_pkl', function (Blueprint $table) {
            $table->id('id_laporan_pkl');
            $table->string('nobp');
            $table->string('nama');
            $table->string('prodi');
            $table->text('nama_perusahaan');
            $table->string('alamat');
            $table->string('file');
            $table->string('tahun_ajaran');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pkl');
    }
};

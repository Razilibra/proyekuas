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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa'); // ID mahasiswa sebagai primary key
            $table->string('nim')->unique(); // NIM unik
            $table->string('nama'); // Nama mahasiswa
            
            $table->unsignedBigInteger('id_prodi')->nullable();
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('gender'); // Gender: Laki-laki atau Perempuan
            $table->string('foto')->nullable(); // Foto mahasiswa (opsional)
            $table->string('tanggal_daftar');
            $table->string('password', 100);
            $table->integer('akses');
            $table->timestamps(); // Kolom created_at dan updated_at

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade')->onUpdate('cascade');

            // Definisi foreign key

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id('id_dosen');
            $table->string('nidn');
            $table->string('nama');
            $table->string('gender');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('password');
            $table->string('pendidikan');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_prodi');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_golongan');
            $table->unsignedBigInteger('id_pangkat');
            $table->unsignedBigInteger('id_bidang');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('foto');
            $table->text('sinta')->nullable();
            $table->text('link_sinta')->nullable();
            $table->text('schoolar')->nullable();
            $table->string('status');
            $table->timestamps();

            //RELASI jurusan ,prodi , jabatan , golongan
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_golongan')->references('id_golongan')->on('golongan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs')->onDelete('cascade')->onUpdate('cascade');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};

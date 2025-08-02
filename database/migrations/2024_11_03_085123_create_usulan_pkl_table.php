<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanPklTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_pkl', function (Blueprint $table) {

            $table->id('id_usulan_pkl');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->unsignedBigInteger('id_tempat_pkl')->nullable();
            $table->string('tahun_ajaran')->nullable();
            $table->enum('konfirmasi',['0','1']);
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tempat_pkl')->references('id_tempat_pkl')->on('tempat_pkl')->onDelete('cascade')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulan_pkls');
    }
}

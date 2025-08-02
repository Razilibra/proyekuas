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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id('id_tugasakhir');
            $table->string('judul');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_bidang')->nullable();
            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('pembimbing_1')->nullable();
            $table->foreign('pembimbing_1')->references('id_dosen')->on('dosens')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedBigInteger('pembimbing_2')->nullable();
            $table->foreign('pembimbing_2')->references('id_dosen')->on('dosens')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('ipk');
            $table->string('proposal_tugas_akhir');
            $table->string('status')->default('usulan');
            $table->string('acc_pembimbing1')->nullable()->default('-');
            $table->string('acc_pembimbing2')->nullable()->default('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};

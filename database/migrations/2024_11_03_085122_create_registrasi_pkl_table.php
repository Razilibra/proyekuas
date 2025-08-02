
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Menonaktifkan pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('registrasi_pkl', function (Blueprint $table) {
            $table->id('id_registrasi_pkl');
            $table->unsignedBigInteger('id_mahasiswa')->unique();
            $table->unsignedBigInteger('id_tempat_pkl')->nullable();
            $table->string('alamat_perusahaan');
            $table->string('file')->nullable();

            // Inputan kaprodi
            $table->unsignedBigInteger('pembimbing_id')->nullable();
            $table->enum('konfirmasi', ['0', '1'])->default('0')->comment('0: Belum Dikonfirmasi, 1: Dikonfirmasi');

            // Foreign key
            $table->foreign('id_tempat_pkl')->references('id_tempat_pkl')->on('tempat_pkl')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('pembimbing_id')->references('id_dosen')->on('dosens');
        });

        // Mengaktifkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi_pkl');
    }
};

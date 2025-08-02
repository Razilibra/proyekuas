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
        Schema::create('sesi', function (Blueprint $table) {
            $table->id('id_sesi'); // Primary key dengan auto increment
            $table->string('kode_sesi'); // Kode unik untuk sesi
            $table->string('nama_sesi'); // Nama sesi (contoh: Sesi Pagi)
            $table->time('jam_mulai'); // Waktu mulai sesi
            $table->time('jam_berakhir'); // Waktu berakhir sesi
            $table->string('keterangan')->nullable(); // Keterangan tambahan (opsional)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi');
    }
};

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
        Schema::create('komentar_saran', function (Blueprint $table) {
            $table->id('id_komentar_saran');
            $table->string('komentar_dosen_pembimbing');
            $table->string('komentar_penguji');
            $table->string('saran_perbaikan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_saran');
    }
};

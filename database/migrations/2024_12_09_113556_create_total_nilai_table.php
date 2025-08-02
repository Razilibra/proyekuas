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
        Schema::create('total_nilai', function (Blueprint $table) {
            $table->id('id_total_nilai');
            $table->double('nilai_pkl');
            $table->double('nilai_penguji');
            $table->double('nilai_sidang');
            $table->double('total_nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_nilai');
    }
};

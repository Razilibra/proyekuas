<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->unsignedBigInteger('id_jurusan')->nullable();
            $table->string('nama_prodi');
            $table->unsignedBigInteger('id_jenjang')->nullable();
            $table->timestamps(); // Created_at and updated_at columns

            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenjang')->references('id_jenjang')->on('jenjang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};

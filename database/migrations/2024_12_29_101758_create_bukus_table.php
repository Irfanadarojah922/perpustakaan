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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('kategori_id');
            $table->string('judul', 255)->nullable();
            $table->string('penulis', 255)->nullable();
            $table->string('penerbit', 255)->nullable();
            $table->year('tahun_terbit');
            $table->string('isbn', 255)->nullable();
            $table->integer('jumlah_eksemplar');
            $table->integer('jumlah_tersedia');
            $table->longText('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris');           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};

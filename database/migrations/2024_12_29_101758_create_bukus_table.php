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
            $table->id();
            $table->string('judul', 255)->nullable();
            $table->string('penulis', 255)->nullable();
            $table->string('penerbit', 255)->nullable();
            $table->year('tahun_terbit');
            $table->unsignedBigString('nama_kategori');
            $table->foreign('kategori_id')->references('nama_kategori')->on('kategoris');           
            $table->string('isbn', 255)->nullable();
            $table->integer('jumlah_eksemplar');
            $table->integer('jumlah_tersedia');
            $table->text('deskripsi', 255)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
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

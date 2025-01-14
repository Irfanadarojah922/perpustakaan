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
        Schema::create('kembali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjam_id');
            $table->unsignedBigInteger('buku_id');
            
            $table->date('tanggal_kembali');
            $table->string('denda');
            $table->longtext('keterangan');
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('pinjam_id')->references('id')->on('pinjams')->onDelete('cascade');
            
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');

        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kembalis');
    }
};
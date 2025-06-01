<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id()->primary();

            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('buku_id');

            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian');
            $table->enum('status', ['Dipinjam', 'Dikembalikan', 'Terlambat'])->default('Dipinjam');
            $table->timestamps();

            $table->foreign('anggota_id')->references('id')->on('anggotas');
            $table->foreign('buku_id')->references('id')->on('bukus');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};

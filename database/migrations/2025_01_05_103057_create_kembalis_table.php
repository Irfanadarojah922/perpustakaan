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
        Schema::create('kembalis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjam_id');

            $table->date('tanggal_kembali');
            $table->enum('denda', ['Ganti Buku', 'Perbaikan', 'Tepat Waktu']);
            $table->enum('keterangan', ['buku hilang', 'rusak','tepat waktu']);
            $table->timestamps();

            $table->foreign('pinjam_id')->references('id')->on('pinjams')->onDelete('cascade');
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

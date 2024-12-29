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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->string('no_telepon', 255);
            $table->text('alamat', 255)->nullable();
            $table->date('tanggal_daftar');
            $table->enum('status', ['pelajar', 'mahasiswa', 'umum']);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};

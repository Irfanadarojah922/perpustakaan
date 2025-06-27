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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 20)->unique();
            $table->string('nama', 255);
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('pendidikan', ['SD', 'SMP','SMA','SARJANA']);
            $table->string('alamat');
            $table->char('no_telepon', 20);
            $table->enum('status', ['pelajar', 'mahasiswa', 'umum']);
            $table->string('foto')->nullable();
            $table->date('tanggal_daftar');

            $table->timestamps();

            $table->boolean('verifikasi')->default(false);
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

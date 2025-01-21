<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KembaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pinjam = DB::table('pinjams')->first();
        $buku = DB::table('bukus')->first();

        DB::table('kembalis')->insert([

            'pinjam_id' => $pinjam->id,
            'buku_id' => $buku->id,
            'tanggal_kembali' => '2024-12-15',
            'denda' => 'mengganti dengan buku yang sama',
            'keterangan' => 'Buku rusak/hilang',
        ]);
    }
}

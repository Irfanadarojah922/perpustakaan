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

        DB::table('kembali')->insert([

            'pinjam_id' => '1',
            'buku_id' => '1',
            'tanggal_kembali' => '2024-12-15',
            'denda' => 'mengganti dengan buku yang sama',
            'keterangan' => 'Buku rusak/hilang',

        ]);
    }
}

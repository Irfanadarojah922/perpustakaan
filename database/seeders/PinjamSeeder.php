<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('pinjams')->insert([

        'tanggal_pinjam'  => '2024-12-03',
        'tanggal_kembali' => '2024-12-15',
        'status_pengembalian' => 'Dikembalikan',
        'anggota_id' => '1',
        'buku_id' => '1',
        'kategori_id' => '1',

        ]);
    }
}

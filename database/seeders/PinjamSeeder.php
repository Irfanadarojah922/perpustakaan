<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $anggota = DB::table('anggotas')->pluck('id')->toArray();
        $buku = DB::table('bukus')->pluck('id')->toArray();
        $kategori = DB::table('kategoris')->pluck('id')->toArray();


        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {

        DB::table('pinjams')->insert([

            'tanggal_pinjam' => $faker -> date,
            'tanggal_pengembalian' => $faker -> date,
            // 'status_pengembalian' => $faker -> randomElement(['dipinjam', 'dikembalikan']),
            'anggota_id' => $faker->randomElement($anggota),
            'buku_id' => $faker->randomElement($buku),
            // 'kategori_id' => $faker->randomElement($kategori),
            ]);
        }
    }
}


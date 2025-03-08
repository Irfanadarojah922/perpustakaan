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

        $anggota = DB::table('anggotas')->first();
        $buku = DB::table('bukus')->first();
        $kategori = DB::table('kategoris')->first();


        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {

        DB::table('pinjams')->insert([

            'tanggal_pinjam' => $faker->date,
            'tanggal_kembali' => $faker->date,
            'status_pengembalian' => $faker->randomElement(['dipinjam', 'dikembalikan']),
            'anggota_id' => $faker->numberBetween(1, 10),
            'buku_id' => $faker->numberBetween(1, 10),
            'kategori_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}


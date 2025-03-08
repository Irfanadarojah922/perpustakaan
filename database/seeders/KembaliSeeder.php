<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 20; $i++) {

        DB::table('kembalis')->insert([

            'pinjam_id' => $faker->numberBetween(1, 10),
            'buku_id' => $faker->numberBetween(1, 10),
            'tanggal_kembali' => $faker->date(),
            'denda' => $faker->randomElement(['Ganti Buku', 'Perbaikan','Tepat Waktu']),
            'keterangan' => $faker->sentence(),
        ]);
        }
    }
}

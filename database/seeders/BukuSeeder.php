<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kategori = DB::table('kategoris')->first();

            $faker = \Faker\Factory::create('id_ID');
            for ($i = 0; $i < 20; $i++) {

                DB::table('bukus')->insert([
                    'judul' => $faker->sentence(3),
                    'penulis' => $faker->name,
                    'tahun_terbit' => $faker->year,
                    'kategori_id' => $faker->numberBetween(1, 10),
                    'jumlah_eksemplar' => $faker->numberBetween(1, 20),
                    'jumlah_tersedia' => $faker->numberBetween(1, 20),
                    'deskripsi' => $faker->text(),
                    'foto' => $faker->imageUrl(),                
                ]);
            }
    }
}

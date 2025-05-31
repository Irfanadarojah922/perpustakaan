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


        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {

        $kategori = DB::table('kategoris')->first();

            DB::table('bukus')->insert([
                'kode_buku' => strtoupper($faker->bothify('BK-#####')),
                'kategori_id' => $kategori -> id,
                'judul' => $faker->sentence(3),
                'penulis' => $faker->name,
                'penerbit' => $faker->company,
                'tahun_terbit' => $faker->year(),
                'ISBN' => $faker->isbn13(),
                'jumlah_eksemplar' => $jumlah = $faker->numberBetween(5, 20),
                'jumlah_tersedia' => $faker->numberBetween(1, $jumlah),
                'deskripsi' => $faker->paragraph(),
                'foto' => $faker->imageUrl(200, 300, 'books', true),
            ]);
        }
    }
}
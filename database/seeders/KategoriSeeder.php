<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
        
            DB::table('kategoris')->insert([

                 'nama_kategori' => $faker->name(),

                ]);
            }
    }
}

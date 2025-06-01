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
        $pinjam = DB::table('pinjams')->pluck('id')->toArray();

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            
        DB::table('kembalis')->insert([

            'pinjam_id' => $faker->randomElement($pinjam),
            'tanggal_kembali' => $faker -> date,
            'denda' => $faker -> randomElement(['Ganti Buku', 'Perbaikan', 'Tepat Waktu']),
            'keterangan' => $faker -> randomElement(['buku hilang', 'rusak', 'tepat waktu']),
        ]);
        }
    }
}
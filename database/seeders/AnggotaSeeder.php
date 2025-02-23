<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            DB::table('anggotas')->insert([
                'anggota_id' => $faker->nik(),
                'nama' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'pendidikan' => $faker->randomElement(['SMA', 'S1', 'S2', 'S3']),
                'alamat' => $faker->address(),
                'no_telepon' => $faker->phoneNumber(),
                'status' => $faker->randomElement(['pelajar', 'mahasiswa', 'umum']),
                'foto' => $faker->imageUrl(),
            ]);
        }
    }
}

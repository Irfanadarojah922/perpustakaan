<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
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
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'email' => $faker->email,
                'password' => Hash::make('password')
            ]);

            Anggota::create([
                'nik' => $faker->nik(),
                'nama' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'pendidikan' => $faker->randomElement(['SD', 'SMP', 'SMA', 'SARJANA']),
                'alamat' => $faker->address(),
                'no_telepon' => $faker->phoneNumber(),
                'status' => $faker->randomElement(['pelajar', 'mahasiswa', 'umum']),
                'foto' => $faker->imageUrl(),
                'tanggal_daftar' => $faker->date(),
                'user_id' => $user->id,
                'verifikasi' => $faker->boolean(1),
            ]);
        }

        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        Anggota::create([
            'nik' => $faker->nik(),
            'nama' => $faker->name(),
            'tempat_lahir' => $faker->city(),
            'tanggal_lahir' => $faker->date(),
            'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            'pendidikan' => $faker->randomElement(['SD', 'SMP', 'SMA', 'SARJANA']),
            'alamat' => $faker->address(),
            'no_telepon' => $faker->phoneNumber(),
            'status' => $faker->randomElement(['pelajar', 'mahasiswa', 'umum']),
            'foto' => $faker->imageUrl(),
            'tanggal_daftar' => $faker->date(),
            'user_id' => $superAdmin->id,
            'verifikasi' => true,
        ]);
    }

}

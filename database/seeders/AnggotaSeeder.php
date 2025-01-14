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

        
        DB::table('anggotas')->insert([

            'nama' => 'Darojah',
            'email' => 'darojah@gmail.com',
            'password'=> Hash::make('darojah'),
            'no_telepon'  => '081234567892',
            'alamat' => 'Tegal',
            'tanggal_daftar' => '2024-01-01',
            'status' => 'mahasiswa',
            'foto' => 'foto',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            ['nama_kategori' => 'Fiksi'],
            ['nama_kategori' => 'Non-Fiksi'],
            ['nama_kategori' => 'Sejarah'],
            ['nama_kategori' => 'Sains'],
            ['nama_kategori' => 'Teknologi'],
            ['nama_kategori' => 'Komik'],
            ['nama_kategori' => 'Novel'],
            ['nama_kategori' => 'Biografi'],
            ['nama_kategori' => 'Religi'],
            ['nama_kategori' => 'Pendidikan'],
        ]);
    }
}


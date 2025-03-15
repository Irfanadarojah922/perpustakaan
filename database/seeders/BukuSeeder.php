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

         DB::table('bukus')->insert([
            'kategori_id' => $kategori -> id,
            'judul' => 'Laskar Pelangi', 
            'penulis' => 'Andrea Hirata', 
            'penerbit' => 'Gramedia', 
            'tahun_terbit' => 2005, 
            'ISBN' => '979-3062-79-7',
            'jumlah_eksemplar' => 10, 
            'jumlah_tersedia' => 10, 
            'deskripsi' => 'Novel inspiratif tentang persahabatan dan perjuangan anak-anak di Belitung.', 
            'foto' => 'laskar_pelangi.jpg',
        ]);
    }
}

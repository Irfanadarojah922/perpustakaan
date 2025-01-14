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

        DB::table('bukus')->insert([

            'judul' => 'Atomic Habits',
            'penulis' => 'James Clear',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => '2024',
            'kategori_id' => '1',
            'isbn' => '978-602-06-3317-6',
            'jumlah_eksemplar' => '10',
            'jumlah_tersedia' => '8',
            'deskripsi' => 'Atomic Habits adalah buku pengembangan diri karya James Clear yang berfokus pada bagaimana kebiasaan kecil dapat menghasilkan perubahan besar dalam hidup seseorang. Buku ini menawarkan strategi praktis untuk membentuk kebiasaan baik, menghilangkan kebiasaan buruk, dan memahami cara kerja kebiasaan dalam kehidupan sehari-hari.',
            'foto' => 'foto buku',
        ]);
    }
}

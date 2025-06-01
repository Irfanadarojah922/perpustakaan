<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BookTest extends TestCase
{

    #[Test]
    public function it_redirects_back_with_errors_if_required_fields_are_missing()
    {
        $response = $this->from(route('buku.create'))
                         ->post(route('buku.store'), []);

        $response->assertRedirect(route('buku.create'));
        $response->assertSessionHasErrors([
            'kode_buku',
            'judul',
            'penulis',
            'penerbit',
            'tahun_terbit',
            'kategori_id',
            'isbn',
            'jumlah_eksemplar',
            'jumlah_tersedia',
            'deskripsi',
            'foto',
        ]);
    }

    #[Test]
    public function it_creates_a_book_with_valid_data()
    {
        // Storage::fake('public');

        $kategori = Kategori::first();

        $validData = [
            'kode_buku'        => 'B001',
            'judul'            => 'Laravel untuk Pemula',
            'penulis'          => 'Jane Doe',
            'penerbit'         => 'OpenAI Press',
            'tahun_terbit'     => 2023,
            'kategori_id'      => $kategori->id,
            'isbn'             => '978-1234567890',
            'jumlah_eksemplar' => 10,
            'jumlah_tersedia'  => 8,
            'deskripsi'        => 'Buku panduan Laravel dasar.',
            'foto'             => UploadedFile::fake()->image('cover.jpg'),
        ];

        $response = $this->post(route('buku.store'), $validData);

        $response->assertRedirect(route('katalog.index')); // redirect ke halaman tertentu setelah sukses
        // $this->assertDatabaseHas('bukus', [
        //     'kode_buku' => 'B001',
        //     'judul'     => 'Laravel untuk Pemula',
        // ]);

        // Storage::disk('public')->assertExists('buku/' . $validData['foto']->hashName());
    }
}

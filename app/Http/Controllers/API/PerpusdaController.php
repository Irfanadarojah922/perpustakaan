<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategoris;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\kategoriResource;


class kategoriController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'buku_judul' => 'required|string|max:255',
            'buku_penulis' => 'required|string|max:255',
            'buku_penerbit' => 'required|string|max:255',
            'buku_tahun_terbit'  => 'required|string|max:255',
            'buku_kategori_id' => 'required|string|max:255',
            'buku_isbn' => 'required|string|max:255',
            'buku_jumlah_eksemplar' => 'required|string|max:255',
            'buku_jumlah_tersedia' => 'required|string|max:255',
            'buku_deskripsi' => 'required|string|max:255',
            'buku_foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'kategori_nama_kategori'=> 'required|string|max:255',

            'anggota_nama' => 'required|string|max:255',
            'anggota_email' => 'required|string|max:255',
            'anggota_no_telepon' => 'required|string|max:255',
            'anggota_alamat' => 'required|string|max:255',
            'anggota_tanggal_daftar' => 'required|string|max:255',
            'anggota_status' => 'required|string|max:255',
            'anggota_foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // Cari kategori berdasarkan kode
        $kategori = Kategori::where('nama_kategori', $validatedData['kategori_nama_kategori'])->first();

        if (!$kategori) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        }

        // Mulai transaksi database untuk memastikan data konsisten
        DB::beginTransaction();

        try {
            // 1. Simpan data ke tabel buku
            $buku = Buku::create([
                'judul'  => $validatedData['buku_judul'],
                'penulis'  => $validatedData['buku_penulis'],
                'penerbit'  => $validatedData['buku_penerbit'],
                'tahun_terbit'  => $validatedData['buku_tahun_terbit'],
                'kategori_id'  => $kategori -> kategori_nama_kategori, // Relasi kategori
                'isbn'  => $validatedData['buku_isbn'],
                'jumlah_eksemplar'  => $validatedData['buku_jumlah_eksemplar'],
                'jumlah_tersedia'  => $validatedData['buku_jumlah_tersedia'],
                'deskripsi'  => $validatedData['buku_deskripsi'],
                'foto'  => $validatedData['buku_foto'],
                
            ]);
    
            // 2. Simpan data ke tabel kategori
            $kategori = Kategori::create([
                'nama_kategori' => $validatedData['kategori_nama_kategori'],
            ]);
    
            // 3. Simpan data ke tabel anggota
            $anggota = Anggota::create([
                'nama'=> $validatedData['anggota_nama'],
                'email'=> $validatedData['anggota_email'],
                'password' => bcrypt('default_password'),
                'no_telepon'=> $validatedData['anggota_no_telepon'],
                'alamat'=> $validatedData['anggota_alamat'],
                'tanggal_daftar'=> $validatedData['anggota_tanggal_daftar'],
                'status'=> $validatedData['anggota_status'],
                'foto'=> $validatedData['anggota_foto'],
                
            ]);
    
            // Commit transaksi jika semua berhasil
            DB::commit();
    
            return response()->json([
                'message' => 'Data berhasil disimpan',

                'Buku' => $buku,
                'Kategori' => $kategori,
                'Anggota' => $anggota,
                
            ], 201);

        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();
    
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
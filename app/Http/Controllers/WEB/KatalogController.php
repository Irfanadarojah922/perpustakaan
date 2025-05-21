<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        $kategoris = Kategori::all();
        // debug
        // return $bukus;
        return view('katalog.index', compact('bukus', 'kategoris')); 
    }

       public function create()
    {
        return view('katalog.create'); 
    }

    public function show($id)
    {
        $bukus = Buku::with('kategori')->findOrFail($id);
        
        return view('katalog.show', compact('bukus'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_buku'  => 'required|string|max:255' ,
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'kategori_id' => 'required|exists:kategoris,id',
            'isbn' => 'required|string|max:20',
            'jumlah_eksemplar' => 'required|integer|min:1',
            'jumlah_tersedia' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada file foto, simpan ke folder public
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images');
            $file->move($destinationPath, $filename);

            $validated['foto'] = 'assets/images/' . $filename;
        }

        // Simpan data buku
        $buku = Buku::create($validated);

        // Redirect dengan pesan sukses atau error
        return $buku
            ? redirect("/katalog")->with("success", "Katalog Created Successfully!")
            : back()->with("error", "Something Error!");
    }

    public function detail($id)
    {
        $kategoris = Kategori::find($id);
        return view('katalog.detail', compact('kategoris'));
    }

}

<?php
namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;

class KatalogController extends Controller
{
    public function index()
    {
        $bukus     = Buku::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('katalog.index', compact('bukus', 'kategoris'));
    }

    public function show($id)
    {
        $bukus = Buku::with('kategori')->findOrFail($id);

        return view('katalog.show', compact('bukus'));
    }

    public function detail($id)
    {
        $kategoris = Kategori::find($id);
        return view('katalog.detail', compact('kategoris'));
    }
}

<?php
namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request; // Import the Request class

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query(); 

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            $query->where('judul', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('kategori', function ($q) use ($searchTerm) {
                      $q->where('nama_kategori', 'like', '%' . $searchTerm . '%');
                  });
        }

        $bukus = $query->with('kategori')->get();

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
        $kategoris = Kategori::find($id); // This seems to find a single category by ID
        return view('katalog.detail', compact('kategoris'));
    }
}

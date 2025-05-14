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
        // debug
        
        // return $bukus;
        return view('katalog.index', compact('bukus')); 
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
}

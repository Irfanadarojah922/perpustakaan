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
        $bukus = Buku::all();
        return view('katalog.index', compact('bukus'));
    }

    public function show()
    {
        //detail page
    }
}

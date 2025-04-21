<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Anggota;
use App\Models\Pinjam;
use App\Models\Kembali;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {   
        $kategoris = Kategori::count();
        $anggotas = Anggota::count();
        $pinjams = Pinjam::count();
        $kembalis = Kembali::count();

        return view('pages.dashboard', compact(
            'kategoris', 'anggotas', 'pinjams', 'kembalis'
        ));
    }
}

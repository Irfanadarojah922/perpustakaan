<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Anggota;
use App\Models\Pinjam;
use App\Models\Kembali;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {   
        $kategoris = Kategori::count();
        $anggotas = Anggota::where('role_as','0')->count();
        $pinjams = Pinjam::where('role_as','0')->count();
        $kembalis = Kembali::count();

        return view('pages.dashboard', compact(
            'kategoris', 'anggotas', 'pinjams', 'kembalis'
        ));   
    }
}

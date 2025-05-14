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

    public function transaksiTerakhir()
    {
        $transaksi = Pinjam::with('anggota')
            ->orderBy('tanggal_pinjam', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama_anggota' => $item->anggota->nama,
                    'tanggal_pinjam' => $item->tanggal_pinjam,
                    'status' => $item->status == 'kembali' ? 'Pengembalian' : 'Dipinjam',
                ];
            });

            return view('pages.dashboard', compact('transaksi'));
    }

    public function pengingat()
    {
        $pengingat = Pinjam::with('anggota')
            ->where('status', 'dipinjam')
            ->get()
            ->map(function ($item) {
                return [
                    'nama_anggota' => $item->anggota->nama,
                    'tanggal_pinjam' => $item->tanggal_pinjam,
                    'jatuh_tempo' => \Carbon\Carbon::parse($item->tanggal_pinjam)->addDays(10)->format('Y-m-d'),
                ];
            });

        return view('pages.dashboard', compact('pengingat'));
    }
}

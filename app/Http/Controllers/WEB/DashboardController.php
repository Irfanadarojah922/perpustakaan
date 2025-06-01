<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Anggota;
use App\Models\Pinjam;
use App\Models\Kembali;
use App\Models\Buku;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    
    public function index()
    {   
        $bukuTotal = Buku::count();         //jumlahbuku
        $kategoris = Kategori::count();
        $anggotas = Anggota::count();
        $pinjams = Pinjam::count();
        $kembalis = Kembali::count();

        $transaksi = $this->transaksiTerakhir();
        $pengingat = $this->pengingat();

        return view('pages.dashboard', compact(
            'bukuTotal', 'kategoris', 'anggotas', 'pinjams', 'kembalis', 'transaksi', 'pengingat'
        ));
    }

    public function transaksiTerakhir()
    {
        $limit = 5;

        // Ambil transaksi peminjaman terakhir
        $peminjamanTerakhir = Pinjam::with(['anggotas', 'bukus']) 
            ->orderBy('tanggal_pinjam', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'tipe_transaksi' => 'Peminjaman',
                    'nama_anggota' => $item->anggotas ? $item->anggotas->nama : 'N/A',
                    'judul_buku' => $item->bukus ? $item->bukus->judul : 'N/A',
                    'tanggal_transaksi' => $item->tanggal_pinjam,
                    'objek_transaksi' => $item, 
                ];
            });

        // Ambil transaksi pengembalian terakhir
        $pengembalianTerakhir = Kembali::with(['anggota', 'buku', 'pinjam']) // Eager load relasi
            ->orderBy('tanggal_kembali', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($item) {
                return [
                    'tipe_transaksi' => 'Pengembalian',
                    'nama_anggota' => $item->anggota ? $item->anggota->nama : ($item->pinjam && $item->pinjam->anggotas ? $item->pinjam->anggotas->nama : 'N/A'),
                    'judul_buku' => $item->buku ? $item->buku->judul : ($item->pinjam && $item->pinjam->bukus ? $item->pinjam->bukus->judul : 'N/A'),
                    'tanggal_transaksi' => $item->tanggal_kembali,
                    'objek_transaksi' => $item, // Untuk detail lebih lanjut jika diperlukan
                ];
            });

        // Gabungkan kedua koleksi transaksi
        $semuaTransaksi = collect($peminjamanTerakhir)->merge($pengembalianTerakhir);

        // Urutkan berdasarkan tanggal transaksi (descending) dan ambil sejumlah limit
        $transaksi = $semuaTransaksi->sortByDesc('tanggal_transaksi')->take($limit)->values();
        // dd($transaksi);
        return $transaksi;
    }

    public function pengingat()
    {
        $pengingat = Pinjam::with(['anggotas', 'bukus']) // Gunakan nama relasi yang benar: anggotas, bukus
            ->where('status', 'Dipinjam') // Sesuaikan dengan nilai ENUM di database ('Dipinjam')
            ->orderBy('tanggal_pinjam', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama_anggota' => $item->anggotas ? $item->anggotas->nama : 'N/A',
                    // 'judul_buku' => $item->bukus ? $item->bukus->judul : 'N/A',
                    'tanggal_pinjam' => $item->tanggal_pinjam,
                    'jatuh_tempo' => $item->tanggal_pengembalian, // Gunakan kolom tanggal_jatuh_tempo yang sudah ada
                ];
            });
        return $pengingat;

    }
}

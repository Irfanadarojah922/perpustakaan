<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Kembali;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengembalianController extends Controller
{
    public function index()
    {   
            $kembali = Kembali::all();
            // maksudku bukan bikin relasi tapi gunain relasi di controller
            if (\request()->ajax()) {

            // misal $kembali= Kembali::all() artinya ambil semua data dari tabel kembali tanpa relasi atau tanpa tabel pinjam dan buku atau juga tanpa tabel yang berkaitan
            $kembali = Kembali::with(['pinjams:id', 'bukus:id,judul'])->get(); // ambil semua data dari tabel kembali dengan relasi tabel pinjam dan buku, data yang diambil dari Pinjam cuma id, dari buku cuma id dan judul

            return DataTables::of($kembali)->make(true);
        }

        return view("sirkulasi.pengembalian.index", compact('kembali'));
    }
        public function store(Request $request)
    {
        $data = Kembali::create($request->validate([
            "pinjam_id" => "required|string|max:255",
            "buku_id" => "required|string|max:255",
            "tanggal_kembali" => "required|string|max:255",
            "denda" => "required|string|max:255",
            "keterangan" => "required|string|max:255",
        ]));

        return $data ? redirect("/sirkulasi/pengembalian")->with("success", "Pengembalian
        Created Successfully!") : back()->with("error", "Something Error!");
    }
}
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
        if (\request()->ajax()) {

            $kembali = Kembali::all();
            return DataTables::of($kembali)->make(true);
        }

        return view("sirkulasi.pengembalian.index", compact('kembali'));
    }
    public function store(Request $request)
    {
        $data = Kembali::create($request->validate([
            "tanggal_pinjam" => "required|string|max:255",
            "tanggal_kembali" => "required|string|max:255",
            "status_pengembalian" => "required|string|max:255",
            "anggota_id" => "required|string|max:255",
            "buku_id" => "required|string|max:255",
            "kategori_id" => "required|string|max:255",
        ]));

        return $data ? redirect("/sirkulasi.pengembalian")->with("success", "Pengembalian
        Created Successfully!") : back()->with("error", "Something Error!");
    }
}
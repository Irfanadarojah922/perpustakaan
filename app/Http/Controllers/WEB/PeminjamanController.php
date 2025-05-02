<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    public function index()
    {
        $pinjam = Pinjam::all();
        if (\request()->ajax()) {

            $pinjam = Pinjam::with(['bukus', 'anggotas', 'kategoris'])->get();
            // dd($pinjam);
            return DataTables::of($pinjam)->addColumn("action", function($row){
                $action =
                        '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#edit_modal">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </td>';
            return $action;
            })->make(true);
        }
        return view("sirkulasi.peminjaman.index", compact('pinjam'));
    }
    public function store(Request $request)
    {
        $data = Pinjam::create($request->validate([
            "tanggal_pinjam" => "required|string|max:255",
            "tanggal_kembali" => "required|string|max:255",
            "status_pengembalian" => "required|string|max:255",
            "anggota_id" => "required|string|max:255",
            "buku_id" => "required|string|max:255",
            "kategori_id" => "required|string|max:255",

        ]));

        return $data ? redirect("/sirkulasi/peminjaman")->with("success", "Peminjaman 
        Created Successfully!") : back()->with("error", "Something Error!");
    }
}
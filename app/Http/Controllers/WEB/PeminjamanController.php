<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
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
            return DataTables::of($pinjam)->addColumn("action", function ($row) {
                $action =
                    '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">

                            <button class="btn btn-sm btn-success editBtn" data-id="' . $row->id . '"> <i class="bx bx-edit" style="font-size:1rem;"></i></button>
                                <button type="button" class="btn btn-danger deleteBtn" data-id="' . $row->id . '"> <i class="bx bx-trash" style="font-size:1rem;"></i></button>
                            </div>
                        </td>';
                return $action;
            })->rawColumns(['action'])

                ->make(true);
        }
        return view("sirkulasi.peminjaman.index", compact('pinjam'));
    }

    public function add()
    {
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        $kategoris = Kategori::all();
        $pinjams  = Pinjam::all();

        return response()->json([
            'bukus' => $bukus,
            'anggotas' => $anggotas,
            'kategoris' => $kategoris,
            'pinjams' => $pinjams
        ]);
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

    public function edit($id)
    {
        $data = Pinjam::with(['bukus', 'anggotas', 'kategoris'])->findOrFail($id);

        $bukus = Buku::all();
        $anggotas = Anggota::all();
        $kategoris = Kategori::all();

        return response()->json([
            'data' => $data,
            'bukus' => $bukus,
            'anggotas' => $anggotas,
            'kategoris' => $kategoris,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "tanggal_pinjam" => "required|string|max:255",
            "tanggal_kembali" => "required|string|max:255",
            "status_pengembalian" => "required|string|max:255",
            "anggota_id" => "required|exists:anggotas,id",
            "buku_id" => "required|exists:bukus,id",
            "kategori_id" => "required|exists:kategoris,id",
        ]);

        $data = Pinjam::findOrFail($id);
        $data->update($validated);

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->forceDelete(); // Hapus permanen dari database

        return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

}
<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Kembali;
use App\Models\Pinjam;
use App\Models\Buku;
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
            $kembali = Kembali::with(['pinjam:id', 'bukus:id,judul,kode_buku', 'anggota:nama,nik'])->get(); // ambil semua data dari tabel kembali dengan relasi tabel pinjam dan buku, data yang diambil dari Pinjam cuma id, dari buku cuma id, judul dan kode_buku

            return DataTables::of($kembali)->addColumn("action", function($row){
                $action =
                    '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">

                            <button class="btn btn-sm btn-success editBtn" data-id="' . $row->id . '"><i class="bx bx-edit" style="font-size:1rem;"></i></button>
                                <button type="button" class="btn btn-danger deleteBtn" data-id="' . $row->id . '"> <i class="bx bx-trash" style="font-size:1rem;"></i></button>
                            </div>
                        </td>';
                return $action;
            })->rawColumns(['action'])

                ->make(true);
        }

        return view("sirkulasi.pengembalian.index", compact('kembali'));
    }

    public function add()
    {
        $bukus = Buku::all();
        $pinjams = Pinjam::with('anggotas')->get();

        return response()->json([
            'bukus' => $bukus,
            'pinjams' => $pinjams
            
        ]);
    }    
    public function store(Request $request)
    {
        $data = Kembali::create($request->validate([
            "pinjam_id" => "required|exists:pinjams,id",
            "buku_id" => "required|exists:bukus,id",
            "tanggal_kembali" => "required|date",
            "denda" => "required|string|max:255",
            "keterangan" => "required|string|max:255",
        ]));

        return $data ? redirect("/sirkulasi/pengembalian")->with("success", "Pengembalian
        Created Successfully!") : back()->with("error", "Something Error!");
    }

    public function edit($id)
    {
        $data = Kembali::with(['bukus', 'pinjam'])->findOrFail($id);

        $bukus = Buku::all();
        $pinjams = Pinjam::all();

        return response()->json([
            'data' => $data,
            'bukus' => $bukus,
            'pinjams' => $pinjams,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "pinjam_id" => "required|exists:pinjams,id",
            "buku_id" => "required|exists:bukus,id",
            "tanggal_kembali" => "required|date",
            "denda" => "required|string|max:255",
            "keterangan" => "required|string|max:255",
        ]);

        $data = Kembali::findOrFail($id);
        $data->update($validated);

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $kembali = Kembali::findOrFail($id);
        $kembali->forceDelete(); // Hapus permanen dari database

    return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

}
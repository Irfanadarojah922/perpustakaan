<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        if (\request()->ajax()) {

            $anggota = Anggota::all();
            return DataTables::of($anggota)->addColumn("action", function($row){
                $action =
                    '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">

                            <button class="btn btn-sm btn-success editBtn" data-id="' . $row->id . '"> <i class="bx bx-edit" style="font-size:1rem;"></i></button>
                                <button class="btn btn-info btn-sm" onclick="detail_anggota('.$row->id.')"> <i class="bx bx-show" style="font-size:1rem;"></i> </button>     
                                <button type="button" class="btn btn-danger deleteBtn" data-id="' . $row->id . '"> <i class="bx bx-trash" style="font-size:1rem;"></i></button>
                            </div>
                        </td>';
            return $action;
            })->make(true);
        }

        return view("keanggotaan.index", compact('anggota'));
    }

    public function create()
    {
        return view('keanggotaan.create');
        
    }

    
    public function store(Request $request)
    {
        // Simpan hasil validasi ke variabel
        $validated = $request->validate([
            "nik" => "required|string|max:255|unique:anggotas,nik",
            "nama" => "required|string|max:255",
            "tempat_lahir" => "required|string|max:255", 
            "tanggal_lahir" => "required|date",
            "jenis_kelamin" => "required|string|max:255",
            "pendidikan" => "required|string|max:255",
            "alamat" => "required|string|max:255",
            "no_telepon" => "required|string|max:20",
            "status" => "required|string|max:255",
            "foto" => "nullable|image|max:2048",
            "tanggal_daftar" => "required|date"
        ]);

        // Validasi nomor telepon harus diawali dengan +62
        if (!str_starts_with($validated['no_telepon'], '+62')) {
            return back()->withInput()->withErrors([
                'no_telepon' => 'Nomor telepon harus diawali dengan +62.'
            ]);
        }

        // Simpan data ke database
        $data = Anggota::create($validated);

        return $data ? redirect("/keanggotaan")->with("success", "Anggota 
        Created Successfully!") : back()->with("error", "Something Error!");
    }

    public function edit($id)
    {
        $data = Anggota::with(['bukus', 'anggotas', 'kategoris'])->findOrFail($id);

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

        $data = Anggota::findOrFail($id);
        $data->update($validated);

        return response()->json(['message' => 'Data berhasil diupdate']);
    }
    
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->forceDelete(); // Hapus permanen dari database

        return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('keanggotaan.show', compact('anggota'));
    }

}
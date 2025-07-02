<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Pinjam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    public function index()
    {
        $pinjam = Pinjam::all();
        if (\request()->ajax()) {

            $pinjam = Pinjam::with(['bukus', 'anggotas'])->get();
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
        $pinjams = Pinjam::all();

        return response()->json([
            'bukus' => $bukus,
            'anggotas' => $anggotas,
            'kategoris' => $kategoris,
            'pinjams' => $pinjams
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "tanggal_pinjam" => "required|date|max:255",
            "anggota_id" => "required|string|exists:anggotas,id|max:255",
            "buku_id" => "required|string|exists:bukus,id|max:255", // Removed extra pipe
        ]);
        $buku = Buku::findOrFail($validated['buku_id']);
        $buku->update(['jumlah_tersedia' => $buku->jumlah_tersedia - 1]);

        $data = Pinjam::create(array_merge($validated, [
            'tanggal_pengembalian' => Carbon::createFromDate($validated['tanggal_pinjam'])->addDays(10) // Consider adding ->addDays(X) here
        ]));

        return $data ? redirect("/sirkulasi/peminjaman")->with("success", "Peminjaman
        Created Successfully!") : back()->with("error", "Something Error!");
    }

    public function edit($id)
    {
        $data = Pinjam::with(['bukus', 'anggotas'])->findOrFail($id);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "tanggal_pinjam" => "required|string|max:255",
            "tanggal_pengembalian" => "required|string|max:255",
            "anggota_id" => "required|exists:anggotas,id",
            "buku_id" => "required|exists:bukus,id",
        ]);

        // Ambil data peminjaman berdasarkan ID
        $data = Pinjam::findOrFail($id);

        // Cek apakah buku yang dipinjam sebelumnya berbeda dengan buku yang sekarang
        if ($data->buku_id != $validated['buku_id']) {
            // Ambil data buku lama dan buku baru
            $bukuLama = Buku::findOrFail($data->buku_id);
            $bukuBaru = Buku::findOrFail($validated['buku_id']);

            // Kembalikan stok buku lama
            $bukuLama->update(['jumlah_tersedia' => $bukuLama->jumlah_tersedia + 1]);
            // Kurangi stok buku baru
            $bukuBaru->update(['jumlah_tersedia' => $bukuBaru->jumlah_tersedia - 1]);
        }

        // Perbarui data peminjaman dengan data yang sudah divalidasi
        $data->update($validated);

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->forceDelete(); // Hapus permanen dari database

        return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

    public function searchAnggotaByNIK(Request $request)
    {
        $query = $request->input('q');
        $anggota = Anggota::query();

        if ($query) {
            $anggota = $anggota->where('nik', 'LIKE', "%{$query}%")
                ->orWhere('nama', 'LIKE', "%{$query}%");
        }
        $anggota = $anggota->limit(10)->get(['id', 'nik', 'nama']);

        return response()->json(['anggota' => $anggota]);
    }

    public function searchBukuByKodeBuku(Request $request)
    {
        $query = $request->input('q');
        $buku = Buku::query();

        if ($query) {
            $buku = $buku
                ->where('jumlah_tersedia', '>', 0)
                ->where('kode_buku', 'LIKE', "%{$query}%")
                ->orWhere('judul', 'LIKE', "%{$query}%");
        }
        $buku = $buku->where('jumlah_tersedia', '>', 0)->limit(10)->get(['id', 'kode_buku', 'judul']);


        return response()->json(['buku' => $buku]);
    }
}
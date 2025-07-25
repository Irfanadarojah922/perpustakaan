<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Kembali;
use App\Models\Pinjam;
use App\Models\Buku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PengembalianController extends Controller
{
    public function index()
    {
        $kembali = Kembali::all();
        // maksudku bukan bikin relasi tapi gunain relasi di controller
        if (\request()->ajax()) {

            // misal $kembali= Kembali::all() artinya ambil semua data dari tabel kembali tanpa relasi atau tanpa tabel pinjam dan buku atau juga tanpa tabel yang berkaitan
            $kembali = Kembali::with(['pinjam:id', 'bukus:judul,kode_buku', 'anggota:nama,nik'])->get(); // ambil semua data dari tabel kembali dengan relasi tabel pinjam dan buku, data yang diambil dari Pinjam cuma id, dari buku cuma id, judul dan kode_buku

            return DataTables::of($kembali)->addColumn("action", function ($row) {
                $action =
                    '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button class="btn btn-sm btn-success editBtn" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editModal" title="Edit"><i class="bx bx-edit" style="font-size:1rem;"></i></button>
                                <button type="button" class="btn btn-danger deleteBtn" data-id="' . $row->id . '"> <i class="bx bx-trash" style="font-size:1rem;" title="Delete"></i></button>
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
        $requestData = $request->validate([
            "pinjam_id" => "nullable|exists:pinjams,id",
            "tanggal_kembali" => "nullable|date",
            "denda" => ["nullable", Rule::in(['Ganti Buku', 'Perbaikan', 'Tepat Waktu'])],
            "keterangan" => ["nullable", Rule::in(['buku hilang', 'rusak', 'tepat waktu'])],
        ]);

        // Simpan data pengembalian ke tabel 'kembalis'
        $kembali = Kembali::create($requestData);

        // Ambil data peminjaman berdasarkan pinjam_id
        $pinjam = Pinjam::findOrFail($requestData["pinjam_id"]);

        // Ambil tanggal pengembalian dari input
        $tanggalPengembalian = Carbon::parse($requestData["tanggal_kembali"]);

        // Ambil tanggal pinjam dari database (bisa juga diubah menjadi tanggal jatuh tempo tergantung sistem)
        $tanggalJatuhTempo = Carbon::parse($pinjam->tanggal_pinjam);

        // Default status adalah "Dikembalikan"
        $status = "Dikembalikan";

        // Jika tanggal pengembalian melebihi tanggal pinjam, maka status jadi "Terlambat"
        if ($tanggalPengembalian > $tanggalJatuhTempo) {
            $status = "Terlambat";
        }
        $pinjam->update(["status" => $status]);

        return $kembali ? redirect("/sirkulasi/pengembalian")->with("success", "Pengembalian
        Created Successfully!") : back()->with("error", "Something Error!");
    }

    public function edit($id)
    {
        $data = Kembali::findOrFail($id);

        return response()->json([
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "pinjam_id" => "nullable|exists:pinjams,id",
            "tanggal_kembali" => "nullable|date",
            "denda" => "nullable|string|max:255",
            "keterangan" => "nullable|string|max:255",
        ]);

        $data = Kembali::findOrFail($id);

        $pinjam = Pinjam::findOrFail($validated['pinjam_id']);
        $tanggalPengembalian = Carbon::parse($validated['tanggal_kembali']);
        $tanggalJatuhTempo = Carbon::parse($pinjam->tanggal_pinjam);
        $status = "Dikembalikan";

        if ($tanggalPengembalian > $tanggalJatuhTempo) {
            $status = "Terlambat";
        }
        $pinjam->update(["status" => $status]);

        $data->update($validated);

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $kembali = Kembali::findOrFail($id);
        $kembali->forceDelete(); // Hapus permanen dari database

        return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

    public function searchBukuByKodeBukuInBorrowed(Request $request)
    {
        $query = $request->input('q');
        $buku = Pinjam::query();

        if ($query) {
            $buku = $buku->with(['bukus'], function ($params) use ($query) {
                return $params->where('kode_buku', 'LIKE', "%{$query}%")
                    ->where('status', 'Dipinjam');
            })->get();
        }

        $buku = $buku->with(['bukus'])->limit(10)->where('status', 'Dipinjam')->get();

        return response()->json(['data' => $buku]);
    }
}
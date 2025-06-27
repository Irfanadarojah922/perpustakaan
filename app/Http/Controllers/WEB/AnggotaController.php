<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers\UploadFileHelper;
use Illuminate\Support\Facades\Storage;


class AnggotaController extends Controller
{

    protected $registerRepository;

    // Konstruktor untuk inisialisasi repository
    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    // Menampilkan halaman index keanggotaan, dan jika request AJAX, kembalikan data DataTables
    public function index()
    {
        if (\request()->ajax()) {
            $anggotas = Anggota::query();

            return DataTables::of($anggotas)
                ->addColumn("verifikasi", function ($row) {

                    // Tampilkan status verifikasi anggota
                    if ($row->verifikasi) {
                        return '<span class="badge bg-success">Terverifikasi</span>';
                    } else {
                        return '<span class="badge bg-danger">Belum Verifikasi</span>';
                    }
                })

                // Tambahkan tombol-tombol aksi: Edit, Show, Delete, Verifikasi
                ->addColumn("action", function ($row) {
                    $btnEdit = '<button class="btn btn-sm btn-success editBtn" data-id="' . $row->id . '"><i class="bx bx-edit"></i></button>';
                    $btnShow = '<button class="btn btn-info btn-sm" onclick="detail_anggota(' . $row->id . ')"><i class="bx bx-show"></i></button>';
                    $btnDelete = '<button type="button" class="btn btn-danger deleteBtn" data-id="' . $row->id . '"><i class="bx bx-trash"></i></button>';

                    // Tombol Verifikasi
                    if (!$row->verifikasi) {
                        $btnVerif = '<button type="button" class="btn btn-primary btn-sm btnVerif" data-id="' . $row->id . '">
                                        <i class="bx bx-check-circle"></i>
                                    </button>';
                    } else {
                        $btnVerif = '<button class="btn btn-secondary btn-sm" disabled>✔</button>';
                    }

                    return $btnEdit . ' ' . $btnShow . ' ' . $btnDelete . ' ' . $btnVerif;
                })
                ->rawColumns(['verifikasi', 'action'])   // izinkan HTML di kolom
                ->make(true);
        }

        // Jika bukan request AJAX, kembalikan view index
        return view("keanggotaan.index");
    }

    // Tidak digunakan, tapi Anda mengembalikan $this->registerRepository sebagai JSON
    public function create()
    {
        $data = $this->registerRepository;

        return response()->json($data);
    }


    // Menyimpan data anggota baru
    public function store(Request $request)
    {
        // Validasi input
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
            "foto" => "nullable|image|max:2048", // max 2MB
            "tanggal_daftar" => "required|date",

            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            
        ]);

        // Validasi nomor telepon harus diawali dengan +62
        if (!str_starts_with($validated['no_telepon'], '+62')) {
            return back()->withInput()->withErrors([
                'no_telepon' => 'Nomor telepon harus diawali dengan +62.'
            ]);
        }

        // upload jika foto ada
        if ($request->hasFile('foto')) {
        $fileName = UploadFileHelper::upload('anggota', $validated['nama'], $request->file('foto'));

        if ($fileName) {
            $validated['foto'] = 'anggota/' . $fileName;
        } else {
            return back()->with('error', 'Gagal mengunggah foto.');
        }
    }

        // Buat akun user
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Tambahkan user_id ke dalam data anggota
        $validated['user_id'] = $user->id;

        // Simpan data ke anggota
        $data = Anggota::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Anggota Berhasil Dibuat!'
            ]);
        }

        return $data
            ? redirect("/keanggotaan")->with("success", "Anggota Berhasil Dibuat!")
            : back()->with("error", "Something Error!");
    }


    // Menampilkan data anggota untuk edit
    public function edit($id)
    {
        $data = Anggota::findOrFail($id);
        // $data = Anggota::with(['bukus', 'anggotas', 'kategoris'])->findOrFail($id);

        $bukus = Buku::all();
        $anggotas = Anggota::all();
        $kategoris = Kategori::all();

        return response()->json([
            'data' => $data,
            // 'bukus' => $bukus,
            // 'anggotas' => $anggotas,
            // 'kategoris' => $kategoris,
        ]);
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            "nik" => "required|string|max:255|unique:anggotas,nik," . $anggota->id,
            "nama" => "required|string|max:255",
            "tempat_lahir" => "required|string|max:255",
            "tanggal_lahir" => "required|date",
            "jenis_kelamin" => "required|string|max:255",
            "pendidikan" => "required|string|max:255",
            "alamat" => "nullable|string|max:255",
            "no_telepon" => "required|string|max:20",
            "status" => "required|string|max:255",
            "foto" => "nullable|image|max:2048",
            "tanggal_daftar" => "required|date"
        ]);

        // Validasi no telepon
        if (!str_starts_with($validated['no_telepon'], '+62')) {
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => ['no_telepon' => 'Nomor telepon harus diawali dengan +62.']
                ], 422);
            }

            return back()->withInput()->withErrors([
                'no_telepon' => 'Nomor telepon harus diawali dengan +62.'
            ]);
        }

        // Jika ada foto baru, hapus yang lama dan upload yang baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($anggota->foto) {
                $oldPath = str_replace(Storage::url(''), '', $anggota->foto); // buang '/storage/'
                UploadFileHelper::delete($oldPath);
            }

            $fileName = UploadFileHelper::upload('anggota', $validated['nama'], $request->file('foto'));

            if ($fileName) {
                $validated['foto'] = 'anggota/' . $fileName;
            } else {
                return back()->with('error', 'Gagal mengunggah foto.');
            }
        }

        // Update data di database
        $anggota->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui'
            ]);
        }

        return redirect("/keanggotaan")->with('success', 'Data berhasil diperbarui');
    }

   
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->forceDelete(); // Hapus permanen dari database

        return response()->json(['message' => 'Data berhasil dihapus secara permanen.']);
    }

    // Menampilkan halaman detail anggota
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('keanggotaan.show', compact('anggota'));
    }


    // Melakukan verifikasi terhadap anggota
    public function verifikasi($id)
    {
        $anggota = Anggota::findOrFail($id);

        if ($anggota->verifikasi) {
            return response()->json(['message' => 'Anggota sudah diverifikasi sebelumnya']);
        }

        $anggota->update([
            'verifikasi' => true
        ]);

        return response()->json(['message' => 'Berhasil diverifikasi']);
    }

}
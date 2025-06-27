<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;        // Namespace untuk controller API
use App\Http\Requests\Anggotas\StoreRequest;    // Import class-class yang dibutuhkan
use App\Http\Requests\Anggotas\UpdateRequest;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\UploadFileHelper;

class AnggotaController extends Controller
{
    /**
     * Menampilkan semua data anggota (GET /api/anggota).
     */
    public function index()
    {
        // try {
        //     $anggota = Anggota::all();
        //     return response()->json([
        //         "success" => true,
        //         "data" => $anggota
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => $e->getMessage()
        //     ], 500);
        // }
    }

    /**
     * Menyimpan anggota baru (POST /api/anggota).
     */
    public function store(StoreRequest $request)
    {
        // try {

        //     $validatedData = $request->validated();

        //     if ($request->hasFile('foto')) {

        //         $fileName = UploadFileHelper::upload(
        //             'anggota',
        //             $validatedData['nama'],
        //             $request->file('foto')
        //     );

        //     if ($fileName) {
        //             $validated['foto'] = 'anggota/' . $fileName; // unutk menghaslkan url 
        //         } else {
        //             return response()->json([
        //                 "success" => false,
        //                 "message" => "Gagal mengunggah foto."
        //             ], 500);
        //         }
        //     } else {
        //         $validatedData['foto'] = null;
        //     }

        //     $anggota = Anggota::create($validatedData);

        //     return response()->json([
        //         "success" => true,
        //         "data" => $anggota
        //     ], 201);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => $e->getMessage()
        //     ], 500);
        // }
    }

    /**
     * Menampilkan detail anggota (GET /api/anggota/{id}).
     */
    public function show(string $id)
    {
        try {
            $anggota = Anggota::find($id);      // Cari data anggota berdasarkan ID
            if (!$anggota) {
                return response()->json([       
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "data" => $anggota
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui data anggota (PUT /api/anggota/{id}).
     */
    public function update(UpdateRequest $request)
    {
        try {
            $anggota = $request->user()->anggota;

            if (!$anggota) {
                return response()->json([
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }

            // Validasi data dari request
            $validatedData = $request->validated();

            $anggota->update($validatedData);

            return response()->json([
                "success" => true,
                "data" => $anggota,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus data anggota (DELETE /api/anggota/{id}).
     */
    public function destroy(string $id)
    {
        // try {
        //     $anggota = Anggota::find($id);
        //     if (!$anggota) {
        //         return response()->json([
        //             "success" => false,
        //             "message" => "Anggota not found"
        //         ], 404);
        //     }

        //     // Hapus foto dari storage saat anggota dihapus
        //     if ($anggota->foto) {
        //         $pathToDelete = str_replace(Storage::url(''), '', $anggota->foto);
        //         UploadFileHelper::delete($pathToDelete, 'public');
        //     }

        //     $anggota->delete();
        //     return response()->json([
        //         "success" => true,
        //         "message" => "Anggota deleted"
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => $e->getMessage()
        //     ], 500);
        // }
    }

    //Mencari anggota berdasarkan nama (GET /api/anggota/search/{name}).
    public function search(string $name)
    {
        // try {
        //     $anggota = Anggota::where('nama', 'like', "%$name%")->get();
        //     return response()->json([
        //         "success" => true,
        //         "message" => $anggota
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => $e->getMessage()
        //     ]);
        // }
    }

    public function editPhoto(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }
            $validatedData = $request->validate([
                'foto' => "required|image|mimes:jpg,jpeg,png,webp|max:2048"
            ]);

            $anggota = $user->anggota;
            $imageData = $request->file('foto');

            if ($imageData) {
                UploadFileHelper::delete("anggota/{$anggota->foto}");
                $imageName = UploadFileHelper::upload("anggota", $anggota->nama, $imageData);
            }

            $anggota->update([
                'foto' => $imageName
            ]);

            return response()->json([
                "success" => true,
                "message" => "Foto berhasil di perbaharui"
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function showProfile(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }

            return response()->json([
                "success" => true,
                "data" => $user->anggota
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;        // Namespace untuk controller API
use App\Http\Requests\Anggotas\StoreRequest;    // Import class-class yang dibutuhkan
use App\Http\Requests\Anggotas\UpdateRequest;
use App\Models\Anggota;
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
    public function update(UpdateRequest $request, string $id)
    {
        try {
            $anggota = Anggota::find($id);
            if (!$anggota) {
                return response()->json([
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }

            // Validasi data dari request
            $validatedData = $request->validated();

            // Cek jika ada upload foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($anggota->foto) {
                    $oldPath = str_replace(Storage::url(''), '', $anggota->foto);
                    UploadFileHelper::delete($oldPath, 'public');
                }

                // Upload foto baru
                $fileName = UploadFileHelper::upload(
                    'anggota',
                    $anggota->nama,
                    $request->file('foto')
                );

                 // Jika berhasil upload
                if ($fileName) {
                    $validated['foto'] = 'anggota/' . $fileName;
                } else {
                    return response()->json([
                        "success" => false,
                        "message" => "Gagal mengunggah foto baru."
                    ], 500);
                }

                // Jika field foto diset null (hapus foto)
            } else if (array_key_exists('foto', $validatedData) && $validatedData['foto'] === null) {
                if ($anggota->foto) {
                    $oldPath = str_replace(Storage::url(''), '', $anggota->foto);
                    UploadFileHelper::delete($oldPath, 'public');
                    $validatedData['foto'] = null;
                }
            } else {
                unset($validatedData['foto']);      // Jika tidak ada perubahan pada foto
            }

            $anggota->update($validatedData);

            return response()->json([
                "success" => true,
                "data" => $anggota,
                // Ini hanya contoh jika frontend ingin redirect ke form edit-foto
                "edit_foto_url" => route('anggota.edit-foto', ['id' => $anggota->id])
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
    
}

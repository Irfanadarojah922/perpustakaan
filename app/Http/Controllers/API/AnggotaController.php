<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggotas\StoreRequest;
use App\Http\Requests\Anggotas\UpdateRequest;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\UploadFileHelper;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
        //             $validatedData['foto'] = Storage::url('anggota/' . $fileName); // unutk menghaslkan url 
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $anggota = Anggota::find($id);
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggotas\StoreRequest;
use App\Http\Requests\Anggotas\UpdateRequest;
use App\Models\Anggota;
use App\Models\Kategoris;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $anggota = Anggota::all();
            return response()->json([
                "success" => true,
                "data" => $anggota
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $anggota = Anggota::create($request->validated());
            return response()->json([
                "success" => true,
                "data" => $anggota
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
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
            $anggota->update($request->validated());
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Kategoris::find($id);
            if (!$category) {
                return response()->json([
                    "success" => false,
                    "message" => "Anggota not found"
                ], 404);
            }
            $category->delete();
            return response()->json([
                "success" => true,
                "message" => "Anggota deleted"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    public function search(string $name)
    {
        try {
            $category = Kategoris::where('nama_kategori', 'like', "%$name%")->get();
            return response()->json([
                "success" => true,
                "message" => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}

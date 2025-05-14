<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kembali\StoreRequest;
use App\Http\Requests\Kembali\UpdateRequest;
use App\Models\Kembali;
use App\Models\Kategoris;


class KembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kembali = Kembali::all();
            return response()->json([
                "success" => true,
                "data" => $kembali
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
            $kembali = Kembali::create($request->validated());
            return response()->json([
                "success" => true,
                "data" => $kembali
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
            $kembali = Kembali::find($id);
            if (!$kembali) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "data" => $kembali
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
            $kembali = Kembali::find($id);
            if (!$kembali) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            $kembali->update($request->validated());
            return response()->json([
                "success" => true,
                "data" => $kembali
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
            $kembali = Kembali::find($id);
            if (!$kembali) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            $kembali->delete();
            return response()->json([
                "success" => true,
                "message" => "Pinjam deleted"
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
            $category = Kategori::where('nama_kategori', 'like', "%$name%")->get();
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
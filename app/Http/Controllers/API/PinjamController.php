<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pinjams\StoreRequest;
use App\Http\Requests\Pinjams\UpdateRequest;
use App\Models\Pinjam;
use App\Models\Kategori;


class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pinjam = Pinjam::all();
            return response()->json([
                "success" => true,
                "data" => $pinjam
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
            $pinjam = Pinjam::create($request->validated());
            return response()->json([
                "success" => true,
                "data" => $pinjam
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
            $pinjam = Pinjam::find($id);
            if (!$pinjam) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "data" => $pinjam
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
            $pinjam = Pinjam::find($id);
            if (!$pinjam) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            $pinjam->update($request->validated());
            return response()->json([
                "success" => true,
                "data" => $pinjam
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
            $pinjam = Pinjam::find($id);
            if (!$pinjam) {
                return response()->json([
                    "success" => false,
                    "message" => "Pinjam not found"
                ], 404);
            }
            $pinjam->delete();
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
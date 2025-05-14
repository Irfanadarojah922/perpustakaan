<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Buku;
use App\Models\Kategori;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $buku = Buku::all();
            return response()->json([
                "success" => true,
                "data" => $buku
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
            $buku = Buku::create($request->validated());
            return response()->json([
                "success" => true,
                "data" => $buku
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
            $buku = Buku::find($id);
            if (!$buku) {
                return response()->json([
                    "success" => false,
                    "message" => "Book not found"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "data" => $buku
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
            $buku = Buku::find($id);
            if (!$buku) {
                return response()->json([
                    "success" => false,
                    "message" => "Book not found"
                ], 404);
            }
            $buku->update($request->validated());
            return response()->json([
                "success" => true,
                "data" => $buku
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
            $buku = Buku::find($id);
            if (!$buku) {
                return response()->json([
                    "success" => false,
                    "message" => "Book not found"
                ], 404);
            }
            $buku->delete();
            return response()->json([
                "success" => true,
                "message" => "Book deleted"
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
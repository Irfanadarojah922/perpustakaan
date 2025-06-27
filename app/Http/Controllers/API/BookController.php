<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Menampilkan daftar buku (GET /api/books).
    // Mendukung pencarian berdasarkan judul atau penulis.
    public function index(Request $request)
    {
        try {
            $query = Buku::query();

            // Jika ada parameter pencarian
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where('judul', 'like', "%$search%")
                    ->orWhere('penulis', 'like', "%$search%");
            }

            $buku = $query->get();
            
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
     * Menyimpan buku baru (POST /api/books).
     */
    public function store(StoreRequest $request)
    {
        try {
            // Validasi otomatis dari StoreRequest
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
     * Menampilkan detail buku berdasarkan ID (GET /api/books/{id}).
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
     * Memperbarui data buku berdasarkan ID (PUT /api/books/{id}).
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
     * Menghapus buku berdasarkan ID (DELETE /api/books/{id}).
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

    //Mencari buku berdasarkan judul (GET /api/books/search/{name}).
    public function search(string $name)
    {
        try {
           $buku = Buku::where('judul', 'like', "%$name%")->get();
            return response()->json([
                "success" => true,
                "message" => $buku
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
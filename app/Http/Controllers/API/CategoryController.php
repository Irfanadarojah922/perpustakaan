<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Kategori;
use GrahamCampbell\ResultType\Success;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Kategori::all();
            return response()->json([
                "success" => true,
                "data" => $categories
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
            $category = Kategori::create($request->validated());
            return response()->json([
                "success" => true,
                "data" => $category
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
            $category = Kategori::find($id);
            if (!$category) {
                return response()->json([
                    "success" => false,
                    "message" => "Category not found"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "data" => $category
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
            $category = Kategori::find($id);
            if (!$category) {
                return response()->json([
                    "success" => false,
                    "message" => "Category not found"
                ], 404);
            }
            $category->update($request->validated());
            return response()->json([
                "success" => true,
                "data" => $category
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
            $category = Kategori::find($id);
            if (!$category) {
                return response()->json([
                    "success" => false,
                    "message" => "Category not found"
                ], 404);
            }
            $category->delete();
            return response()->json([
                "success" => true,
                "message" => "Category deleted"
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

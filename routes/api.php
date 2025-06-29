<?php

use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PerpusdaController;
use App\Http\Controllers\API\PinjamController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\KembaliController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name("api.")
    ->group(function () {
        Route::post("register", [RegisterController::class, 'store'])->name('register');
        Route::middleware(['auth:api'])
            ->group(function () {
                Route::apiResource('perpusda', PerpusdaController::class);

                Route::apiResource('category', CategoryController::class);
                Route::get('search', [CategoryController::class, 'search']);

                Route::apiResource('buku', BookController::class);
                Route::get('/books/search/{name}', [BookController::class, 'search']);

                Route::apiResource('pinjam', PinjamController::class);
                Route::get('/pinjams/search/{name}', [PinjamController::class, 'search']);


                Route::apiResource('kembali', KembaliController::class);

                //anggota route
                Route::middleware(['UserMustBeVerified'])
                    ->group(function () {
                    Route::get('/anggota/profile', [AnggotaController::class, 'showProfile'])->name('anggota.profile');
                });
                Route::get('/anggota/search/{name}', [AnggotaController::class, 'search']);
                Route::put('/anggota/update', [AnggotaController::class, 'update']);
                Route::put('/anggota/edit-foto', [AnggotaController::class, 'editPhoto'])->name('anggota.edit-foto');
            });
    });


Route::post('login', [AuthController::class, 'login']);


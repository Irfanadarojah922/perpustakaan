<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PerpusdaController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\PinjamController;

use App\Http\Resources\PerpusdaResource;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('perpusda', PerpusdaController::class)->middleware('auth:api');

Route::apiResource('category', CategoryController::class)->middleware('auth:api');
Route::get('search', [CategoryController::class, 'search']);

Route::apiResource('buku', BookController::class)->middleware('auth:api');

Route::apiResource('anggota', AnggotaController::class)->middleware('auth:api');

Route::apiResource('pinjam', PinjamController::class)->middleware('auth:api');


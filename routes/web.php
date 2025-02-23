<?php

use App\Http\Controllers\WEB\AnggotaController;
use App\Http\Controllers\WEB\PeminjamanController;
use App\Http\Controllers\WEB\PengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard', [
    ]);
});

Route::get('/katalog', function () {
    return view('katalog.index', [
    ]);
});

Route::resource('/keanggotaan', AnggotaController::class);

Route::resource('/sirkulasi/peminjaman', PeminjamanController::class);

Route::resource('/sirkulasi/pengembalian', PengembalianController::class);
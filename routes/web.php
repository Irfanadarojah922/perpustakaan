<?php

use App\Http\Controllers\WEB\AnggotaController;
use App\Http\Controllers\WEB\BookController;
use App\Http\Controllers\WEB\PeminjamanController;
use App\Http\Controllers\WEB\PengembalianController;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\WEB\KatalogController;
use App\Http\Controllers\WEB\RegisterController;
use App\Http\Controllers\WEB\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/register', RegisterController::class)->only(['index']);

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Group route yang hanya bisa diakses oleh user yang sudah login (auth middleware)
Route::middleware(['web', 'auth'])
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Katalog buku (hanya index dan show detail)
        Route::resource('/katalog', KatalogController::class)->only(["index", "show"]);


        Route::resource('/keanggotaan', AnggotaController::class);
        Route::get('/keanggotaan/{id}/edit', [AnggotaController::class, 'edit']);
        Route::get('/keanggotaan/create', [AnggotaController::class, 'create']);
        Route::get('/keanggotaan/show/{id}', [AnggotaController::class, 'show'])->name('keanggotaan.show');
        Route::delete('/keanggotaan/{id}', [AnggotaController::class, 'destroy']);

        Route::put('/keanggotaan/{id}/verifikasi', [AnggotaController::class, 'verifikasi'])->name('keanggotaan.verifikasi');

        Route::resource('/sirkulasi/peminjaman', PeminjamanController::class);
        Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit']);
        Route::get('/peminjaman/add', [PeminjamanController::class, 'add']);
        Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('pinjam.update');
        Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy']);


        Route::resource('/sirkulasi/pengembalian', PengembalianController::class);
        Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit']);
        Route::get('/pengembalian/add', [PengembalianController::class, 'add']);
        Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('kembali.update');
        Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy']);


        Route::resource('buku', BookController::class)->only(["store", "create"]);

        Route::get('search/peminjaman/anggota', [PeminjamanController::class, 'searchAnggotaByNIK'])->name('search.peminjaman.anggota');
        Route::get('search/peminjaman/buku', [PeminjamanController::class, 'searchBukuByKodeBuku'])->name('search.peminjaman.buku');

        Route::get('search/pengembalian/buku', [PengembalianController::class, 'searchBukuByKodeBuku'])->name('search.pengembalian.buku');

        Route::get('search/keanggotaan/anggota', [AnggotaController::class, 'searchAnggota'])->name('search.keanggotaan.anggota');

        Route::get('search/buku/dipinjam', [PengembalianController::class, 'searchBukuByKodeBukuInBorrowed'])->name('search.buku.dipinjam');

    });

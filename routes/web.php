<?php

use App\Http\Controllers\WEB\AnggotaController;
use App\Http\Controllers\WEB\BookController;
use App\Http\Controllers\WEB\PeminjamanController;
use App\Http\Controllers\WEB\PengembalianController;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\WEB\KatalogController;
use App\Http\Controllers\WEB\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});         //->middleware(RedirectIfAuthenticated::redirectUsing('dashboard'));

// Route::group(['middleware' => ''], function () {

// Route::get('/dashboard', function (Request $request) {
//     // dd(Auth::guard()->user());
//     return view('pages.dashboard');
// });

Route::resource('/register', RegisterController::class)->only(['index']);


Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/katalog', function () {
//     return view('katalog.index', [
//     ]);
// });

// Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

// Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

// Route::get('/katalog/{id}', [KatalogController::class, 'detail'])->name('katalog.detail');

// Route::post('/katalog', [KatalogController::class, 'store'])->name('katalog.store');

Route::resource('/katalog', KatalogController::class)->only(["index", "show"]);


Route::resource('/keanggotaan', AnggotaController::class);
Route::get('/keanggotaan/show/{id}', [AnggotaController::class, 'show'])->name('keanggotaan.show');
Route::delete('/keanggotaan/{id}', [AnggotaController::class, 'destroy']);



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


// });

// Route::get('/getByname', [PeminjamanController::class, 'getByName'])->name('getByName');
// Route::get('/sirkulasi', [PeminjamanController::class, 'PeminjamanByAnggotaId'])->name('peminjaman.byanggota');

//Buku

Route::resource('buku', BookController::class)->only(["store", "create"]);

Route::get('search/peminjaman/anggota', [PeminjamanController::class, 'searchAnggotaByNIK'])->name('search.peminjaman.anggota');
Route::get('search/peminjaman/buku', [PeminjamanController::class, 'searchBukuByKodeBuku'])->name('search.peminjaman.buku');

Route::get('search/pengembalian/buku', [PengembalianController::class, 'searchBukuByKodeBuku'])->name('search.pengembalian.buku');

Route::get('search/keanggotaan/anggota', [AnggotaController::class, 'searchAnggota'])->name('search.keanggotaan.anggota');

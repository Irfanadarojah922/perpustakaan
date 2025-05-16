<?php

use App\Http\Controllers\WEB\AnggotaController;
use App\Http\Controllers\WEB\PeminjamanController;
use App\Http\Controllers\WEB\PengembalianController;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\WEB\KatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});         //->middleware(RedirectIfAuthenticated::redirectUsing('dashboard'));

Route::group(['middleware' => 'auth'], function () {
    
    // Route::get('/dashboard', function (Request $request) {
    //     // dd(Auth::guard()->user());
    //     return view('pages.dashboard');
    // });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route::get('/katalog', function () {
    //     return view('katalog.index', [
    //     ]);
    // });

    // Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

    // Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

    // Route::get('/katalog/{id}', [KatalogController::class, 'detail'])->name('katalog.detail');

    // Route::post('/katalog', [KatalogController::class, 'store'])->name('katalog.store');

    Route::resource('/katalog', KatalogController::class);
    
    Route::resource('/keanggotaan', AnggotaController::class);

    Route::resource('/sirkulasi/peminjaman', PeminjamanController::class);
    Route::get('/pinjam/{id}/edit', [PeminjamanController::class, 'edit']);
    Route::put('/pinjam/{id}', [PeminjamanController::class, 'update'])->name('pinjam.update');

    Route::resource('/sirkulasi/pengembalian', PengembalianController::class);

});

// Route::get('/getByname', [PeminjamanController::class, 'getByName'])->name('getByName');
// Route::get('/sirkulasi', [PeminjamanController::class, 'PeminjamanByAnggotaId'])->name('peminjaman.byanggota');


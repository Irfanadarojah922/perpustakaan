<?php

use App\Http\Controllers\WEB\AnggotaController;
use App\Http\Controllers\WEB\PeminjamanController;
use App\Http\Controllers\WEB\PengembalianController;
use App\Http\Controllers\WEB\DashboardController;
use App\Http\Controllers\TransaksiController;
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

    Route::get('/transaksi-terakhir', [TransaksiController::class, 'transaksiTerakhir']);
    
    Route::get('/pengingat', [TransaksiController::class, 'pengingat']);

    Route::get('/katalog', function () {
        return view('katalog.index', [
        ]);
    });

    Route::resource('/keanggotaan', AnggotaController::class);

    Route::resource('/sirkulasi/peminjaman', PeminjamanController::class);

    Route::resource('/sirkulasi/pengembalian', PengembalianController::class);

});

// Route::get('/getByname', [PeminjamanController::class, 'getByName'])->name('getByName');
// Route::get('/sirkulasi', [PeminjamanController::class, 'PeminjamanByAnggotaId'])->name('peminjaman.byanggota');


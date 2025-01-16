<?php

use App\Http\Controllers\WEB\AnggotaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard', [
    ]);
});

Route::get('/katalog', function () {
    return view('katalog.katalog', [
    ]);
});

Route::resource('/keanggotaan', AnggotaController::class);

Route::get('/sirkulasi', function () {
    return view('sirkulasi.sirkulasi', [
    ]);
});


<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json([
                'message' => 'User ini tidak terdaftar, silahkan cek kembali !!'
            ], 400);
        }

        $user = auth()->user();

        // Cek apakah user punya relasi ke anggota
        // if (!$user->anggota) {
        //     return response()->json([
        //         'message' => 'Akun ini belum terdaftar sebagai anggota.'
        //     ], 403);
        // }

        // // Cek status verifikasi anggota
        // if (!$user->anggota->verifikasi) {
        //     return response()->json([
        //         'message' => 'Akun Anda belum diverifikasi oleh admin.'
        //     ], 403);
        // }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }
}

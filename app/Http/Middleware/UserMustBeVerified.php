<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustBeVerified
{
    /**
     * Menangani permintaan masuk dan memastikan bahwa pengguna telah diverifikasi.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Jika request mengharapkan response dalam format JSON (biasanya API)
        if($request->expectJson()) {

            // Cek apakah user belum diverifikasi oleh admin
            if(!$user->anggota->verifikasi) {

                // Jika belum diverifikasi, kembalikan response JSON dengan status 403 (Forbidden)
                return response()->json([
                    'message' => 'Akun Anda belum diverifikasi oleh admin.'
                ], 403);
            }
        }

        // Jika user sudah diverifikasi atau request tidak mengharapkan JSON, lanjutkan ke proses berikutnya
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMustBeVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if($request->expectJson()) {
            if(!$user->anggota->verifikasi) {
                return response()->json([
                    'message' => 'Akun Anda belum diverifikasi oleh admin.'
                ], 403);
            }
        }
        return $next($request);
    }
}

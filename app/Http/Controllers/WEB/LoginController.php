<?php

// namespace App\Http\Controllers\WEB;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\Anggota;

// class LoginController extends Controller
// {
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->only('email', 'password');

//         if (Auth::attempt($credentials)) {
//             $user = Auth::user();
//             $anggota = Anggota::where('email', $user->email)->first();

//             if (!$anggota || $anggota->verifikasi !== 'terverifikasi') {
//                 Auth::logout();
//                 return redirect()->back()->withErrors([
//                     'email' => 'Akun Anda belum diverifikasi oleh admin.'
//                 ]);
//             }

//             return redirect()->intended('/dashboard');
//         }

//         return redirect()->back()->withErrors([
//             'email' => 'Email atau password salah.'
//         ]);
//     }

//     public function logout()
//     {
//         Auth::logout();
//         return redirect('/login');
//     }
//}

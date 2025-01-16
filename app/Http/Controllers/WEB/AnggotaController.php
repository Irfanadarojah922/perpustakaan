<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::all();
        if (\request()->ajax()) {

            $anggota = Anggota::all();
            return DataTables::of($anggota)->make(true);
        }

        return view("keanggotaan.index", compact('anggota'));
    }
    public function store(Request $request)
    {
        $data = Anggota::create($request->validate([
            "nama" => "required|string|max:255",
            "email" => "required|string|max:255",
            "password" => "required|string|max:255",
            "no_telepon" => "required|string|max:255",
            "alamat" => "required|string|max:255",
            "tanggal_daftar" => "required|string|max:255",
            "status" => "required|string|max:255",
            "foto" => "nullable|string|max:255",
        ]));

        return $data ? redirect("/keanggotaan")->with("success", "Anggota 
        Created Successfully!") : back()->with("error", "Something Error!");
    }
}
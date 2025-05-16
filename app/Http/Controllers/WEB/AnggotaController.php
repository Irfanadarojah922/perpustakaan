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
            return DataTables::of($anggota)->addColumn("action", function($row){
                $action =
                        '<td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#edit_modal"> <i class="bx bx-edit" style="font-size:1rem;"></i></button>
                                <button type="button" class="btn btn-danger"> <i class="bx bx-trash" style="font-size:1rem;"></i></button>
                            </div>
                        </td>';
            return $action;
            })->make(true);
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
<?php
namespace App\Repositories;

use App\Http\Helpers\UploadFileHelper;
use App\Http\Requests\Anggotas\StoreRequest;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterRepository
{
    public function store(StoreRequest $storeRequest)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'email'    => $storeRequest->email,
                'password' => Hash::make($storeRequest->password),
            ]);

            $imageData = $storeRequest->file("foto");


            $foto = UploadFileHelper::upload(
                prefix: "anggota",
                name: $storeRequest->nama,
                uploadedFile: $imageData
            );

            $anggota = Anggota::create(
                array_merge(
                    $storeRequest->except(['email', 'password', 'foto']),
                    [
                        "user_id"        => $user->id,
                        "foto"           => $foto,
                    ]
                )
            );

            DB::commit();

            return $anggota;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

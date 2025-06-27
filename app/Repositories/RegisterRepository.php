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

    //Menyimpan data pendaftaran anggota baru beserta user login-nya.
    public function store(StoreRequest $storeRequest)
    {
        try {
            DB::beginTransaction();

            // Simpan data user login (akun) ke tabel users
            $user = User::create([
                'email'    => $storeRequest->email,
                'password' => Hash::make($storeRequest->password),      // Enkripsi password
            ]);

            // Ambil file foto dari request
            $imageData = $storeRequest->file("foto");


            // Upload foto ke storage dan simpan nama filenya
            $foto = UploadFileHelper::upload(
                prefix: "anggota",          // Nama folder
                name: $storeRequest->nama,      // Nama file (diambil dari nama anggota)
                uploadedFile: $imageData        // File foto yang diupload
            );

            // Simpan data anggota ke tabel anggotas
            $anggota = Anggota::create(
                array_merge(
                    $storeRequest->except(['email', 'password', 'foto']),       // Ambil data selain email, password, foto
                    [
                        "user_id"        => $user->id,      // Hubungkan dengan user_id dari tabel users
                        "foto"           => $foto,          // Simpan nama file foto yang telah diupload
                    ]
                )
            );

            // Simpan perubahan ke database
            DB::commit();

            return $anggota;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}

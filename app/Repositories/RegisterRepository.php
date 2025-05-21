<?php

namespace App\Repositories;

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
                'email' => $storeRequest->email,
                'password' => Hash::make($storeRequest->password)
            ]);
            $anggota = Anggota::create(
                array_merge(
                    $storeRequest->except(['email', 'password']),
                    [
                        "user_id" => $user->id
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
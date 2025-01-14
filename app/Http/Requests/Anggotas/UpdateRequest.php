<?php

namespace App\Http\Requests\Anggotas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nama" => "nullable|string|max:255|anggotas,nama",
            "email" =>"nullable|string|max:255|anggotas,email",
            "password" => "nullable|string|max:255|anggotas,password",
            "no_telepon" => "nullable|string|max:255|anggotas,no_telepon",
            "alamat" => "nullable|string|max:255|anggotas,alamat",
            "tanggal_daftar" => "nullable|string|anggotas,tanggal_daftar",
            "status" => "nullable|string|max:255|anggotas,status",
            "foto" => "nullable|string|anggotas,foto",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'errors' => $validator->getMessageBag(),
            ],
            422
        ));
    }
}
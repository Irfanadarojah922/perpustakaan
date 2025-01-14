<?php

namespace App\Http\Requests\Pinjams;

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
            "tanggal_pinjam" => "nullable|string|max:255|tanggal_pinjam",
            "tanggal_kembali" => "nullable|string|max:255|pinjams,tanggal_kembali",
            "status_pengembalian" => "nullable|string|max:255|pinjams,status_pengembalian",
            "anggota_id" => "nullable|string|max:255|pinjams,anggota_id",
            "buku_id" => "nullable|string|max:255|pinjams,buku_id",
            "kategori_id" => "nullable|string|max:255|pinjams,kategori_id",

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
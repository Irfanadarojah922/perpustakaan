<?php

namespace App\Http\Requests\Books;

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
            "judul" => "nullable|string|max:255|bukus,judul",
            "penulis" => "nullable|string|max:255|bukus,penulis",
            "penerbit" => "nullable|string|max:255|bukus,penerbit",
            "tahun_terbit" => "nullable|year|bukus,tahun_terbit",
            "kategori_id" => "nullable|string|max:255|bukus,kategori_id",
            "isbn" => "nullable|string|max:255|bukus,isbn",
            "jumlah_eksemplar" => "nullable|integer|max:255|bukus,jumlah_eksemplar",
            "jumlah_tersedia" => "nullable|integer|max:255|bukus,jumlah_tersedia",
            "deskripsi" => "nullable|longtext|bukus,deskripsi",
            "foto" => "nullable|string|bukus,foto",
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
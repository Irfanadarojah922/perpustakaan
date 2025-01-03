<?php

namespace App\Http\Requests\Books;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
            "judul" => "required|string|max:255|unique:bukus,judul",
            "penulis" => "required|string|max:255|bukus,penulis",
            "penerbit" => "required|string|max:255|bukus,penerbit",
            "tahun_terbit" => "required|year|bukus,tahun_terbit",
            "kategori_id" => "required|string|max:255|bukus,kategori_id",
            "isbn" => "required|string|max:255|bukus,isbn",
            "jumlah_eksemplar" => "required|integer|max:255|bukus,jumlah_eksemplar",
            "jumlah_tersedia" => "required|integer|max:255|bukus,jumlah_tersedia",
            "deskripsi" => "required|longtext|max:255|bukus,deskripsi",
            "foto" => "required|string|bukus,foto",
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

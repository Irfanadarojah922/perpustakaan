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
            'kode_buku'  => 'required|unique:bukus,kode_buku|string|max:255' ,
            "judul" => "required|string|max:255",
            "penulis" => "required|string|max:255",
            "penerbit" => "required|string|max:255",
            "tahun_terbit" => "required|digits:4|integer|min:1900|max:" . date('Y'),
            "kategori_id" => "required|exists:kategoris,id",
            "isbn" => "required|string|max:255",
            "jumlah_eksemplar" => "required|integer|max:255",
            "jumlah_tersedia" => "required|integer|max:255",
            "deskripsi" => "required|string",
            "foto" => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if($this->expectsJson()) {
            throw new HttpResponseException(response()->json(
                [
                    'success' => false,
                    'errors' => $validator->getMessageBag(),
                ],
                422
            ));
        }

        parent::failedValidation($validator);
    }
}


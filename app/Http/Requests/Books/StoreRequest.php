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
            "judul" => "required|string|max:255",
            "penulis" => "required|string|max:255",
            "penerbit" => "required|string|max:255",
            "tahun_terbit" => "required|integer",
            "kategori_id" => "required|string|max:255",
            "isbn" => "required|string|max:255",
            "jumlah_eksemplar" => "required|integer|max:255",
            "jumlah_tersedia" => "required|integer|max:255",
            "deskripsi" => "required|string",
            "foto" => "required|string",
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

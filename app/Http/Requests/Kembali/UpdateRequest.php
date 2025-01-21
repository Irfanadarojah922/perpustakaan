<?php

namespace App\Http\Requests\Kembali;

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
            "pinjam_id" => "nullable|string|max:255|pinjam_id",
            "buku_id" => "nullable|string|max:255|kembali,buku_id",
            "tanggal_kembali" => "nullable|string|max:255|kembali,tanggal_kembali",
            "denda" => "nullable|string|max:255|kembali,denda",
            "keterangan" => "nullable|string|max:255|kembali,keterangan",

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
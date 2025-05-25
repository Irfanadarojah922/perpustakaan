<?php
namespace App\Http\Requests\Anggotas;

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
            "nik"            => "required|string|unique:anggotas,nik|max:20",
            "nama"           => "required|string|max:255",
            "tempat_lahir"   => "required|string|max:255",
            "tanggal_lahir"  => "required|date",
            "jenis_kelamin"  => "required|string|max:255",
            "pendidikan"     => "required|string|max:255",
            "alamat"         => "required|string|max:255",
            'no_telepon'     => 'required|string|regex:/^\+\d{1,3}\s?\d{7,15}$/',
            "status"         => "required|string|max:255",
            "foto"           => "required|image|mimes:jpg,jpeg,png,webp|max:2048",
            "tanggal_daftar" => "required|date",
            "email"          => "required|string|unique:users,email|max:255",
            "password"       => "required|string|max:255",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                "success" => false,
                "errors"  => $validator->getMessageBag(),
            ],
            422
        ));
    }
}

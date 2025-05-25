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
            "nik"            => "nullable|string|unique:anggotas,nik|max:20",
            "nama"           => "nullable|string|max:255",
            "tempat_lahir"   => "nullable|string|max:255",
            "tanggal_lahir"  => "nullable|date|date_format:d/m/Y",
            "jenis_kelamin"  => "nullable|string|max:255",
            "pendidikan"     => "nullable|string|max:255",
            "alamat"         => "nullable|string|max:255",
            "no_telepon"     => "nullable|string|regex:/^\+\d{1,3}\s?\d{7,15}$/",
            "status"         => "nullable|string|max:255",
            "foto"           => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "tanggal_daftar" => "nullable|date|date_format:d/m/Y",
            "email"          => "nullable|string|unique:users,email|max:255",
            "password"       => "nullable|string|max:255",
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

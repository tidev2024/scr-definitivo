<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordRequest extends FormRequest
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
        'new_password' => ['required', 'min:4', 'confirmed'],
        'password'     => ['required']
    ];
}

public function messages()
{
    return [
        'new_password' => [
            'required' => 'Este campo é obrigatório.',
            'min' => 'Mínimo de :min caracteres.',
            'confirmed' => 'A confirmação da nova senha não corresponde.'
        ],
        'password' => [
            'required' => 'Este campo é obrigatório.'
        ],
        'new_password_confirmation' => [
            'required' => 'Este campo é obrigatório.'
        ]
    ];
}

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
{
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
            'name' => ['required', 'unique:positions']
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Preencha o nome',
                'unique' => 'Departamento já cadastrado'
            ]
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->has('active') ? true : false,
            'master' => $this->has('master') ? true : false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'cpf' => ['required', 'max:11', 'min:11', new Cpf],
            'password' => ['required', 'min:4'],
            'email' => ['email', 'required', 'unique:users,email'],
            'active' => ['boolean'],
            'master' => ['boolean'],
            'department_id' => ['required', 'exists:departments,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'permission_id' => 'array',
            'permission_id.*' => ['integer', 'exists:permissions,id']
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Preencha o nome',
                'max' => 'Limite de :max caracteres'
            ],
            'cpf' => [
                'required' => 'Preencha o cpf',
                'max' => 'Limite de :max caracteres',
                'min' => 'Mínimo de :min caracteres',
                'cpf' => 'Cpf inválido'
            ],
            'password' => [
                'required' => 'Preencha a senha',
                'min' => 'Mínimo de :min caracteres'
            ],
            'email' => [
                'email' => 'Email inválido',
                'required' => 'Preencha o email',
                'unique' => 'Email já cadastrado no sistema'
            ],
            'department_id' => [
                'required' => 'Selecione um departamento',
                'exists' => 'Departamento não encontrado'
            ],
            'position_id' => [
                'required' => 'Selecione um cargo',
                'exists' => 'Cargo não encontrado'
            ],
            'permission_id.array' => 'Erro ao selecionar permissões',
            'permission_id.*.integer' => 'Erro ao selecionar permissões',
            'permission_id.*.exists' => 'Erro ao selecionar permissões',
        ];
    }
}

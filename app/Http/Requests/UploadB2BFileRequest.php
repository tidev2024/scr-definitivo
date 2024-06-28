<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadB2BFileRequest extends FormRequest
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
            'invoicing_file' => ['required', 'file']
        ];
    }

    public function messages()
    {
        return [
            'invoicing_file' => [
                'required' => 'Selecione um arquivo antes de enviar!',
                'mimes' => 'O arquivo deve ser do tipo: csv'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->hasFile('invoicing_file')) {
            $this->merge([
                'invoicing_file_extension' => strtolower($this->file('invoicing_file')->getClientOriginalExtension()),
            ]);
        }
    }



    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!in_array($this->invoicing_file_extension, ['csv'])) {
                $validator->errors()->add('invoicing_file', 'O arquivo deve ter a extensão .csv');
            }
        });
    }
}

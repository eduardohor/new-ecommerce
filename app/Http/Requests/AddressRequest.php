<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'zip_code' => str_replace('-', '', $this->zip_code),
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
            'name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string',
            'zip_code' => 'required|string|size:8',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'neighborhood' => 'required|string|max:255',
        ];
    }

     /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais que 255 caracteres.',
            'street.required' => 'O campo rua é obrigatório.',
            'street.string' => 'O campo rua deve ser uma string.',
            'street.max' => 'O campo rua não pode ter mais que 255 caracteres.',
            'city.required' => 'O campo cidade é obrigatório.',
            'city.string' => 'O campo cidade deve ser uma string.',
            'city.max' => 'O campo cidade não pode ter mais que 255 caracteres.',
            'state.required' => 'O campo estado é obrigatório.',
            'state.string' => 'O campo estado deve ser uma string.',
            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.string' => 'O campo CEP deve ser uma string.',
            'zip_code.size' => 'O campo CEP deve ter 8 caracteres.',
            'number.required' => 'O campo número é obrigatório.',
            'number.string' => 'O campo número deve ser uma string.',
            'number.max' => 'O campo número não pode ter mais que 20 caracteres.',
            'complement.string' => 'O campo complemento deve ser uma string.',
            'complement.max' => 'O campo complemento não pode ter mais que 255 caracteres.',
            'neighborhood.required' => 'O campo bairro é obrigatório.',
            'neighborhood.string' => 'O campo bairro deve ser uma string.',
            'neighborhood.max' => 'O campo bairro não pode ter mais que 255 caracteres.',
        ];
    }
}

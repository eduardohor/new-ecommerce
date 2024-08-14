<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInfoRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'required|max:10',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:255',
        ];
    }

    /**
     * Mensagens de erro personalizadas em português.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser um texto.',
            'name.max' => 'O campo nome não pode exceder 255 caracteres.',

            'logo.image' => 'O campo logo deve ser uma imagem válida.',
            'logo.max' => 'O campo logo não pode exceder 2MB.',

            'address.string' => 'O campo endereço deve ser um texto.',
            'address.max' => 'O campo endereço não pode exceder 255 caracteres.',

            'zip_code.required' => 'O campo CEP é obrigatório.',
            'zip_code.max' => 'O campo CEP não pode exceder 10 caracteres.',

            'city.string' => 'O campo cidade deve ser um texto.',
            'city.max' => 'O campo cidade não pode exceder 255 caracteres.',

            'state.string' => 'O campo estado deve ser um texto.',
            'state.max' => 'O campo estado não pode exceder 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode exceder 255 caracteres.',

            'contact_number.required' => 'O campo número de contato é obrigatório.',
            'contact_number.string' => 'O campo número de contato deve ser um texto.',
            'contact_number.max' => 'O campo número de contato não pode exceder 255 caracteres.',
        ];
    }
}

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
            'logo' => 'nullable|image|max:2048|dimensions:width=170,height=40',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'required|max:10',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18',
            'facebook_url' => 'nullable|url|max:255',
            'x_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
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
            'logo.dimensions' => 'A imagem deve ter exatamente 170 pixels de largura e 40 pixels de altura.',

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

            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.string' => 'O campo CNPJ deve ser um texto.',
            'cnpj.max' => 'O campo CNPJ não pode exceder 18 caracteres.',

            'facebook_url.url' => 'O link do Facebook deve ser uma URL válida.',
            'facebook_url.max' => 'O link do Facebook não pode exceder 255 caracteres.',

            'x_url.url' => 'O link do X deve ser uma URL válida.',
            'x_url.max' => 'O link do X não pode exceder 255 caracteres.',

            'instagram_url.url' => 'O link do Instagram deve ser uma URL válida.',
            'instagram_url.max' => 'O link do Instagram não pode exceder 255 caracteres.',
        ];
    }
}

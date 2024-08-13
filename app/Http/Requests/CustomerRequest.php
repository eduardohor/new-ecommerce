<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    protected function prepareForValidation(): void
    {
        if ($this->filled('phone')) {
            $this->merge([
                'phone' => str_replace(['(', ')', ' ', '-'], '', $this->phone),
            ]);
        }

        if ($this->filled('birthdate')) {
            $this->merge([
                'birthdate' => Carbon::createFromFormat('d/m/Y', $this->birthdate)->format('Y-m-d')
            ]);
        }
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'max:15',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // 1MB max
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail já está em uso.',

            'phone.max' => 'O número de telefone não pode ter mais de 15 caracteres.',

            'profile_image.image' => 'O arquivo deve ser uma imagem.',
            'profile_image.mimes' => 'A imagem deve ser do tipo: jpg, jpeg, png, gif.',
            'profile_image.max' => 'A imagem não pode ter mais de 1MB.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class UserUpdateRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->filled('document')) {
            $this->merge([
                'document' => preg_replace('/\D+/', '', $this->input('document'))
            ]);
        }

        if ($this->filled('phone')) {
            $this->merge([
                'phone' => preg_replace('/\D+/', '', $this->input('phone'))
            ]);
        }
    }

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
        $id = $this->route('id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'document' => ['required', 'string', 'regex:/^(\\d{11}|\\d{14})$/', Rule::unique(User::class)->ignore($id)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.lowercase' => 'O campo de e-mail deve estar em letras minúsculas.',
            'email.email' => 'O endereço de e-mail deve ser válido',
            'email.max' => 'O campo e-mail deve ter no máximo 255 caracteres.',
            'email.unique' => 'O e-mail já está sendo utilizado.',
            'phone.string' => 'O campo telefone deve ser uma string.',
            'phone.max' => 'O campo telefone não pode ter mais de :max caracteres.',
            'document.required' => 'Informe o CPF ou CNPJ.',
            'document.regex' => 'Informe um CPF (11 dígitos) ou CNPJ (14 dígitos) válido.',
            'document.unique' => 'Este CPF/CNPJ já está cadastrado.',
        ];
    }
}

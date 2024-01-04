<?php

namespace App\Http\Requests;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class CategoryRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        // Format the 'slug' field using Str::slug
        if ($this->has('slug')) {
            // Format the 'slug' field using Str::slug
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        }

        // Convert the 'date' field format
        if ($this->has('date')) {
            // Convert the 'date' field format
            $this->merge([
                'date' => $this->convertDateFormat($this->date),
            ]);
        }
    }

    /**
     * Convert the date format from 'd/m/Y' to 'Y-m-d'.
     *
     * @param string|null $date
     * @return string|null
     */
    private function convertDateFormat(?string $date): ?string
    {
        if ($date) {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }

        return null;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        $rules =  [
            'parent_id' => ['nullable', 'exists:categories,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1048', 'dimensions:width=120,height=120'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($id),
            ],
            'date' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Ativo,Desabilitado'],
            'metatitle' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = [
                'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1048', 'dimensions:width=120,height=120'
            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'parent_id.exists' => 'A categoria superior selecionada é inválida.',
            'image.required' => 'A imagem é obrigatória.',
            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg, gif.',
            'image.max' => 'A imagem não deve ter mais de 1048 kilobytes.',
            'image.dimensions' => 'A imagem deve ter dimensões de 120x120 pixels.',
            'name.required' => 'O campo nome da categoria é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'slug.required' => 'O campo slug é obrigatório.',
            'slug.max' => 'O campo slug deve ter no máximo 255 caracteres.',
            'slug.unique' => 'Este slug já está sendo utilizado.',
            'date.date' => 'A data deve ser válida.',
            'description.max' => 'A descrição deve ter no máximo 255 caracteres.',
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser uma das opções permitidas.',
            'metatitle.max' => 'O campo metatítulo deve ter no máximo 255 caracteres.',
            'meta_description.max' => 'A meta descrição deve ter no máximo 255 caracteres.',
        ];
    }
}

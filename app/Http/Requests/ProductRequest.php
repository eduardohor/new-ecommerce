<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        // Convert the 'regular_price' and 'sale_price' fields to decimal format
        $this->merge([
            'regular_price' => $this->convertToDecimal($this->regular_price),
            'sale_price' => $this->convertToDecimal($this->sale_price),
            'weight' => $this->formatWeightForDatabase($this->weight),
            'in_stock' => $this->filled('in_stock') ? 1 : 0,
        ]);
    }

    private function formatWeightForDatabase($weight)
    {
        // Remove caracteres não numéricos, mantendo apenas dígitos e ponto decimal
        $numericValue = preg_replace('/[^0-9.]/', '', $weight);

        // Converte para decimal
        return (float) $numericValue;
    }

    private function convertToDecimal($value)
    {
        // Convert the value to a decimal format (assuming it's a currency input)
        $numericValue = (float) preg_replace('/[^0-9]/', '', $value);
        return $numericValue / 100;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('product');

        $rules =  [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'units' => 'nullable',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048|dimensions:width=800,height=600',
            'description' => 'nullable|string',
            'in_stock' => 'nullable|boolean',
            'product_code' => 'nullable|string',
            'sku' => 'nullable|string',
            'status' => 'required|in:ativo,desabilitado',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        if ($this->isMethod('PUT')) {
            $rules['images'] = [
                'nullable', 'array', 'min:1'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O campo título deve ser uma string.',
            'title.max' => 'O campo título não pode ter mais de 255 caracteres.',

            'category_id.required' => 'O campo categoria é obrigatório.',
            'category_id.exists' => 'A categoria selecionada é inválida.',

            'weight.required' => 'O campo peso é obrigatório.',
            'weight.numeric' => 'O campo peso deve ser número.',

            'units.in' => 'Unidades inválidas.',

            'images.required' => 'Pelo menos uma imagem é obrigatória.',
            'images.array' => 'O campo imagens deve ser um array.',
            'images.min' => 'Pelo menos uma imagem é obrigatória.',
            'images.*.image' => 'Cada arquivo de imagem deve ser uma imagem válida.',
            'images.*.mimes' => 'Cada imagem deve ser dos tipos: jpeg, png, jpg, gif.',
            'images.*.max' => 'Cada imagem não deve ter mais de 1048 kilobytes.',
            'images.*.dimensions' => 'A imagem deve ter dimensões de 800x600 pixels.',

            'description.string' => 'O campo descrição deve ser uma string.',

            'in_stock.boolean' => 'O campo em estoque deve ser verdadeiro ou falso.',

            'product_code.string' => 'O campo código do produto deve ser uma string.',

            'sku.string' => 'O campo SKU do produto deve ser uma string.',

            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser uma das opções permitidas.',

            'regular_price.required' => 'O campo preço regular é obrigatório.',
            'regular_price.numeric' => 'O campo preço regular deve ser um número.',

            'sale_price.numeric' => 'O campo preço de venda deve ser um número.',

            'meta_title.string' => 'O campo meta título deve ser uma string.',
            'meta_title.max' => 'O campo meta título não pode ter mais de 255 caracteres.',

            'meta_description.string' => 'O campo meta descrição deve ser uma string.',
        ];
    }
}

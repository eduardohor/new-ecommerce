<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'weight' => (double)$this->weight,
            'width' => (int)$this->width,
            'height' => (int)$this->height,
            'length' => (int)$this->length,
            'slug' => Str::slug($this->slug),
            'in_stock' => $this->filled('in_stock') ? 1 : 0,
        ]);
    }

    private function convertToDecimal($value)
    {
        // Convert the value to a decimal format (assuming it's a currency input)
        if ($value !== null) {
            $numericValue = (float) preg_replace('/[^0-9]/', '', $value);
            return $numericValue / 100;
        }

        return null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productId = $this->route('id') ?? $this->route('product');

        $rules =  [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'weight' => 'required|numeric',
            'quantity' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:1048|dimensions:width=800,height=600',
            'description' => 'nullable|string',
            'in_stock' => 'nullable|boolean',
            'product_code' => 'nullable|string',
            'sku' => 'nullable|string',
            'slug' => [
                'required',
                'string',
                Rule::unique('products', 'slug')->ignore($productId),
            ],
            'status' => 'required|in:ativo,desabilitado',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'sale_end_date' => 'nullable|date|after_or_equal:now',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['images'] = ['nullable', 'array', 'min:1'];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!($this->isMethod('PUT') || $this->isMethod('PATCH'))) {
                return;
            }

            $hasUploads = $this->hasFile('images');

            $productId = $this->route('id') ?? $this->route('product');
            $existingImagesCount = 0;

            if ($productId) {
                $product = Product::withCount('productImages')->find($productId);
                if ($product) {
                    $existingImagesCount = $product->product_images_count;
                }
            }

            if (!$hasUploads && $existingImagesCount === 0) {
                $validator->errors()->add('images', 'Pelo menos uma imagem é obrigatória.');
            }
        });
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

            'quantity.required' => 'O campo quantidade é obrigatório.',
            'quantity.numeric' => 'O campo quantidade deve ser número.',

            'width.required' => 'O campo largura é obrigatório.',
            'width.numeric' => 'O campo largura deve ser número.',

            'height.required' => 'O campo altura é obrigatório.',
            'height.numeric' => 'O campo altura deve ser número.',

            'length.required' => 'O campo comprimento é obrigatório.',
            'length.numeric' => 'O campo comprimento deve ser número.',


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

            'slug.required' => 'O campo slug é obrigatório.',
            'slug.string' => 'O campo slug do produto deve ser uma string.',
            'slug.unique' => 'O slug do produto já está em uso.',

            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O campo status deve ser uma das opções permitidas.',

            'regular_price.required' => 'O campo preço regular é obrigatório.',
            'regular_price.numeric' => 'O campo preço regular deve ser um número.',

            'sale_price.numeric' => 'O campo preço de venda deve ser um número.',

            'sale_end_date.date' => 'O campo data de término deve ser uma data válida.',
            'sale_end_date.after_or_equal' => 'A data de término deve ser agora ou futura.',

            'meta_title.string' => 'O campo meta título deve ser uma string.',
            'meta_title.max' => 'O campo meta título não pode ter mais de 255 caracteres.',

            'meta_description.string' => 'O campo meta descrição deve ser uma string.',
        ];
    }
}

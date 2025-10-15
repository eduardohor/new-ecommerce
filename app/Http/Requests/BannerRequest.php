<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $positions = array_keys(config('banners.positions', []));
        $position = $this->input('position');

        $imageRules = [
            'image',
            'mimes:jpeg,png,jpg,gif,webp',
            'max:4096',
        ];

        if ($dimensions = $this->imageDimensionsRule($position)) {
            $imageRules[] = $dimensions;
        }

        $rules = [
            'position' => ['required', 'string', Rule::in($positions)],
            'link_url' => ['nullable', 'url'],
            'open_new_tab' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = array_merge(['required'], $imageRules);
        } else {
            $rules['image'] = array_merge(['nullable'], $imageRules);
        }

        return $rules;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'open_new_tab' => $this->boolean('open_new_tab'),
            'is_active' => $this->boolean('is_active', true),
            'sort_order' => (int) $this->input('sort_order', 0),
        ]);
    }

    private function imageDimensionsRule(?string $position): ?string
    {
        $config = config('banners.positions.' . $position);

        if (!$config || empty($config['dimensions'])) {
            return null;
        }

        $dimensions = $config['dimensions'];

        if (!isset($dimensions['width']) || !isset($dimensions['height'])) {
            return null;
        }

        return sprintf('dimensions:width=%d,height=%d', $dimensions['width'], $dimensions['height']);
    }

    public function messages(): array
    {
        return [
            'position.required' => 'Selecione a posição do banner.',
            'position.in' => 'Posição inválida.',
            'link_url.url' => 'Informe um link válido (http/https).',
            'image.required' => 'Envie a imagem do banner.',
            'image.image' => 'O arquivo deve ser uma imagem.',
            'image.mimes' => 'Formatos permitidos: jpeg, png, jpg, gif, webp.',
            'image.dimensions' => 'A imagem deve ter o tamanho específico configurado para esta posição.',
        ];
    }
}

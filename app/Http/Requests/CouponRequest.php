<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('code')) {
            $this->merge([
                'code' => strtoupper(trim($this->code)),
            ]);
        }

        if ($this->filled('value')) {
            $this->merge([
                'value' => str_replace(',', '.', $this->value),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $couponId = $this->route('coupon')?->id ?? null;

        return [
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Coupon::class)->ignore($couponId),
            ],
            'type' => ['required', Rule::in(['fixed', 'percent'])],
            'value' => ['required', 'numeric', 'min:0.01'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['sometimes', 'boolean'],
            'min_order_value' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Informe o código do cupom.',
            'code.unique' => 'Este código já está em uso.',
            'type.required' => 'Selecione o tipo de desconto.',
            'type.in' => 'Tipo de desconto inválido.',
            'value.required' => 'Informe o valor do desconto.',
            'value.numeric' => 'O valor do desconto deve ser numérico.',
            'value.min' => 'O valor do desconto deve ser maior que zero.',
            'max_uses.integer' => 'A quantidade máxima deve ser um número inteiro.',
            'max_uses.min' => 'A quantidade máxima deve ser pelo menos 1.',
            'ends_at.after_or_equal' => 'A data de término deve ser posterior ou igual à data de início.',
            'min_order_value.numeric' => 'O valor mínimo deve ser numérico.',
            'min_order_value.min' => 'O valor mínimo deve ser maior ou igual a zero.',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['is_active'] = $this->boolean('is_active');

        if (!array_key_exists('max_uses', $data) || empty($data['max_uses'])) {
            $data['max_uses'] = null;
        }

        if (!array_key_exists('min_order_value', $data) || $data['min_order_value'] === null || $data['min_order_value'] === '') {
            $data['min_order_value'] = null;
        }

        if ($data['type'] === 'percent' && $data['value'] > 100) {
            $data['value'] = 100;
        }

        return $data;
    }
}

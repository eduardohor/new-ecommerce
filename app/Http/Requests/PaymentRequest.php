<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        $this->merge([
            'amount' => $this->formatAmount($this->amount),
        ]);
    }

    private function formatAmount($amount): ?float
    {
        if ($amount) {
            $amount = str_replace(['R$', ' ', '.'], '', $amount);

            $amount = str_replace(',', '.', $amount);

            return (float) $amount;
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
        return [
            'order_number' => 'required|exists:orders,order_number',
            'payment_type' => 'required|string|max:255',
            'transaction_id' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,failed',
            'installments' => 'nullable|integer|min:1|max:12',
            'payment_method' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'order_number.required' => 'O campo pedido é obrigatório.',
            'order_number.exists' => 'O pedido selecionado é inválido.',
            'payment_type.required' => 'O campo tipo de pagamento é obrigatório.',
            'payment_type.string' => 'O campo tipo de pagamento deve ser uma string.',
            'payment_type.max' => 'O campo tipo de pagamento não pode ter mais que 255 caracteres.',
            'transaction_id.required' => 'O campo ID da transação é obrigatório.',
            'transaction_id.string' => 'O campo ID da transação deve ser uma string.',
            'transaction_id.max' => 'O campo ID da transação não pode ter mais que 255 caracteres.',
            'amount.required' => 'O campo valor é obrigatório.',
            'amount.numeric' => 'O campo valor deve ser numérico.',
            'amount.min' => 'O valor deve ser pelo menos 0.',
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.',
            'installments.integer' => 'O campo parcelas deve ser um número inteiro.',
            'installments.min' => 'O número mínimo de parcelas é 1.',
            'installments.max' => 'O número máximo de parcelas é 12.',
            'payment_method.string' => 'O campo método de pagamento deve ser uma string.',
            'payment_method.max' => 'O campo método de pagamento não pode ter mais que 255 caracteres.',
        ];
    }
}

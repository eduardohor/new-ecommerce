<?php

namespace App\Services;

use App\Models\StoreInfo;
use App\Models\FreeShippingZipRange;
use Illuminate\Support\Facades\Log;

class FreeShippingService
{
    protected ?StoreInfo $storeInfo = null;

    /**
     * Construtor - carrega configurações da loja
     */
    public function __construct()
    {
        $this->storeInfo = StoreInfo::first();
    }

    /**
     * Verifica se o frete grátis deve ser aplicado
     *
     * @param string $zipCode CEP do cliente
     * @param float $cartTotal Total do carrinho
     * @return bool
     */
    public function shouldApplyFreeShipping(string $zipCode, float $cartTotal): bool
    {
        // Verifica se o frete grátis está habilitado
        if (!$this->isFreeShippingEnabled()) {
            return false;
        }

        // Obtém o tipo de regra configurada
        $type = $this->storeInfo->free_shipping_type;

        // Aplica verificação conforme o tipo de regra
        return match ($type) {
            'zip_range' => $this->checkZipRange($zipCode),
            'minimum_value' => $this->checkMinimumValue($cartTotal),
            'both' => $this->checkZipRange($zipCode) || $this->checkMinimumValue($cartTotal),
            default => false,
        };
    }

    /**
     * Verifica se o frete grátis está habilitado
     *
     * @return bool
     */
    public function isFreeShippingEnabled(): bool
    {
        return $this->storeInfo && $this->storeInfo->hasFreeShippingEnabled();
    }

    /**
     * Verifica se o CEP do cliente está em uma faixa cadastrada
     *
     * @param string $zipCode
     * @return bool
     */
    public function checkZipRange(string $zipCode): bool
    {
        if (!$this->storeInfo || !$this->storeInfo->usesZipRangeRule()) {
            return false;
        }

        // Remove formatação do CEP
        $cleanZip = FreeShippingZipRange::cleanZipCode($zipCode);

        // Busca faixas de CEP ativas que contenham este CEP
        $ranges = FreeShippingZipRange::findByZipCode($cleanZip);

        $hasMatch = $ranges->isNotEmpty();

        if ($hasMatch) {
            Log::info('Frete grátis aplicado por faixa de CEP', [
                'zip_code' => $zipCode,
                'clean_zip' => $cleanZip,
                'ranges_found' => $ranges->count()
            ]);
        }

        return $hasMatch;
    }

    /**
     * Verifica se o valor do carrinho atinge o mínimo para frete grátis
     *
     * @param float $cartTotal
     * @return bool
     */
    public function checkMinimumValue(float $cartTotal): bool
    {
        if (!$this->storeInfo || !$this->storeInfo->usesMinimumValueRule()) {
            return false;
        }

        $minimumValue = (float) $this->storeInfo->free_shipping_minimum_value;

        // Verifica se há valor mínimo de pedido configurado
        $minimumOrder = (float) $this->storeInfo->free_shipping_minimum_order;

        // Se o carrinho não atingir o valor mínimo do pedido, não aplica frete grátis
        if ($minimumOrder > 0 && $cartTotal < $minimumOrder) {
            return false;
        }

        $hasMinimum = $minimumValue > 0 && $cartTotal >= $minimumValue;

        if ($hasMinimum) {
            Log::info('Frete grátis aplicado por valor mínimo', [
                'cart_total' => $cartTotal,
                'minimum_value' => $minimumValue,
                'minimum_order' => $minimumOrder
            ]);
        }

        return $hasMinimum;
    }

    /**
     * Aplica frete grátis às opções de frete retornadas pela API
     *
     * @param array $shippingOptions Opções de frete da API Melhor Envio
     * @param string $zipCode CEP do cliente
     * @param float $cartTotal Total do carrinho
     * @return array
     */
    public function applyFreeShippingToOptions(array $shippingOptions, string $zipCode, float $cartTotal): array
    {
        // Verifica se deve aplicar frete grátis
        if (!$this->shouldApplyFreeShipping($zipCode, $cartTotal)) {
            return $shippingOptions;
        }

        // Aplica frete grátis em todas as opções
        return array_map(function ($option) {
            $option['original_price'] = $option['price'] ?? 0;
            $option['price'] = 0;
            $option['is_free'] = true;
            $option['free_shipping_reason'] = $this->getFreeShippingReason($option['original_price']);
            return $option;
        }, $shippingOptions);
    }

    /**
     * Retorna a razão pela qual o frete ficou grátis
     *
     * @param float $originalPrice
     * @return string
     */
    protected function getFreeShippingReason(float $originalPrice): string
    {
        if (!$this->storeInfo) {
            return 'Frete Grátis';
        }

        $type = $this->storeInfo->free_shipping_type;

        return match ($type) {
            'zip_range' => 'Frete grátis para sua região',
            'minimum_value' => sprintf(
                'Frete grátis em compras acima de R$ %.2f',
                $this->storeInfo->free_shipping_minimum_value
            ),
            'both' => 'Frete grátis aplicado',
            default => 'Frete Grátis',
        };
    }

    /**
     * Calcula quanto falta para o cliente atingir o frete grátis
     * Útil para mensagens de incentivo
     *
     * @param float $cartTotal
     * @return float|null Retorna null se já atingiu o mínimo ou se não usa regra de valor
     */
    public function calculateAmountToFreeShipping(float $cartTotal): ?float
    {
        if (!$this->storeInfo || !$this->storeInfo->usesMinimumValueRule()) {
            return null;
        }

        $minimumValue = (float) $this->storeInfo->free_shipping_minimum_value;

        if ($minimumValue <= 0 || $cartTotal >= $minimumValue) {
            return null;
        }

        return $minimumValue - $cartTotal;
    }

    /**
     * Obtém as configurações de frete grátis
     *
     * @return array
     */
    public function getSettings(): array
    {
        if (!$this->storeInfo) {
            return [
                'enabled' => false,
                'type' => null,
                'minimum_value' => 0,
                'minimum_order' => 0,
            ];
        }

        return [
            'enabled' => $this->storeInfo->free_shipping_enabled,
            'type' => $this->storeInfo->free_shipping_type,
            'minimum_value' => (float) $this->storeInfo->free_shipping_minimum_value,
            'minimum_order' => (float) $this->storeInfo->free_shipping_minimum_order,
            'uses_zip_range' => $this->storeInfo->usesZipRangeRule(),
            'uses_minimum_value' => $this->storeInfo->usesMinimumValueRule(),
        ];
    }

    /**
     * Verifica se o valor mínimo do pedido foi atingido
     * (diferente do valor mínimo para frete grátis)
     *
     * @param float $cartTotal
     * @return bool
     */
    public function meetsMinimumOrderValue(float $cartTotal): bool
    {
        if (!$this->storeInfo) {
            return true;
        }

        $minimumOrder = (float) $this->storeInfo->free_shipping_minimum_order;

        return $minimumOrder <= 0 || $cartTotal >= $minimumOrder;
    }
}

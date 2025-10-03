<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShippingService
{
    protected $tokenMelhorEnvio;
    protected $baseUrl;
    protected $userAgent;

    public function __construct()
    {
        $this->tokenMelhorEnvio = config('melhorenvio.token');
        $this->baseUrl = config('melhorenvio.base_url');
    }

    public function calculateShipping($postalCodeFrom, $postalCodeTo, $products)
    {
        $body = [
            'from' => [
                'postal_code' => $postalCodeFrom,
            ],
            'to' => [
                'postal_code' => $postalCodeTo,
            ],
            'products' => $products,
        ];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->tokenMelhorEnvio}",
                'Content-Type' => 'application/json',
            ])->withOptions([
                'verify' => false,
            ])->post($this->baseUrl . '/api/v2/me/shipment/calculate', $body)->json();

            return $response;
        } catch (\Exception $e) {
            Log::error('Erro ao calcular envio Melhor Envio: ' . $e->getMessage());
            throw new \Exception('Erro ao calcular envio. ' . $e->getMessage());
        }
    }
}

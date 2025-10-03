<?php

return [
    'token' => env('MELHOR_ENVIO_TOKEN'),
    'base_url' => env('MELHOR_ENVIO_BASE_URL', 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate'),
    'user_agent' => env('MELHOR_ENVIO_USER_AGENT', 'Aplicação (contato@exemplo.com)')
];

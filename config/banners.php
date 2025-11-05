<?php

return [
    'positions' => [
        'home.hero' => [
            'label' => 'Home - Slider Principal',
            'max_items' => 5,
            'dimensions' => ['width' => 1660, 'height' => 625],
            'mobile_dimensions' => ['width' => 750, 'height' => 920],
            'notes' => 'Slider da primeira dobra; utilize imagem com boa resolução.'
        ],
        'home.featured' => [
            'label' => 'Home - Banners em Destaque (2 colunas)',
            'max_items' => 2,
            'dimensions' => ['width' => 780, 'height' => 30],
            'mobile_dimensions' => ['width' => 600, 'height' => 200],
            'notes' => 'Bloco com duas colunas logo abaixo das categorias.'
        ],
        'home.deal' => [
            'label' => 'Home - Banner Lateral (Mais Vendidos)',
            'max_items' => 1,
            'dimensions' => ['width' => 375, 'height' => 525],
            'mobile_dimensions' => ['width' => 360, 'height' => 420],
            'notes' => 'Banner alto que aparece ao lado do carrossel de mais vendidos.'
        ],
        'store.sidebar' => [
            'label' => 'Loja - Banner Sidebar',
            'max_items' => 1,
            'dimensions' => ['width' => 785, 'height' => 415],
            'mobile_dimensions' => ['width' => 360, 'height' => 210],
            'notes' => 'Banner exibido na coluna esquerda da listagem de produtos.'
        ],
    ],
];

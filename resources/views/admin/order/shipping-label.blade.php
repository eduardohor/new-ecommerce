<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etiqueta de Envio - Pedido {{ $order->order_number }}</title>
    <style>
        @page {
            margin: 10mm;
            size: a5 landscape;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .container {
            width: 100%;
            padding: 5px;
            page-break-after: avoid;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 2px solid #000;
        }

        .logo-section img {
            max-width: 80px;
            max-height: 25px;
        }

        .logo-section h3 {
            font-size: 12px;
            margin-top: 2px;
        }

        .shipping-info {
            display: table;
            width: 100%;
            border: 2px solid #000;
            table-layout: fixed;
        }

        .column {
            display: table-cell;
            width: 50%;
            padding: 6px;
            vertical-align: top;
        }

        .column:first-child {
            border-right: 2px solid #000;
        }

        .column h4 {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 4px;
            padding-bottom: 2px;
            border-bottom: 1px solid #333;
            text-transform: uppercase;
        }

        .info-line {
            margin-bottom: 2px;
            word-wrap: break-word;
            font-size: 9px;
        }

        .info-line strong {
            font-weight: bold;
            font-size: 10px;
        }

        .cep {
            font-size: 10px;
            font-weight: bold;
            margin-top: 4px;
            padding: 2px;
            background-color: #f0f0f0;
            border: 1px solid #000;
            text-align: center;
        }

        .order-number {
            text-align: center;
            margin-top: 4px;
            padding: 4px;
            background-color: #000;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo-section">
            @if($storeInfo && $storeInfo->logo)
                <img src="{{ public_path('storage/' . $storeInfo->logo) }}" alt="Logo">
            @else
                <h3>{{ $storeInfo->name ?? 'Loja' }}</h3>
            @endif
        </div>

        <!-- Shipping Info -->
        <div class="shipping-info">
            <!-- Remetente -->
            <div class="column">
                <h4>Remetente</h4>
                <div class="info-line">
                    <strong>{{ $storeInfo->name ?? 'Loja' }}</strong>
                </div>
                <div class="info-line">
                    {{ $storeInfo->address ?? '' }}@if($storeInfo->number), {{ $storeInfo->number }}@endif
                </div>
                @if($storeInfo->complement)
                <div class="info-line">
                    {{ $storeInfo->complement }}
                </div>
                @endif
                <div class="info-line">
                    {{ $storeInfo->city ?? '' }} - {{ $storeInfo->state ?? '' }}
                </div>
                <div class="cep">
                    CEP: {{ $storeInfo->zip_code ?? '' }}
                </div>
            </div>

            <!-- Destinatário -->
            <div class="column">
                <h4>Destinatário</h4>
                <div class="info-line">
                    <strong>{{ $order->user->name }}</strong>
                </div>
                <div class="info-line">
                    {{ $order->address->street }}, {{ $order->address->number }}
                </div>
                @if($order->address->complement)
                <div class="info-line">
                    {{ $order->address->complement }}
                </div>
                @endif
                <div class="info-line">
                    {{ $order->address->neighborhood ?? '' }}
                </div>
                <div class="info-line">
                    {{ $order->address->city }} - {{ $order->address->state }}
                </div>
                <div class="cep">
                    CEP: {{ $order->address->zip_code }}
                </div>
            </div>
        </div>

        <!-- Order Number -->
        <div class="order-number">
            PEDIDO #{{ $order->order_number }}
        </div>
    </div>
</body>
</html>

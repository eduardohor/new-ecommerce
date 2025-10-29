<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura Pedido {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header,
        .footer {
            text-align: center;
            padding: 10px;
        }

        .content {
            margin: 20px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #000;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
        }

        .details-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .details-table td {
            vertical-align: top;
            padding: 5px;
        }

        .details-section {
            width: 33%;
        }
    </style>
</head>

<body>
    @php
    use Carbon\Carbon;

    Carbon::setLocale('pt_BR');

    $subtotal = $order->products->reduce(function ($carry, $product) {
        return $carry + ($product->pivot->price * $product->pivot->quantity);
    }, 0);

    $discount = max($order->coupon_discount ?? 0, 0);
    $itemsTotal = max($subtotal - $discount, 0);
    $shipping = $order->shipping;
    $shippingPrice = $shipping->shipping_price ?? 0;
    $grandTotal = $order->total_amount ?? ($itemsTotal + $shippingPrice);

    $paymentLabel = match ($order->payment->payment_type ?? '') {
        'credit_card' => 'Cartão de Crédito',
        'bank_transfer' => 'Pix',
        default => 'Outro Método de Pagamento',
    };
    @endphp
    <div class="container">
        <div class="header">
            <h2>Fatura Pedido #{{ $order->order_number }}</h2>
        </div>

        <div class="content">
            <table class="details-table">
                <tr>
                    <td class="details-section">
                        <h3>Detalhes do Cliente</h3>
                        <p>{{ $order->user->name }}<br>{{ $order->user->email }}<br>{{ $order->user->phone }}<br>
                            @if ($order->user->formatted_document)
                                Documento: {{ $order->user->formatted_document }}
                            @endif
                        </p>
                    </td>
                    <td class="details-section">
                        <h3>Endereço de Envio</h3>
                        <p>{{ $order->address->street }}, {{ $order->address->number }}<br>{{ $order->address->city }} -
                            {{ $order->address->state }}<br>{{ $order->address->zip_code }}</p>
                    </td>
                    <td class="details-section">
                        <h3>Detalhes do Pedido</h3>
                        <p>ID do Pedido: {{ $order->order_number }}<br>Data do Pedido: {{
                            $order->created_at->translatedFormat('d M Y') }}<br>Total do Pedido: R${{
                            number_format($grandTotal, 2, ',', '.') }}
                            @if ($order->coupon_discount > 0)
                                <br>
                                @if ($order->coupon_code)
                                    Cupom: {{ $order->coupon_code }}<br>
                                @endif
                                Desconto aplicado: - R${{ number_format($discount, 2, ',', '.') }}
                            @endif
                        </p>
                    </td>
                </tr>
            </table>

            <h3>Produtos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produtos</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>R${{ number_format($product->pivot->price, 2, ',', '.') }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>R${{ number_format($product->pivot->price * $product->pivot->quantity, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Subtotal</td>
                        <td>R${{ number_format($subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @if ($discount > 0)
                    <tr>
                        <td colspan="3">Desconto @if ($order->coupon_code) (Cupom {{ $order->coupon_code }}) @endif</td>
                        <td>- R${{ number_format($discount, 2, ',', '.') }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="3">Frete</td>
                        <td>R${{ number_format($shippingPrice, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Total Geral</strong></td>
                        <td><strong>R${{ number_format($grandTotal, 2, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>

            @if ($shipping)
                <h3>Informações de Entrega</h3>
                @if ($shipping->shipping_option === 'pickup')
                    <p><strong>Retirada na loja</strong><br>
                        @if (!empty($shipping->pickup_address))
                            Endereço: {{ $shipping->pickup_address }}<br>
                        @endif
                        @if (!empty($shipping->pickup_hours))
                            Horário: {{ $shipping->pickup_hours }}<br>
                        @endif
                        @if (!empty($shipping->pickup_instructions))
                            Observações: {{ $shipping->pickup_instructions }}<br>
                        @endif
                        Valor do frete: R${{ number_format($shippingPrice, 2, ',', '.') }}
                    </p>
                @else
                    <p><strong>Entrega</strong><br>
                        Transportadora: {{ $shipping->shipping_company }}<br>
                        Serviço: {{ $shipping->shipping_type }}<br>
                        Prazo estimado: {{ $shipping->shipping_minimum_term }} a {{ $shipping->shipping_deadline }} dias<br>
                        Valor do frete: R${{ number_format($shippingPrice, 2, ',', '.') }}
                        @if (!empty($shipping->tracking_number))
                            <br>Código de rastreio: {{ $shipping->tracking_number }}
                        @endif
                    </p>
                @endif
            @endif

            <h3>Informação do Pagamento</h3>
            <p>{{ $paymentLabel }}</p>

            <h3>ID da transação</h3>
            <p>{{ $order->payment->transaction_id }}</p>

            <h3>Anotações</h3>
            <p>{{ $order->notes }}</p>
        </div>

    </div>
</body>

</html>

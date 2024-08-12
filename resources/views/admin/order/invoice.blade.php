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
                        <p>{{ $order->user->name }}<br>{{ $order->user->email }}<br>{{ $order->user->phone }}</p>
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
                            number_format($order->total_amount, 2, ',', '.') }}</p>
                    </td>
                </tr>
            </table>

            <h3>Produtos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produtos</th>
                        <th>Preço</th>
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
                        <td colspan="3">Frete</td>
                        <td>R${{ number_format($order->shipping->shipping_price, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Total Geral</strong></td>
                        <td><strong>R${{ number_format($order->total_amount, 2, ',', '.') }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <h3>Informação do Pagamento</h3>
            <p>{{ $order->payment->payment_type == 'credit_card' ? 'Cartão de Crédito' : 'Pix' }}</p>

            <h3>Anotações</h3>
            <p>{{ $order->notes }}</p>
        </div>

    </div>
</body>

</html>

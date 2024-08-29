@php
use Carbon\Carbon;
Carbon::setLocale('pt_BR');
@endphp

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px;">

    <div style="text-align:center; margin: 20px 0;">
        <img src="{{ $storeInfo && $storeInfo->logo ? url('storage/' . $storeInfo->logo) : url('images/logo/freshcart-logo.svg') }}" alt="{{ config('app.name') }} Logo"
            style="width: 100%; max-width: 250px; margin-bottom: 20px;">
    </div>

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h2 style="color: #333333;">Confirmação do Pedido #{{ $order->order_number }}</h2>
                <p style="color: #777777; font-size: 14px;">Obrigado por sua compra! Abaixo estão os detalhes do seu
                    pedido.</p>
            </td>
        </tr>

        <!-- Detalhes do Cliente e Pedido -->
        <tr>
            <td style="padding: 20px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="padding-bottom: 10px; width: 50%; vertical-align: top;">
                            <h4 style="color: #333333; margin-bottom: 5px;">Detalhes do Cliente</h4>
                            <p style="color: #555555; margin: 0;">{{ $order->user->name }}<br>{{ $order->user->email
                                }}<br>{{ $order->user->phone }}</p>
                        </td>

                        <td style="padding-bottom: 10px; width: 50%; vertical-align: top;">
                            <h4 style="color: #333333; margin-bottom: 5px;">Endereço de Entrega</h4>
                            <p style="color: #555555; margin: 0;">{{ $order->address->street }}, {{
                                $order->address->number }}<br>{{ $order->address->city }} - {{ $order->address->state
                                }}<br>{{ $order->address->zip_code }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0; width: 50%; vertical-align: top;">
                            <h4 style="color: #333333; margin-bottom: 5px;">Detalhes do Pedido</h4>
                            <p style="color: #555555; margin: 0;">Data do Pedido: {{
                                $order->created_at->translatedFormat('d M Y') }}<br>Total do Pedido: R${{
                                number_format($order->total_amount, 2, ',', '.') }}</p>
                        </td>

                        <td style="padding: 10px 0; width: 50%; vertical-align: top;">
                            <h4 style="color: #333333; margin-bottom: 5px;">Informação do Pagamento</h4>
                            <p style="color: #555555; margin: 0;">Método de Pagamento:
                                @if ($order->payment->payment_type == 'credit_card')
                                Cartão de Crédito
                                @elseif ($order->payment->payment_type == 'bank_transfer')
                                Pix
                                @else
                                Outro Método de Pagamento
                                @endif
                            </p>
                            <p style="color: #555555; margin: 0;">ID da Transação: {{ $order->payment->transaction_id }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Produtos -->
        <tr>
            <td style="padding: 20px;">
                <h4 style="color: #333333; margin-bottom: 15px;">Produtos</h4>
                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="border: 1px solid #dddddd; border-radius: 5px;">
                    <thead style="background-color: #f7f7f7;">
                        <tr>
                            <th style="padding: 10px; text-align: left; color: #555555;">Produto</th>
                            <th style="padding: 10px; text-align: right; color: #555555;">Preço</th>
                            <th style="padding: 10px; text-align: right; color: #555555;">Quantidade</th>
                            <th style="padding: 10px; text-align: right; color: #555555;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #dddddd;">
                                {{ $product->title }}
                            </td>
                            <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dddddd;">
                                R${{ number_format($product->pivot->price, 2, ',', '.') }}
                            </td>
                            <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dddddd;">
                                {{ $product->pivot->quantity }}
                            </td>
                            <td style="padding: 10px; text-align: right; border-bottom: 1px solid #dddddd;">
                                R${{ number_format($product->pivot->price * $product->pivot->quantity, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"
                                style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">Subtotal
                            </td>
                            <td style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">R${{
                                number_format($order->products->sum(fn($product) => $product->pivot->price *
                                $product->pivot->quantity), 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"
                                style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">Frete</td>
                            <td style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">R${{
                                number_format($order->shipping->shipping_price, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"
                                style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">Total Geral
                            </td>
                            <td style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">R${{
                                number_format($order->total_amount, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 20px 0;">
                <p style="color: #777777; font-size: 12px;">Obrigado por comprar na {{ $storeInfo->name ?? config('app.name') }}! Qualquer dúvida, entre em
                    contato conosco.</p>
            </td>
        </tr>
    </table>

</body>

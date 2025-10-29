@php
use Carbon\Carbon;
Carbon::setLocale('pt_BR');
@endphp

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px;">

    <div style="text-align:center; margin: 20px 0;">
        <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}" alt="{{ config('app.name') }} Logo"
            style="width: 100%; max-width: 250px; margin-bottom: 20px;">
    </div>

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h2 style="color: #333333;">Confirmação do Pedido Nº {{ $order->order_number }}</h2>
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
                                }}<br>{{ $order->user->phone }}
                                @if ($order->user->formatted_document)
                                    <br>Documento: {{ $order->user->formatted_document }}
                                @endif
                            </p>
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
                            <p style="color: #555555; margin: 0;">
                                Data do Pedido: {{ $order->created_at->translatedFormat('d M Y') }}<br>
                                Total do Pedido: R${{ number_format($order->total_amount, 2, ',', '.') }}
                                @if ($order->coupon_discount > 0)
                                    <br>
                                    @if ($order->coupon_code)
                                        Cupom aplicado: {{ $order->coupon_code }}<br>
                                    @endif
                                    Desconto em itens: - R${{ number_format($order->coupon_discount, 2, ',', '.') }}
                                @endif
                            </p>
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
                        @if ($order->coupon_discount > 0)
                        <tr>
                            <td colspan="3"
                                style="padding: 10px; text-align: right; font-weight: bold; color: #333333;">
                                Desconto @if ($order->coupon_code) (Cupom {{ $order->coupon_code }}) @endif
                            </td>
                            <td style="padding: 10px; text-align: right; font-weight: bold; color: #2f855a;">
                                - R${{ number_format($order->coupon_discount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endif
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
        @if ($order->shipping)
        <tr>
            <td style="padding: 20px;">
                @if ($order->shipping->shipping_option === 'pickup')
                    <p style="margin: 0; color: #555555; font-size: 15px;">
                        <strong>Retirada na loja:</strong> seu pedido estará disponível para retirada sem custo de frete.
                        @if ($order->shipping->pickup_address)
                            <br>Endereço: {{ $order->shipping->pickup_address }}
                        @endif
                        @if ($order->shipping->pickup_hours)
                            <br>Horário de atendimento: {{ $order->shipping->pickup_hours }}
                        @endif
                        @if ($order->shipping->pickup_instructions)
                            <br>{{ $order->shipping->pickup_instructions }}
                        @endif
                    </p>
                @else
                    <p style="margin: 0; color: #555555; font-size: 15px;">
                        <strong>Entrega:</strong> {{ $order->shipping->shipping_company }} ({{ $order->shipping->shipping_type }}).<br>
                        Valor do frete: R${{ number_format($order->shipping->shipping_price, 2, ',', '.') }}<br>
                        Prazo estimado: {{ $order->shipping->shipping_minimum_term }} a {{ $order->shipping->shipping_deadline }} dias.
                    </p>
                @endif
            </td>
        </tr>
        @endif

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 20px; background-color: #333; color: #ffffff; border-radius: 0 0 8px 8px;">
                <p style="margin: 0; font-size: 14px;">Obrigado por comprar na {{ $storeInfo->name ?? config('app.name') }}! Estamos à disposição para qualquer dúvida.</p>
            </td>
        </tr>
    </table>

</body>

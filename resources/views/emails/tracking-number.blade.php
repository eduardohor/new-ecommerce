<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px;">

    <div style="text-align:center; margin: 20px 0;">
        <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
            style="width: 100%; max-width: 250px; margin-bottom: 20px;">
    </div>

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h2 style="color: #333333;">Seu código de Rastreio para o Pedido Nº {{ $order->order_number }}</h2>
                <p style="color: #777777; font-size: 14px;">O código de rastreio do seu pedido foi adicionado ou atualizado com sucesso.</p>
            </td>
        </tr>

        @if ($order->shipping->shipping_option === 'pickup')
            <tr>
                <td style="padding: 20px;">
                    <p style="color: #555555; font-size: 16px;">
                        Seu pedido Nº {{ $order->order_number }} está pronto para retirada na loja.
                        @if ($order->shipping->pickup_address)
                            <br><strong>Endereço:</strong> {{ $order->shipping->pickup_address }}
                        @endif
                        @if ($order->shipping->pickup_hours)
                            <br><strong>Horário:</strong> {{ $order->shipping->pickup_hours }}
                        @endif
                        @if ($order->shipping->pickup_instructions)
                            <br>{{ $order->shipping->pickup_instructions }}
                        @endif
                        <br><br>Apresente este e-mail no balcão para facilitar a retirada.
                    </p>
                </td>
            </tr>
        @else
            <!-- Detalhes do Código de Rastreio -->
            <tr>
                <td style="padding: 20px;">
                    <p style="color: #555555; font-size: 16px;">
                        <strong>Código de Rastreio:</strong> {{ $order->shipping->tracking_number }}<br>
                        <strong>Transportadora:</strong> {{  $order->shipping->shipping_company }}<br>
                        <strong>Prazo Estimado:</strong> {{  $order->shipping->shipping_minimum_term }} a {{  $order->shipping->shipping_deadline }} dias<br><br>
                        Você pode acompanhar o status do seu pedido utilizando o código de rastreio fornecido. Para isso, visite o site da transportadora ou utilize a plataforma de rastreamento correspondente.
                    </p>
                </td>
            </tr>
        @endif

        <!-- Contatos -->
        @if($storeInfo)
        <tr>
            <td style="padding: 20px; background-color: #f7f7f7; border-radius: 8px;">
                <h3 style="color: #333333; text-align: center;">Contatos</h3>
                <p style="color: #555555; font-size: 14px; text-align: center;">
                    <strong>Email:</strong> {{ $storeInfo->email }}<br>
                    <strong>Telefone:</strong> {{ $storeInfo->contact_number }}<br>
                </p>
            </td>
        </tr>
        @endif

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 20px; background-color: #333; color: #ffffff; border-radius: 0 0 8px 8px;">
                <p style="margin: 0; font-size: 14px;">Obrigado por comprar na {{ $storeInfo->name ?? config('app.name') }}! Se precisar de ajuda, estamos à disposição para qualquer dúvida.</p>
            </td>
        </tr>
    </table>

</body>

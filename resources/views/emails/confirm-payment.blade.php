<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="text-align:center; margin: 20px 0;">
        <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}" alt="{{ config('app.name') }} Logo"
            style="width: 100%; max-width: 250px; margin-bottom: 20px;">
    </div>

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 30px; margin-top: 20px;">
        <tr>
            <td style="padding: 20px 0;">
                <h2 style="color: #333333; text-align: center;">Pedido Nº {{ $order->order_number }}</h2>
                <p style="color: #555555; font-size: 16px; text-align: center;">
                    Estamos felizes em informar que seu pagamento foi confirmado com sucesso!
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px 0; border-top: 1px solid #dddddd;">
                <h3 style="color: #333333;">Detalhes do Pedido</h3>
                <p style="color: #555555; font-size: 16px;">
                    <strong>Número do Pedido:</strong> {{ $order->order_number }}<br>
                    <strong>Data:</strong> {{ $order->created_at->format('d/m/Y') }}<br>
                    <strong>Status:</strong> Pagamento Confirmado<br>
                    <strong>Total:</strong> R${{ number_format($order->total, 2, ',', '.') }}
                </p>
            </td>
        </tr>

        <tr>
            <td style="padding: 20px 0;">
                <h3 style="color: #333333;">Próximos Passos</h3>
                <p style="color: #555555; font-size: 16px;">
                    Agora que o pagamento foi confirmado, estamos preparando o seu pedido para envio. Você receberá um
                    e-mail de atualização assim que o pedido for enviado.
                </p>
            </td>
        </tr>

        @if($storeInfo)
        <tr>
            <td style="padding: 20px; background-color: #f7f7f7; border-radius: 8px; text-align: center;">
                <h3 style="color: #333333;">Contatos</h3>
                <p style="color: #555555; font-size: 14px;">
                    <strong>Email:</strong> {{ $storeInfo->email }}<br>
                    <strong>Telefone:</strong> {{ $storeInfo->contact_number }}<br>
                </p>
            </td>
        </tr>
        @endif

        <tr>
            <td align="center" style="padding: 20px; background-color: #333; color: #ffffff; border-radius: 0 0 8px 8px;">
                <p style="margin: 0; font-size: 14px;">Obrigado por comprar na {{ $storeInfo->name ?? config('app.name') }}! Estamos à disposição para qualquer dúvida.</p>
            </td>
        </tr>
    </table>

</body>

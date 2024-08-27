<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 20px;">

    <div style="text-align:center; margin: 20px 0;">
        <img src="{{ url('images/logo/freshcart-logo.svg') }}" alt="{{ config('app.name') }} Logo"
            style="width: 100%; max-width: 250px; margin-bottom: 20px;">
    </div>

    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
        style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h2 style="color: #333333;">Atualização no Status do Pedido #{{ $order->order_number }}</h2>
                <p style="color: #777777; font-size: 14px;">O status do seu pedido foi alterado para
                    @if ($order->status == 'pending')
                    <strong>Pendente</strong>
                    @elseif($order->status == 'processing')
                    <strong>Processando</strong>
                    @elseif($order->status == 'completed')
                    <strong>Concluído</strong>
                    @elseif($order->status == 'cancelled')
                    <strong>Cancelado</strong>
                    @endif
                </p>
            </td>
        </tr>

        <!-- Explicação do Status -->
        <tr>
            <td style="padding: 20px;">
                <p style="color: #555555; font-size: 16px;">
                    @if ($order->status == 'pending')
                    Seu pedido está atualmente <strong>Pendente</strong>. Isso significa que estamos aguardando a
                    confirmação do pagamento ou a liberação do pedido para processamento.
                    @elseif($order->status == 'processing')
                    Seu pedido está <strong>Processando</strong>. Estamos preparando seu pedido para envio. Isso pode
                    incluir a separação dos produtos e a preparação para despacho.
                    @elseif($order->status == 'completed')
                    Seu pedido foi <strong>Concluído</strong>. Isso significa que seu pedido foi totalmente processado e
                    enviado. Agradecemos por sua compra!
                    @elseif($order->status == 'cancelled')
                    Infelizmente, seu pedido foi <strong>Cancelado</strong>. Isso pode ter ocorrido devido a uma
                    solicitação sua ou a problemas com o pagamento. Se tiver dúvidas, entre em contato conosco.
                    @endif
                </p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 20px 0;">
                <p style="color: #777777; font-size: 12px;">Obrigado por comprar na {{ config('app.name') }}! Qualquer
                    dúvida, entre em
                    contato conosco.</p>
            </td>
        </tr>
    </table>

</body>

@extends('front/layouts/store')
@section('title', 'Pagamento Realizado com sucesso!')
@section('content')

@section('head')

<script src="https://sdk.mercadopago.com/js/v2"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3em;
        border-color: #28a745 transparent transparent transparent;
    }

    .spinner-border-sm {
        width: 2rem;
        height: 2rem;
        border-width: 0.2em;
        border-color: #28a745 transparent transparent transparent;
    }

    .uppercase-input {
        text-transform: uppercase;
    }

    .thanks {
        font-size: 18px;
    }

    .card-rounded {
        border-top-right-radius: 16px;
        border-top-left-radius: 16px;
    }
</style>


@endsection

<!-- Overlay de Carregamento -->
<div id="loadingOverlay">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Carregando...</span>
    </div>
</div>

<main>
    <div class="container my-5">
        <div class="card shadow-sm card-rounded">

            <div id="statusScreenBrick_container"></div>

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <p>NÚMERO DO PEDIDO <br> <span class="fw-bold">#{{ $order->order_number }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>DATA <br> <span class="fw-bold">{{ $order->formatted_created_at }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>TOTAL <br> <span class="fw-bold">R${{ number_format($order->total_amount, 2, ',', '.')
                                }}</span></p>
                    </div>
                    <div class="col-md-3">
                        <p>MÉTODO DE PAGAMENTO <br> <span class="fw-bold">{{ $order->payment_type }}</span></p>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="">
                                <h4>Detalhes do Pedido</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Produto</td>
                            <td class="fw-bold">Total</td>
                        </tr>
                        @foreach ($order->products as $product)
                        <tr>
                            <td>{{ $product->title }} x {{ $product->pivot->quantity }}</td>
                            <td>R$ {{ number_format($product->pivot->price, 2, ',', '.') }}</td>
                            <!-- Use o preço da tabela pivô -->
                        </tr>
                        @endforeach
                        <tr>
                            <td class="fw-bold">Subtotal</td>
                            <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Entrega</td>
                            <td>R$ {{number_format($order->shipping->shipping_price, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Método de Pagamento</td>
                            <td>{{ $order->payment_type }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td>R$ {{ number_format($total + $order->shipping->shipping_price, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="">
                                <h4>Detalhes da Entrega</h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Endereço</td>
                            <td class="fw-bold">Forma de Envio</td>
                        </tr>
                        <tr>
                            <td>
                                <span>{{ $order->address->street }}, {{ $order->address->number }}</span><br>
                                <span>{{ $order->address->city }} - {{ $order->address->state }}</span><br>
                                <span>CEP: {{ $order->address->zip_code }}</span>
                            </td>
                            <td>
                                <span>{{ $order->shipping->shipping_company }} ({{ $order->shipping->shipping_type
                                    }})</span><br>
                                <span> Prazo Estimado: {{ $order->shipping->shipping_minimum_term }} a {{
                                    $order->shipping->shipping_deadline }} dias </span><br>
                                <p>Valor: R$ {{number_format($order->shipping->shipping_price, 2, ',', '.') }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@section('footer')

<script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
    const publicKey = @json($mercadoPagoPublicKey);

    const mp = new MercadoPago(publicKey, {
        locale: 'pt'
    });

    const paymentId = "{{ $order->payment->transaction_id }}";
    const returnUrl = "{{ route('home') }}"
    const errorUrl = "{{ route('checkout.payment') }}"

    const bricksBuilder = mp.bricks();
    const renderStatusScreenBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          paymentId: paymentId,
        },
        customization: {
            visual: {
            hideStatusDetails: true,
            hideTransactionDate: true,
            style: {
                theme: 'bootstrap',
                customVariables:{
                    baseColor: "#0ec10f",
                    successColor: "#0ec10f"
                }
            }
            },
            backUrls: {
                'error': errorUrl,
                'return': returnUrl
            }
        },
        callbacks: {
          onReady: () => {
            $('#loadingOverlay').hide();
          },
          onError: (error) => {
            // Callback called for all Brick error cases
          },
        },
      };
      window.statusScreenBrickController = await bricksBuilder.create('statusScreen', 'statusScreenBrick_container', settings);
    };
    renderStatusScreenBrick(bricksBuilder);
</script>


@endsection

@endsection

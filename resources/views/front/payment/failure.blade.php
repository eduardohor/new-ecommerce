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

    const paymentId = "{{ $transaction_id }}";
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

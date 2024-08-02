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
</style>


@endsection

<!-- Overlay de Carregamento -->
<div id="loadingOverlay">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Carregando...</span>
    </div>
</div>

<main>
    <div class="container m-5">
        <h1>Ok!</h1>
        <p>Pagamento Realizado com Sucesso!</p>

        <div id="statusScreenBrick_container"></div>

    </div>
</main>



@section('footer')

<script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
    const mp = new MercadoPago('TEST-b5d3927e-6d67-4190-886d-2db1cb1a7d2f', { // Add your public key credential
      locale: 'pt-BR'
    });
    const bricksBuilder = mp.bricks();
    const renderStatusScreenBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          paymentId: '1325616839', // Payment identifier, from which the status will be checked
        },
        customization: {
          visual: {
            style: {
              theme: 'bootstrap', // 'default' | 'dark' | 'bootstrap' | 'flat'
            }
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

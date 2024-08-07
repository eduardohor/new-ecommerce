@extends('front/layouts/store')
@section('title', 'Finalizar Compra - Forma de Pagamento')
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
    <!-- section-->
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store') }}">Loja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Finalizar Pedido</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div>
                        <div class="mb-8">
                            <!-- text -->
                            <h1 class="fw-bold mb-0">Finalizar Pedido</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <!-- Forma de pagamento -->
                        <div class="py-4">
                            <h5 class="text-inherit">
                                <i class="feather-icon icon-credit-card me-2 text-muted"></i>Forma de pagamento
                            </h5>

                            <div id="paymentBrick_container"></div>

                            {{-- <div class="mt-5">
                                <form id="form-checkout" class="mt-5">
                                    <!-- Cartão de Crédito / Débito -->
                                    <div class="card card-bordered shadow-none mb-2">
                                        <div class="card-body p-6">
                                            <div class="d-flex mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="creditdebitcard" value="credit_debit_card">
                                                    <h5 class="mb-1 h6"> Cartão de Crédito / Débito</h5>
                                                    <p class="mb-0 small">Transferência segura de dinheiro usando
                                                        sua conta bancária.</p>
                                                </div>
                                            </div>
                                            <!-- Detalhes do Cartão -->
                                            <div id="cardDetails" class="collapse">
                                                <div class="row g-2">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Número do Cartão</label>
                                                            <input type="text" id="form-checkout__cardNumber"
                                                                class="form-control card_number"
                                                                placeholder="Número do cartão" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-3 mb-lg-0">
                                                            <label class="form-label">Nome no Cartão</label>
                                                            <input type="text" id="form-checkout__cardholderName"
                                                                class="form-control uppercase-input"
                                                                placeholder="Nome impresso no cartão" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-3 mb-lg-0 position-relative">
                                                            <label class="form-label">Data de validade</label>
                                                            <input type="text" id="form-checkout__expirationDate"
                                                                class="form-control" placeholder="MM/YY" />
                                                            <div class="position-absolute bottom-0 end-0 p-3 lh-1">
                                                                <i class="bi bi-calendar text-muted"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-12">
                                                        <div class="mb-3 mb-lg-0">
                                                            <label class="form-label">CVV</label>
                                                            <input type="text" id="form-checkout__securityCode"
                                                                class="form-control"
                                                                placeholder="Código de segurança" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Banco Emissor</label>
                                                            <select id="form-checkout__issuer"
                                                                class="form-select"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Parcelas</label>
                                                            <select id="form-checkout__installments"
                                                                class="form-select"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tipo de Identificação</label>
                                                            <select id="form-checkout__identificationType"
                                                                class="form-select"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Número de
                                                                Identificação</label>
                                                            <input type="text" id="form-checkout__identificationNumber"
                                                                class="form-control" placeholder="123.456.789-00" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Email do Titular do
                                                                Cartão</label>
                                                            <input type="email" id="form-checkout__cardholderEmail"
                                                                class="form-control" placeholder="email@example.com" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pix -->
                                    <div class="card card-bordered shadow-none">
                                        <div class="card-body p-6">
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="pix" value="pix">
                                                    <h5 class="mb-1 h6"> Pix</h5>
                                                    <p class="mb-0 small">O QR Code para seu pagamento através de
                                                        PIX será gerado após a confirmação da compra. Aponte seu
                                                        celular para a tela para capturar o código ou copie e cole o
                                                        código em seu aplicativo de pagamentos.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botões -->
                                    <div class="mt-5 d-flex justify-content-end align-items-center">
                                        <a href="#" class="btn btn-outline-gray-400 text-muted">Anterior</a>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-12 col-md-12 offset-lg-1 col-lg-4">
                        <div class="mt-4 mt-lg-0">
                            <div class="card shadow-sm">
                                <h5 class="px-6 py-4 bg-transparent mb-0">Detalhes do Pedido</h5>
                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                <ul class="list-group list-group-flush">
                                    @foreach ($cart->cartProducts as $cartProduct)
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">
                                            <div class="col-2 col-md-2">
                                                <img src="{{ asset('storage/' . $cartProduct->product->productImages->first()->image_path) }}"
                                                    alt="Ecommerce" class="img-fluid">
                                            </div>
                                            <div class="col-5 col-md-5">
                                                <h6 class="mb-0">{{ $cartProduct->product->title }}</h6>
                                            </div>
                                            <div class="col-2 col-md-2 text-center text-muted">
                                                <span>{{ $cartProduct->quantity }}</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                @if ($cartProduct->product->sale_price > 0)
                                                <span class="fw-bold text-danger">R$ {{
                                                    number_format($cartProduct->product->sale_price, 2, ',', '.')
                                                    }}</span>
                                                <div class="text-decoration-line-through text-muted small">R$ {{
                                                    number_format($cartProduct->product->regular_price, 2, ',', '.')
                                                    }}</div>
                                                @else
                                                <span class="fw-bold">R$ {{
                                                    number_format($cartProduct->product->regular_price, 2, ',', '.')
                                                    }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                    <li class="list-group-item px-4 py-3">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>Subtotal do Item</div>
                                            <div class="fw-bold" id="subtotalItem">R$ {{
                                                number_format($cart->total_amount, 2, ',', '.') }}</div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div>Frete</div>
                                            <div class="fw-bold" id="shippingCost">R$ {{
                                                number_format($shipping['shipping_price'], 2, ',', '.') }}</div>
                                        </div>
                                        {{-- <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="text-dark">Desconto</div>
                                            <div class="fw-bold text-success" id="discountAmount">- R$ {{
                                                number_format($cart->discount_amount, 2, ',', '.') }}</div>
                                        </div> --}}
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="text-dark">Total</div>
                                            <div class="fw-bold" id="totalAmount">R$ {{
                                                number_format($cart->total_amount + $shipping['shipping_price'], 2,
                                                ',', '.') }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mt-5 justify-content-end">
                            <div id="error-message" style="color: red; display: none;" class="m-3 col-auto">
                                Por favor, selecione uma forma de pagamento.
                            </div>
                            <div class="col-auto">
                                <button type="submit" onclick="createPayment()" class="btn btn-primary w-100">Finalizar
                                    Pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</main>

@section('footer')
<!-- Javascript-->
<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>

<script src="{{ asset('js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Mercado Pago -->
<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    $(document).ready(function() {
        // Verifica se o cartão ou pix está selecionado
        $('input[name="payment_method"]').change(function() {
            if ($('#creditdebitcard').is(':checked')) {
                $('#cardDetails').collapse('show');
                $('#cardDetails input').each(function() {
                    $(this).prop('required', true);
                });
            } else {
                $('#cardDetails').collapse('hide');
                $('#cardDetails input').each(function() {
                    $(this).prop('required', false);
                });
            }
        });
    });

    //Inicar Pagamento com Mercado Pago

    const publicKey = @json($mercadoPagoPublicKey);

    const mp = new MercadoPago(publicKey, {
        locale: 'pt'
    });

    const bricksBuilder = mp.bricks();
    const renderPaymentBrick = async (bricksBuilder) => {
        const amount = "{{ $cart->total_amount + + $shipping['shipping_price']}}"
        const paymentProcessUrl = "{{ route('payment.process') }}";

        const settings = {
        initialization: {
            amount: amount,
            preferenceId: "<PREFERENCE_ID>",
        },
        customization: {
            visual: {
            hideFormTitle: true,
            hidePaymentButton: true,
            style: {
                theme: "bootstrap",
            },
            },
            paymentMethods: {
            creditCard: "all",
            bankTransfer: "all",
            maxInstallments: 5
            },
        },
        callbacks: {
        onReady: () => {
            $('#loadingOverlay').hide()
        },
        onError: (error) => {
            // callback chamado para todos os casos de erro do Brick
        },
    },
        };
        window.paymentBrickController = await bricksBuilder.create(
        "payment",
        "paymentBrick_container",
        settings
        );
    };

    renderPaymentBrick(bricksBuilder);

    function createPayment() {
        $('#loadingOverlay').show();

        const paymentProcessUrl = "{{ route('payment.process') }}";
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const errorMessageDiv = $('#error-message');
        const cartId = "{{ $cart->id }}";


        window.paymentBrickController.getFormData()
            .then(({ formData }) => {
                if (!formData.payment_method_id) {
                    errorMessageDiv.show();
                    return;
                }
                errorMessageDiv.hide();

                formData.cart_id = cartId;

                fetch(paymentProcessUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Erro na resposta:', text);
                            throw new Error('Erro na resposta');
                        });
                    }

                    return response.json();
                })
                .then(data => {
                    console.log("Dados da resposta:", data);

                    if (data.status != 'failed') {
                        createOrder(data);
                    }

                })
                .catch(error => {
                    $('#loadingOverlay').hide();
                    console.error('Erro ao fazer fetch:', error);
                });
            })
            .catch((error) => {
                errorMessageDiv.show();
                $('#loadingOverlay').hide();
            });
    };

    function createOrder(payment) {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const amount = "{{ $cart->total_amount + + $shipping['shipping_price']}}";
        const cartId = "{{ $cart->id }}";

        $.ajax({
            url: '{{ route('order.store') }}',
            type: 'POST',
            data: {
                _token: csrfToken,
                payment: payment,
                total_amount:amount,
                cart_id: cartId
            },
            success: function(response) {
                console.log('Pedido criado com sucesso:', response);
                const orderNumber = response.order.order_number;
                 window.location.href = '{{ route("order.detail", ":orderNumber") }}'.replace(':orderNumber', orderNumber);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao criar pedido:', error);
                $('#loadingOverlay').hide();
            }
        });
    }




</script>

@endsection

@endsection

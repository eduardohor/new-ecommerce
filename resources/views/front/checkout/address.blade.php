@extends('front/layouts/store')
@section('title', 'Finalizar Compra - Endereço')
@section('content')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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
<div id="loadingOverlay" style="display: none;">
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
                <form id="formPayment" action="{{ route('checkout.payment') }}" method="post">
                    @csrf
                    <!-- row -->
                    <div class="row">

                        <div class="col-lg-7 col-md-12">

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- heading one -->
                                <a href="#" class="fs-5 text-inherit collapsed h4" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="true"
                                    aria-controls="flush-collapseOne">
                                    <i class="feather-icon icon-map-pin me-2 text-muted"></i>Adicionar endereço
                                    de
                                    entrega
                                </a>
                                <!-- btn -->
                                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addAddressModal">Adicionar um novo endereço </a>
                                <!-- collapse -->
                            </div>

                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionFlushExample">
                                <div class="mt-5">
                                    <div class="row">
                                        @forelse ($addresses as $address)
                                        <div class="col-lg-6 col-12 mb-4">
                                            <!-- form -->
                                            <div class="card card-body p-6 ">
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="radio" name="address_id"
                                                        id="addressRadio{{ $address->id }}" value="{{ $address->id }}"
                                                        {{ $address->is_default ?
                                                    'checked' : '' }} onclick="updateShipping('{{
                                                    $address->zip_code
                                                    }}')">
                                                    <label class="form-check-label text-dark"
                                                        for="addressRadio{{ $address->id }}">
                                                        {{ $address->name }}
                                                    </label>
                                                </div>
                                                <!-- address -->
                                                <address> <strong>{{ $address->neighborhood }}</strong> <br>

                                                    {{ $address->number }} {{ $address->street }}, <br>

                                                    {{ $address->city }}, {{ $address->state }},<br>

                                                    <abbr title="Cep" class="cep">{{ $address->zip_code
                                                        }}</abbr>
                                                </address>
                                                @if ($address->is_default)
                                                <span class="text-danger">Endereço padrão</span>
                                                @endif
                                            </div>
                                        </div>
                                        @empty
                                        <!-- Mensagem para quando não houver endereços -->
                                        <div class="col-12">
                                            <div class="alert alert-info" role="alert">
                                                Nenhum endereço cadastrado.
                                            </div>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 offset-lg-1 col-lg-4">
                            <div class="mt-4 mt-lg-0">
                                <div class="card shadow-sm">
                                    <h5 class="px-6 py-4 bg-transparent mb-0">Detalhes do Pedido</h5>
                                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                    <ul class="list-group list-group-flush">
                                        <!-- list group item -->
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
                                                    <span class="fw-bold text-danger">R$
                                                        {{ number_format($cartProduct->product->sale_price, 2, ',', '.')
                                                        }}</span>
                                                    <div class="text-decoration-line-through text-muted small">R$
                                                        {{ number_format($cartProduct->product->regular_price, 2, ',',
                                                        '.')
                                                        }}
                                                    </div>
                                                    @else
                                                    <span class="fw-bold">R$
                                                        {{ number_format($cartProduct->product->regular_price, 2, ',',
                                                        '.')
                                                        }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                        </li>
                                        @endforeach

                                        <!-- list group item -->
                                        <li class="list-group-item px-4 py-3">
                                            <div class="d-flex align-items-center justify-content-between   mb-2">
                                                <div>
                                                    Subtotal do Item

                                                </div>
                                                <div class="fw-bold" id="subtotalItem">
                                                    R$ {{ number_format($cart->total_amount, 2, ',', '.') }}
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    Entrega
                                                    <i class="feather-icon icon-info text-muted"
                                                        data-bs-toggle="tooltip"
                                                        title="De acordo com o endereço selecionado"></i>

                                                </div>
                                                <div class="shipping col-md-8 d-flex flex-column align-items-end">
                                                    <div id="mensagemErro" style="display:none;"
                                                        class="alert alert-danger">
                                                        Não foi possível calcular o frete para o CEP informado. Por
                                                        favor,
                                                        tente novamente mais tarde.
                                                    </div>
                                                </div>

                                            </div>

                                        </li>
                                        <!-- list group item -->
                                        <li class="list-group-item px-4 py-3">
                                            <div class="d-flex align-items-center justify-content-between fw-bold">
                                                <div>
                                                    Subtotal
                                                </div>
                                                <div>
                                                    <span class="fw-bold" id="subtotal">R$ {{
                                                        number_format($cart->total_amount,
                                                        2, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mt-5 justify-content-end">
                                <div id="error-message" style="color: red; display: none;" class="m-3 col-auto">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary w-100">Ir Para Pagamento</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @include('front.partials.modal-add-address')
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

        // Encontrar o endereço padrão selecionado
        const defaultAddressInput = $('input[name="address_id"]:checked');

        if (defaultAddressInput.length > 0) {
            const zipCode = defaultAddressInput.closest('.card').find('address abbr').text().trim();

            updateShipping(zipCode);
        }

        var error = "{{ session('error') }}";
        var success = "{{ session('success') }}";

        // Configuração do Toastr
        toastr.options = {
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "6000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        if (error) {
            toastr.error(error);
        }

        if (success) {
            toastr.success(success);
        }
    });

    //Atualiza a Entrega de acordo com o endereco selecionado
    function updateShipping(zipCode) {
        $('#loadingOverlay').show();

        const cartId = "{{ $cart->id }}";

        const cleanedZipCode = zipCode.replace(/\D/g, '');

        $.ajax({
            url: "{{ route('calculate-shipping') }}",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify({
                cep: cleanedZipCode,
                cart_id: cartId
            }),
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function(response) {
                const { data } = response;

                const hasError = data.every(frete => frete.error !== undefined);

                if (hasError) {
                    $("#mensagemErro").show();
                } else {
                    const radioHtml = data
                        .filter(frete => !frete.error)
                        .map(frete => {
                            const company = frete.company.name;
                            const tipoFrete = frete.name;
                            const customPrice = frete.custom_price;
                            const prazoEstimadoMin = frete.delivery_range.min;
                            const prazoEstimadoMax = frete.delivery_range.max;
                            const shippingType = company + tipoFrete

                            return `
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='shipping_option' id='${tipoFrete}Radio'
                                        data-company='${company}' data-type='${tipoFrete}' data-price='${customPrice}' data-prazo-min='${prazoEstimadoMin}' data-prazo-max='${prazoEstimadoMax}'
                                        value='${customPrice}'>
                                    <label class='form-check-label' for='${tipoFrete}Radio'>
                                        ${company} (${tipoFrete}): <strong>R$ ${customPrice}</strong> <br> Prazo Estimado: ${prazoEstimadoMin} a ${prazoEstimadoMax} dias
                                    </label>
                                </div>
                            `;
                        })
                        .join('');

                    $('.shipping').html(radioHtml);
                }

                $('#loadingOverlay').hide();
            },
            error: function(xhr, status, error) {
                console.error('Erro:', error);

                $('#loadingOverlay').hide();
            },
            complete: function() {
                $('#subtotal').text("R$ {{ number_format($cart->total_amount, 2, ',', '.') }}");
            }
        });
    }

    // Função para verificar os campos necessario para pedido estao selecionados
    function validateSelection() {
        const addressSelected = $('input[name="address_id"]:checked').length > 0;
        const shippingOptionSelected = $('input[name="shipping_option"]:checked').length > 0;

        if (!addressSelected) {
            $('#error-message').text("Por favor, selecione um endereço.");
            $('#error-message').show();
            return false;
        }

        if (!shippingOptionSelected) {
            $('#error-message').text("Por favor, selecione uma forma de entrega.");
            $('#error-message').show();
            return false;
        }

        return true;
    }

    // Atualiza a forma de envio e o subtotal ao selecionar uma opção de frete
    $(document).on('change', 'input[name="shipping_option"]', function() {
        const selectedPrice = parseFloat($(this).val());
        const subtotalAmount = parseFloat($('#subtotalItem').text().replace('R$', '').replace('.', '').replace(',', '.'));
        const finalAmount = subtotalAmount + selectedPrice;
        $('#subtotal').text(`R$ ${finalAmount.toFixed(2).replace('.', ',')}`);
    });

    // Configura o evento de envio do formulário
    $('#formPayment').on('submit', function(event) {
        if (!validateSelection()) {
            event.preventDefault();
        } else {
            const selectedShippingOption = $('input[name="shipping_option"]:checked');

            if (selectedShippingOption.length) {
                const company = selectedShippingOption.data('company');
                const type = selectedShippingOption.data('type');
                const price = selectedShippingOption.data('price');
                const prazoMin = selectedShippingOption.data('prazo-min');
                const prazoMax = selectedShippingOption.data('prazo-max');

                const form = $(this);
                $('<input>').attr({
                    type: 'hidden',
                    name: 'shipping_company',
                    value: company
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'shipping_type',
                    value: type
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'shipping_price',
                    value: price
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'shipping_minimum_term',
                    value: prazoMin
                }).appendTo(form);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'shipping_deadline',
                    value: prazoMax
                }).appendTo(form);
            }
        }
    });

</script>

@endsection

@endsection

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
                                                    @if ($cartProduct->product->hasActiveSale())
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
                                            @if ($discount > 0)
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div>
                                                    Desconto
                                                    @if ($appliedCoupon)
                                                    <small class="text-muted d-block">Cupom {{ $appliedCoupon->code }}</small>
                                                    @endif
                                                </div>
                                                <div class="text-success fw-semibold">
                                                    - R$ {{ number_format($discount, 2, ',', '.') }}
                                                </div>
                                            </div>
                                            @endif
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
                                                    <span class="fw-bold" id="subtotal"
                                                        data-base-subtotal="{{ $finalSubtotal }}">R$
                                                        {{ number_format($finalSubtotal,
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

    function escapeHtml(text) {
        if (typeof text !== 'string') {
            return '';
        }

        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
        };

        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    function formatCurrency(value) {
        return Number(value || 0).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    function getBaseSubtotal() {
        const baseSubtotal = $('#subtotal').data('base-subtotal');
        const parsedSubtotal = parseFloat(baseSubtotal);
        return isNaN(parsedSubtotal) ? 0 : parsedSubtotal;
    }

    function updateSubtotalDisplay(shippingValue) {
        const subtotalBase = getBaseSubtotal();
        const totalWithShipping = subtotalBase + Number(shippingValue || 0);
        $('#subtotal').text(formatCurrency(totalWithShipping));
    }

    function resetSubtotalDisplay() {
        updateSubtotalDisplay(0);
    }

    //Atualiza a Entrega de acordo com o endereco selecionado
    function updateShipping(zipCode) {
        $('#loadingOverlay').show();
        resetSubtotalDisplay();

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
                const options = response.data || [];

                let hasAvailableOption = false;

                const radioHtml = options.map(function(option) {
                    const isPickup = option.is_pickup === true;
                    const isFreeShipping = option.is_free_shipping === true;
                    const originalPrice = option.original_price || 0;
                    const company = option.company && option.company.name ? option.company.name : (isPickup ? 'Retirada na loja' : 'Entrega');
                    const tipoFrete = option.name || (isPickup ? 'Retirada na loja' : 'Convencional');
                    const identifier = option.identifier || (company + '-' + tipoFrete).replace(/\s+/g, '-').toLowerCase();
                    const customPrice = parseFloat(option.custom_price !== undefined && option.custom_price !== null ? option.custom_price : 0) || 0;
                    const prazoEstimadoMin = option.delivery_range && option.delivery_range.min ? option.delivery_range.min : 0;
                    const prazoEstimadoMax = option.delivery_range && option.delivery_range.max ? option.delivery_range.max : 0;
                    const pickupAddress = option.pickup_address || '';
                    const pickupHours = option.pickup_hours || '';
                    const pickupInstructions = option.pickup_instructions || '';
                    const pickupAddressAttr = encodeURIComponent(pickupAddress);
                    const pickupHoursAttr = encodeURIComponent(pickupHours);
                    const pickupInstructionsAttr = encodeURIComponent(pickupInstructions);

                    const priceLabel = customPrice.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    });

                    const originalPriceLabel = originalPrice ? originalPrice.toLocaleString('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }) : '';

                    let labelBody = '';

                    if (isFreeShipping) {
                        // Frete grátis aplicado
                        labelBody = `
                            <div class="d-flex justify-content-between align-items-start w-100">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong class="me-2">${escapeHtml(tipoFrete)}</strong>
                                        <span class="badge bg-success">FRETE GRÁTIS</span>
                                    </div>
                                    <small class="text-muted">Prazo: ${prazoEstimadoMin}-${prazoEstimadoMax} dias úteis</small>
                                </div>
                                <div class="text-end ms-3">
                                    ${originalPriceLabel ? `<small class="text-muted text-decoration-line-through d-block mb-1">${originalPriceLabel}</small>` : ''}
                                    <strong class="text-success fs-5">Grátis</strong>
                                </div>
                            </div>
                        `;
                    } else if (isPickup) {
                        labelBody = `
                            <div class="d-flex justify-content-between align-items-start w-100">
                                <div class="flex-grow-1">
                                    <strong>Retirada na loja</strong>
                                    ${pickupAddress ? `<br><small class="text-muted">${escapeHtml(pickupAddress)}</small>` : ''}
                                    ${pickupHours ? `<br><small class="text-muted">${escapeHtml(pickupHours)}</small>` : ''}
                                </div>
                                <div class="text-end">
                                    <strong class="text-success fs-5">Grátis</strong>
                                </div>
                            </div>
                        `;
                    } else {
                        labelBody = `
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="flex-grow-1">
                                    <strong>${escapeHtml(tipoFrete)}</strong>
                                    <br>
                                    <small class="text-muted">Prazo: ${prazoEstimadoMin}-${prazoEstimadoMax} dias úteis</small>
                                </div>
                                <div class="text-end">
                                    <strong class="fs-5">${priceLabel}</strong>
                                </div>
                            </div>
                        `;
                    }

                    hasAvailableOption = true;

                    // Captura dados originais da transportadora se existirem (para frete grátis)
                    const originalCompany = option.original_company || company;
                    const originalType = option.original_type || tipoFrete;

                    return `
                        <div class="form-check border rounded p-3 mb-2 ${isPickup ? 'shipping-option-pickup' : ''}" style="cursor: pointer;">
                            <input class="form-check-input" type="radio" name="shipping_option" id="${escapeHtml(identifier)}"
                                value="${escapeHtml(identifier)}"
                                data-company="${escapeHtml(company)}"
                                data-type="${escapeHtml(tipoFrete)}"
                                data-original-company="${escapeHtml(originalCompany)}"
                                data-original-type="${escapeHtml(originalType)}"
                                data-price="${customPrice}"
                                data-prazo-min="${prazoEstimadoMin}"
                                data-prazo-max="${prazoEstimadoMax}"
                                data-pickup="${isPickup ? 1 : 0}"
                                data-pickup-address="${escapeHtml(pickupAddressAttr)}"
                                data-pickup-hours="${escapeHtml(pickupHoursAttr)}"
                                data-pickup-instructions="${escapeHtml(pickupInstructionsAttr)}"
                                style="margin-top: 0.5rem;">
                            <label class="form-check-label w-100" for="${escapeHtml(identifier)}" style="cursor: pointer;">
                                ${labelBody}
                            </label>
                        </div>
                    `;
                }).join('');

                if (!hasAvailableOption) {
                    $("#mensagemErro").show();
                    $('.shipping').html('');
                } else {
                    $("#mensagemErro").hide();
                    $('.shipping').html(radioHtml);

                    // Mensagem de incentivo para frete grátis
                    const amountToFreeShipping = options.find(opt => opt.amount_to_free_shipping !== undefined)?.amount_to_free_shipping;

                    if (amountToFreeShipping && amountToFreeShipping > 0) {
                        const amountLabel = amountToFreeShipping.toLocaleString('pt-BR', {
                            style: 'currency',
                            currency: 'BRL'
                        });

                        const incentiveMessage = `
                            <div class="alert alert-info mt-3 mb-0" role="alert">
                                <i class="ri-information-line me-2"></i>
                                <strong>Faltam ${amountLabel} para você ganhar frete grátis!</strong>
                            </div>
                        `;

                        $('.shipping').append(incentiveMessage);
                    }
                }

                $('#loadingOverlay').hide();
            },
            error: function(xhr, status, error) {
                console.error('Erro:', error);

                $('#loadingOverlay').hide();
            },
            complete: function() {
                resetSubtotalDisplay();
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
        const selectedPrice = parseFloat($(this).data('price')) || 0;
        updateSubtotalDisplay(selectedPrice);
        $('#error-message').hide();
    });

    // Configura o evento de envio do formulário
    $('#formPayment').on('submit', function(event) {
        if (!validateSelection()) {
            event.preventDefault();
        } else {
            const selectedShippingOption = $('input[name="shipping_option"]:checked');

            if (selectedShippingOption.length) {
                const form = $(this);
                // Usa dados originais se existirem (para frete grátis), senão usa os dados normais
                const originalCompany = selectedShippingOption.data('original-company') || '';
                const originalType = selectedShippingOption.data('original-type') || '';
                const company = originalCompany || selectedShippingOption.data('company') || '';
                const type = originalType || selectedShippingOption.data('type') || '';
                const price = parseFloat(selectedShippingOption.data('price')) || 0;
                const prazoMin = parseInt(selectedShippingOption.data('prazo-min')) || 0;
                const prazoMax = parseInt(selectedShippingOption.data('prazo-max')) || 0;
                const isPickup = Number(selectedShippingOption.data('pickup')) === 1;
                const pickupAddressAttr = selectedShippingOption.data('pickup-address') || '';
                const pickupHoursAttr = selectedShippingOption.data('pickup-hours') || '';
                const pickupInstructionsAttr = selectedShippingOption.data('pickup-instructions') || '';
                const pickupAddress = pickupAddressAttr ? decodeURIComponent(pickupAddressAttr) : '';
                const pickupHours = pickupHoursAttr ? decodeURIComponent(pickupHoursAttr) : '';
                const pickupInstructions = pickupInstructionsAttr ? decodeURIComponent(pickupInstructionsAttr) : '';

                form.find('input[name="shipping_company"], input[name="shipping_type"], input[name="shipping_price"], input[name="shipping_minimum_term"], input[name="shipping_deadline"], input[name="pickup_address"], input[name="pickup_hours"], input[name="pickup_instructions"], input[name="is_pickup"]').remove();

                $('<input>', {
                    type: 'hidden',
                    name: 'shipping_company',
                    value: company
                }).appendTo(form);

                $('<input>', {
                    type: 'hidden',
                    name: 'shipping_type',
                    value: type
                }).appendTo(form);

                $('<input>', {
                    type: 'hidden',
                    name: 'shipping_price',
                    value: price.toFixed(2)
                }).appendTo(form);

                $('<input>', {
                    type: 'hidden',
                    name: 'shipping_minimum_term',
                    value: prazoMin
                }).appendTo(form);

                $('<input>', {
                    type: 'hidden',
                    name: 'shipping_deadline',
                    value: prazoMax
                }).appendTo(form);

                $('<input>', {
                    type: 'hidden',
                    name: 'is_pickup',
                    value: isPickup ? 1 : 0
                }).appendTo(form);

                if (isPickup) {
                    $('<input>', {
                        type: 'hidden',
                        name: 'pickup_address',
                        value: pickupAddress
                    }).appendTo(form);

                    $('<input>', {
                        type: 'hidden',
                        name: 'pickup_hours',
                        value: pickupHours
                    }).appendTo(form);

                    $('<input>', {
                        type: 'hidden',
                        name: 'pickup_instructions',
                        value: pickupInstructions
                    }).appendTo(form);
                }
            }
        }
    });

</script>

@endsection

@endsection

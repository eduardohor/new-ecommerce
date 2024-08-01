@extends('front/layouts/store')
@section('title', 'Finalizar Compra')
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
                <!-- row -->
                <div class="row">
                    <form action="" method="post">
                        @csrf
                        <div class="col-lg-7 col-md-12">
                            <!-- accordion -->
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <!-- accordion item -->
                                <div class="accordion-item py-4">

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
                                                            <input class="form-check-input" type="radio"
                                                                name="selectedAddress"
                                                                id="addressRadio{{ $address->id }}"
                                                                value="{{ $address->id }}" {{ $address->is_default ?
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

                                <!-- accordion item -->
                                <div class="accordion-item py-4">

                                    <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                        aria-controls="flush-collapseFour">
                                        <i class="feather-icon icon-credit-card me-2 text-muted"></i>Forma de pagamento
                                        <!-- collapse -->
                                    </a>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse "
                                        data-bs-parent="#accordionFlushExample">

                                        <div class="mt-5">
                                            <div>
                                                <!-- card -->
                                                <div class="card card-bordered shadow-none mb-2">
                                                    <!-- card body -->
                                                    <div class="card-body p-6">
                                                        <div class="d-flex mb-4">
                                                            <div class="form-check ">
                                                                <!-- input -->
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="creditdebitcard">
                                                                <label class="form-check-label ms-2"
                                                                    for="creditdebitcard">

                                                                </label>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-1 h6"> Cartão de Crédito / Débito</h5>
                                                                <p class="mb-0 small">Transferência segura de dinheiro
                                                                    usando sua conta bancária. Apoiamos Mastercard
                                                                    tercard,
                                                                    Visa, Discover e Stripe.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col-12">
                                                                <!-- input -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Número do Cartão</label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="1234 4567 6789 4321">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <!-- input -->
                                                                <div class="mb-3 mb-lg-0">
                                                                    <label class="form-label">Nome no Cartão </label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter your first name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-12">
                                                                <!-- input -->
                                                                <div class="mb-3  mb-lg-0 position-relative">
                                                                    <label class="form-label">Data de validade </label>
                                                                    <input class="form-control flatpickr " type="text"
                                                                        placeholder="Select Date">
                                                                    <div
                                                                        class="position-absolute bottom-0 end-0 p-3 lh-1">
                                                                        <i class="bi bi-calendar text-muted"></i>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-12">
                                                                <!-- input -->
                                                                <div class="mb-3  mb-lg-0">
                                                                    <label class="form-label">CVV</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="***">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                                <div class="card card-bordered shadow-none">
                                                    <div class="card-body p-6">
                                                        <!-- check input -->
                                                        <div class="d-flex">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="cashonDelivery">
                                                                <label class="form-check-label ms-2"
                                                                    for="cashonDelivery">

                                                                </label>
                                                            </div>
                                                            <div>
                                                                <!-- title -->
                                                                <h5 class="mb-1 h6"> Pagamento via Pix</h5>
                                                                <p class="mb-0 small">Gere um QRCode e pague com pix.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Button -->
                                                <div class="mt-5 d-flex justify-content-end">
                                                    <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                        aria-expanded="false"
                                                        aria-controls="flush-collapseThree">Anterior</a>
                                                    <a href="#" class="btn btn-primary ms-2">Faça o Pedido</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-md-12 offset-lg-1 col-lg-4">
                            <div class="mt-4 mt-lg-0">
                                <div class="card shadow-sm">
                                    <h5 class="px-6 py-4 bg-transparent mb-0">Detalhes do Pedido</h5>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>
</main>

<!-- Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body p-6">
                <div class="d-flex justify-content-between mb-5">
                    <!-- heading -->
                    <div>
                        <h5 class="h6 mb-1" id="addAddressModalLabel">Novo endereço de entrega</h5>
                        <p class="small mb-0">Adicione um novo endereço de entrega para a entrega do seu pedido.</p>
                    </div>
                    <div>
                        <!-- button -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <!-- row -->
                <form action="{{ route('address.store') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Nome do Endereço" name="name"
                                aria-label="Name" required>
                        </div>
                        <!-- CEP -->
                        <div class="col-12">
                            <input type="text" class="form-control cep" placeholder="CEP" name="zip_code" id="cep"
                                required>
                        </div>
                        <!-- Estado -->
                        <div class="col-12">
                            <select class="form-control" name="state" id="state" required>
                                <option value="" disabled selected>Selecione o Estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                        <!-- Cidade -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Cidade" name="city" id="city" required>
                        </div>
                        <!-- Bairro -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Bairro" name="neighborhood"
                                id="neighborhood" required>
                        </div>
                        <!-- Rua -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Rua" name="street" id="street"
                                required>
                        </div>
                        <!-- Numero -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Número" name="number" id="number"
                                required>
                        </div>
                        <!-- Complemento -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Complemento" aria-label="Complemento"
                                name="complement" id="complement">
                        </div>
                        <!-- Definir como padrão -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Definir como padrão
                                </label>
                            </div>
                        </div>
                        <!-- Botões -->
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar Endereço</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


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

<script>
    $(document).ready(function() {
        // Encontrar o endereço padrão selecionado
        const defaultAddressInput = $('input[name="selectedAddress"]:checked');

        if (defaultAddressInput.length > 0) {
            const zipCode = defaultAddressInput.closest('.card').find('address abbr').text().trim();

            updateShipping(zipCode);
        }

        $('#cep').blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if (validacep.test(cep)) {
                    fetch("https://viacep.com.br/ws/" + cep + "/json/")
                        .then(response => response.json())
                        .then(dados => {
                            if (!dados.erro) {
                                $('#state').val(dados.uf);
                                $('#neighborhood').val(dados.bairro);
                                $('#complement').val(dados.complemento);
                                $('#city').val(dados.localidade);
                                $('#street').val(dados.logradouro);
                            } else {
                                alert("CEP não encontrado.");
                                $('#cep').val('')
                            }
                        })
                        .catch(error => {
                            alert("Erro ao buscar o CEP. Tente novamente mais tarde.");
                            console.error("Erro:", error);
                        });
                } else {
                    alert("Formato de CEP inválido.");
                }
            }
        });

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

                            return `
                                <div class='form-check'>
                                    <input class='form-check-input' type='radio' name='freteRadio' id='${tipoFrete}Radio' value='${customPrice}'>
                                    <label class='form-check-label' for='${tipoFrete}Radio'>
                                        ${company} (${tipoFrete}): <strong>R$ ${customPrice}</strong> <br> Prazo Estimado: ${prazoEstimadoMin} a ${prazoEstimadoMax} dias
                                    </label>
                                </div>
                            `;
                        })
                        .join('');

                    $('.shipping').html(radioHtml);

                    $('input[name="freteRadio"]').change(function() {
                        const selectedPrice = parseFloat($(this).val());
                        const subtotalAmount = parseFloat($('#subtotalItem').text().replace('R$', '').replace('.', '').replace(',', '.'));
                        const finalAmount = subtotalAmount + selectedPrice;
                        $('#subtotal').text(`R$ ${finalAmount.toFixed(2).replace('.', ',')}`);
                    });
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

</script>

@endsection

@endsection

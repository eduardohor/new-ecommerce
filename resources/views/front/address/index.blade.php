@extends('front/layouts/account')
@section('title', 'Endereços')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .address-default {
        pointer-events: none;
        cursor: default;
    }
</style>
@endsection

@section('content')
<div class="col-lg-9 col-md-8 col-12">
    <div class="py-6 p-md-6 p-lg-10">
        <div class="d-flex justify-content-between mb-6">
            <!-- heading -->
            <h2 class="mb-0">Endereços</h2>
            <!-- button -->
            <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#addAddressModal">Adicionar um novo endereço</a>
        </div>
        @include('front.partials.modal-add-address')
        <div class="row">
            <!-- col -->
            @forelse ($addresses as $address)
            <div class="col-lg-5 col-xxl-4 col-12 mb-4">
                <!-- form -->
                <div class="card d-flex flex-column h-100">
                    <div class="card-body d-flex flex-column flex-grow-1">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" {{ $address->is_default ? 'checked' : '' }}>
                            <label class="form-check-label text-dark fw-semi-bold" for="homeRadio">
                                {{ $address->name }}
                            </label>
                        </div>
                        <!-- address -->
                        <p class="mb-6">{{ $address->city }}, {{ $address->zip_code }}<br>
                            {{ $address->neighborhood }}, {{ $address->street }}<br>
                            Nº {{ $address->number }}, {{ $address->complement }}<br>
                            {{ $address->state }}</p>
                        <!-- btn -->
                        @if ($address->is_default)
                        <a class="btn btn-info btn-sm address-default mb-3">Endereço padrão</a>
                        @else
                        <form action="{{ route('address.setDefault', $address->id) }}" method="POST"
                            onsubmit="return confirm('Você tem certeza que deseja definir este endereço como padrão?');">
                            @csrf
                            <button type="submit" class="btn link-primary p-0">Definir como Padrão</button>
                        </form>
                        @endif
                        <!-- Links no final do cartão -->
                        <div class="mt-auto">
                            <a href="#" class="text-inherit" data-bs-toggle="modal"
                                data-bs-target="#updateAddressModal{{ $address->id }}">Editar</a>
                            <a href="#" class="text-danger ms-3" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $address->id }}">Excluir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('front.partials.modal-update-address', ['address' => $address])
            @include('front.partials.modal-delete-address', ['address' => $address])

            @empty
            <p>Nenhum endereço cadastrado</p>
            @endforelse

        </div>
    </div>
</div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
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
</script>

@endsection

@extends('front/layouts/account')
@section('title', 'Endereços')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="col-lg-9 col-md-8 col-12">
    <div class="py-6 p-md-6 p-lg-10">
        <div class="d-flex justify-content-between mb-6">
            <!-- heading -->
            <h2 class="mb-0">Endereço</h2>
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
                <div class="card">
                    <div class="card-body p-6">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" {{
                                $address->is_default ? 'checked' : ''}}>
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
                        <a href="#" class="btn btn-info btn-sm">Endereço padrão</a>
                        @else
                        <a href="#" class="link-primary">Definir como padrão</a>
                        @endif
                        <div class="mt-4">
                            <a href="#" class="text-inherit">Editar </a>
                            <a href="#" class="text-danger ms-3" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">Excluir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p>Nenhum endereço cadastrado</p>
            @endforelse

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- modal content -->
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Excluir endereço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- modal body -->
            <div class="modal-body">
                <h6>Tem certeza de que deseja excluir este endereço?</h6>
                <p class="mb-6">Jitu Chauhan<br>

                    4450 North Avenue Oakland, <br>

                    Nebraska, United States,<br>

                    402-776-1106</p>
            </div>
            <!-- modal footer -->
            <div class="modal-footer">
                <!-- btn -->
                <button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Excluir</button>
            </div>
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

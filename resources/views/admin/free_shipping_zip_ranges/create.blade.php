@extends('admin.layouts.dashboard')
@section('title', 'Nova Faixa de CEP')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Nova Faixa de CEP</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.free-shipping-zip-ranges.index') }}" class="text-inherit">Faixas de CEP</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Nova Faixa</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('admin.free-shipping-zip-ranges.index') }}" class="btn btn-light">
                            <i class="ri-arrow-left-line"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.free-shipping-zip-ranges.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-12">
                                    <h5 class="mb-3">Informações da Faixa</h5>
                                </div>

                                <div class="col-md-6">
                                    <label for="zip_start" class="form-label">
                                        CEP Inicial
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control cep" id="zip_start" name="zip_start"
                                        placeholder="00000-000" value="{{ old('zip_start') }}" required
                                        maxlength="9" />
                                    <small class="text-muted">Digite o CEP inicial da faixa</small>
                                    @error('zip_start')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="zip_end" class="form-label">
                                        CEP Final
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control cep" id="zip_end" name="zip_end"
                                        placeholder="99999-999" value="{{ old('zip_end') }}" required
                                        maxlength="9" />
                                    <small class="text-muted">Digite o CEP final da faixa</small>
                                    @error('zip_end')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="active"
                                            name="active" value="1" {{ old('active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="active">
                                            Faixa Ativa
                                        </label>
                                    </div>
                                    <small class="text-muted">Faixas inativas não serão aplicadas no cálculo de frete</small>
                                </div>

                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="ri-information-line"></i>
                                        <strong>Dica:</strong> Para abranger toda uma cidade ou região, use faixas amplas. Exemplo:
                                        <ul class="mb-0 mt-2">
                                            <li>CEP Inicial: 96000-000</li>
                                            <li>CEP Final: 96099-999</li>
                                        </ul>
                                        Isso cobrirá todos os CEPs de 96000-000 até 96099-999.
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line"></i> Cadastrar Faixa
                                    </button>
                                    <a href="{{ route('admin.free-shipping-zip-ranges.index') }}" class="btn btn-secondary">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Instruções</h5>
                        <ul class="mb-0">
                            <li>Informe o CEP inicial e final da faixa que terá frete grátis</li>
                            <li>Os CEPs serão salvos sem formatação (somente números)</li>
                            <li>O CEP inicial deve ser menor ou igual ao CEP final</li>
                            <li>Evite sobrepor faixas ativas</li>
                            <li>Você pode desativar uma faixa sem precisar excluí-la</li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Exemplos de Faixas:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <strong>Cidade inteira:</strong><br>
                                <small class="text-muted">96000-000 até 96099-999</small>
                            </li>
                            <li class="mb-2">
                                <strong>Bairro específico:</strong><br>
                                <small class="text-muted">96020-000 até 96029-999</small>
                            </li>
                            <li class="mb-2">
                                <strong>CEP único:</strong><br>
                                <small class="text-muted">96020-360 até 96020-360</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        let error = "{{ session('error') }}";
        let warning = "{{ session('warning') }}";
        let success = "{{ session('success') }}";

        if (error) {
            toastr.error(error);
        }

        if (warning) {
            toastr.warning(warning);
        }

        if (success) {
            toastr.success(success);
        }
    });
</script>
@endsection

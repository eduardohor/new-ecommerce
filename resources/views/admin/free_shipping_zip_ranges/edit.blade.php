@extends('admin.layouts.dashboard')
@section('title', 'Editar Faixa de CEP')

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
                        <h2>Editar Faixa de CEP</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.free-shipping-zip-ranges.index') }}" class="text-inherit">Faixas de CEP</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <form action="{{ route('admin.free-shipping-zip-ranges.update', $range->id) }}" method="POST">
                            @csrf
                            @method('PUT')

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
                                        placeholder="00000-000" value="{{ old('zip_start', $range->formatted_zip_start) }}" required
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
                                        placeholder="99999-999" value="{{ old('zip_end', $range->formatted_zip_end) }}" required
                                        maxlength="9" />
                                    <small class="text-muted">Digite o CEP final da faixa</small>
                                    @error('zip_end')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="active"
                                            name="active" value="1" {{ old('active', $range->active) ? 'checked' : '' }}>
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
                                        <i class="ri-save-line"></i> Salvar Alterações
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
                        <h5 class="card-title">Detalhes</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <strong>Criado em:</strong><br>
                                <small class="text-muted">{{ $range->created_at->format('d/m/Y H:i') }}</small>
                            </li>
                            <li class="mb-2">
                                <strong>Atualizado em:</strong><br>
                                <small class="text-muted">{{ $range->updated_at->format('d/m/Y H:i') }}</small>
                            </li>
                            <li>
                                <strong>Status Atual:</strong><br>
                                @if($range->active)
                                    <span class="badge bg-success">Ativa</span>
                                @else
                                    <span class="badge bg-secondary">Inativa</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
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

                <div class="card mt-3 border-danger">
                    <div class="card-body">
                        <h6 class="card-title text-danger">Zona de Perigo</h6>
                        <p class="text-muted mb-3">Ações irreversíveis</p>
                        <button type="button" class="btn btn-danger btn-sm w-100" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <i class="ri-delete-bin-line"></i> Excluir Faixa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir a faixa de CEP <strong>{{ $range->formatted_zip_start }} - {{ $range->formatted_zip_end }}</strong>?</p>
                <p class="text-danger mb-0"><small>Esta ação não pode ser desfeita.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('admin.free-shipping-zip-ranges.destroy', $range->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

        // Remove a máscara dos CEPs antes de enviar o formulário
        $('form').on('submit', function(e) {
            const zipStartInput = $('#zip_start');
            const zipEndInput = $('#zip_end');

            // Remove todos os caracteres não numéricos
            zipStartInput.val(zipStartInput.val().replace(/\D/g, ''));
            zipEndInput.val(zipEndInput.val().replace(/\D/g, ''));
        });
    });
</script>
@endsection

@extends('admin.layouts.dashboard')
@section('title', 'Faixas de CEP para Frete Grátis')

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
                        <h2>Faixas de CEP para Frete Grátis</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('store.info.show') }}" class="text-inherit">Configurações da Loja</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Faixas de CEP</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('admin.free-shipping-zip-ranges.create') }}" class="btn btn-primary">
                            <i class="ri-add-line"></i> Nova Faixa de CEP
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        @if($ranges->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-centered text-nowrap mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>CEP Inicial</th>
                                        <th>CEP Final</th>
                                        <th>Status</th>
                                        <th>Criado em</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ranges as $range)
                                    <tr>
                                        <td>
                                            <span class="fw-medium">{{ $range->formatted_zip_start }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $range->formatted_zip_end }}</span>
                                        </td>
                                        <td>
                                            @if($range->active)
                                                <span class="badge bg-success">Ativa</span>
                                            @else
                                                <span class="badge bg-secondary">Inativa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $range->created_at->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light btn-icon" type="button"
                                                    id="dropdownMenuButton{{ $range->id }}" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton{{ $range->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.free-shipping-zip-ranges.edit', $range->id) }}">
                                                            <i class="bi bi-pencil-square me-2"></i> Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('admin.free-shipping-zip-ranges.toggle', $range->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">
                                                                @if($range->active)
                                                                    <i class="bi bi-eye-slash me-2"></i> Desativar
                                                                @else
                                                                    <i class="bi bi-eye me-2"></i> Ativar
                                                                @endif
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $range->id }}">
                                                            <i class="bi bi-trash me-2"></i> Excluir
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal de Confirmação de Exclusão -->
                                    <div class="modal fade" id="deleteModal{{ $range->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $range->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $range->id }}">Confirmar Exclusão</h5>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginação -->
                        @if($ranges->hasPages())
                        <div class="card-footer border-top">
                            <nav>
                                {{ $ranges->links() }}
                            </nav>
                        </div>
                        @endif
                        @else
                        <div class="text-center py-8">
                            <i class="ri-inbox-line" style="font-size: 48px; color: #ddd;"></i>
                            <h5 class="mt-3">Nenhuma faixa de CEP cadastrada</h5>
                            <p class="text-muted">Cadastre faixas de CEP para oferecer frete grátis em regiões específicas.</p>
                            <a href="{{ route('admin.free-shipping-zip-ranges.create') }}" class="btn btn-primary mt-3">
                                <i class="ri-add-line"></i> Cadastrar Primeira Faixa
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Card de Informações -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Como funcionam as faixas de CEP?</h5>
                        <ul class="mb-0">
                            <li>Defina faixas de CEP (inicial e final) que terão frete grátis</li>
                            <li>Exemplo: CEP inicial 96000-000, CEP final 96099-999 (toda a cidade)</li>
                            <li>Faixas inativas não serão aplicadas no cálculo de frete</li>
                            <li>Evite sobrepor faixas ativas para melhor organização</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
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

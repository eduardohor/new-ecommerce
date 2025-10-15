@extends('admin.layouts.dashboard')
@section('title', 'Banners')
@section('content')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Banners</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Banners</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('banners.create') }}" class="btn btn-primary">Novo Banner</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card h-100 card-lg">
            <div class="px-6 py-6">
                <form class="row g-3 align-items-end" method="GET" action="{{ route('banners.index') }}">
                    <div class="col-md-4">
                        <label class="form-label">Posição</label>
                        <select name="position" class="form-select">
                            <option value="">Todas</option>
                            @foreach($positions as $key => $config)
                                <option value="{{ $key }}" {{ request('position') === $key ? 'selected' : '' }}>
                                    {{ $config['label'] ?? $key }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Todos</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativos</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativos</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                        <a href="{{ route('banners.index') }}" class="btn btn-outline-secondary ms-2">Limpar</a>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Preview</th>
                                <th>Posição</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Ordem</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr>
                                    <td>
                                        @if($banner->image_url)
                                            <img src="{{ $banner->image_url }}" alt="Banner" class="icon-shape icon-md">
                                        @else
                                            <span class="badge bg-light text-muted">Sem imagem</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ data_get($positions, "{$banner->position}.label", $banner->position) }}
                                        </span>
                                    </td>
                                    <td style="max-width: 220px;">
                                        @if($banner->link_url)
                                            <a href="{{ $banner->link_url }}" target="_blank" rel="noopener" class="text-decoration-none text-truncate d-inline-block" style="max-width: 210px;">
                                                {{ $banner->link_url }}
                                            </a>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $banner->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $banner->is_active ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>
                                        <div class="dropdown">
                                            @include('admin.partials.delete_modal')
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('banners.edit', $banner->id) }}">
                                                        <i class="bi bi-pencil-square me-3"></i>Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#confirm-deletion"
                                                        onclick="showDeleteModal('Banner #{{ $banner->id }}', '{{ route('banners.destroy', $banner->id) }}')">
                                                        <i class="bi bi-trash me-3"></i>Excluir
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Nenhum banner encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                <span class="mb-2 mb-md-0">
                    Mostrando {{ $banners->firstItem() }} a {{ $banners->lastItem() }} de {{ $banners->total() }} resultados
                </span>
                <nav class="mt-2 mt-md-0">
                    {{ $banners->links() }}
                </nav>
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
    document.addEventListener('DOMContentLoaded', function () {
        const error = "{{ session('error') }}";
        const status = "{{ session('status') }}";

        if (error) {
            toastr.error(error);
        }

        if (status) {
            const messages = {
                'banner-created': 'Banner criado com sucesso!',
                'banner-updated': 'Banner atualizado com sucesso!',
                'banner-deleted': 'Banner excluído com sucesso!',
            };
            toastr.success(messages[status] || 'Operação realizada com sucesso.');
        }
    });
</script>
@endsection

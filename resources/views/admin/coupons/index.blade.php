@extends('admin.layouts.dashboard')
@section('title', 'Cupons')
@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Cupons de Desconto</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cupons</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary">Cadastrar Cupom</a>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card h-100 card-lg">
                    <div class="px-6 py-6">
                        <div class="row justify-content-between g-3">
                            <div class="col-lg-4 col-md-6 col-12">
                                <form class="d-flex" role="search" method="get" action="{{ route('coupons.index') }}">
                                    <input class="form-control" type="search" placeholder="Pesquisar cupom"
                                        name="search" value="{{ request('search') }}">
                                    @if (request()->filled('status'))
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                    @endif
                                    <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                                </form>
                            </div>
                            <div class="col-lg-2 col-md-4 col-12 ms-auto">
                                <form method="get" action="{{ route('coupons.index') }}" id="couponStatusForm">
                                    @if (request()->filled('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    <select class="form-select" name="status" onchange="document.getElementById('couponStatusForm').submit()">
                                        <option value="" {{ request('status') === null ? 'selected' : '' }}>Todos</option>
                                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Ativos</option>
                                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inativos</option>
                                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expirados</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Código</th>
                                        <th>Tipo</th>
                                        <th>Valor</th>
                                        <th>Usos</th>
                                        <th>Período</th>
                                        <th>Status</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $coupon)
                                    <tr>
                                        <td class="fw-semibold">{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type === 'fixed' ? 'Valor' : 'Percentual' }}</td>
                                        <td>
                                            @if ($coupon->type === 'fixed')
                                                R$ {{ number_format($coupon->value, 2, ',', '.') }}
                                            @else
                                                {{ number_format($coupon->value, 2, ',', '.') }}%
                                            @endif
                                        </td>
                                        <td>
                                            @if (is_null($coupon->max_uses))
                                                {{ $coupon->used_count }} / &infin;
                                            @else
                                                {{ $coupon->used_count }} / {{ $coupon->max_uses }}
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $start = $coupon->starts_at ? $coupon->starts_at->format('d/m/Y H:i') : '—';
                                                $end = $coupon->ends_at ? $coupon->ends_at->format('d/m/Y H:i') : '—';
                                            @endphp
                                            <small class="d-block">Início: {{ $start }}</small>
                                            <small class="d-block">Fim: {{ $end }}</small>
                                        </td>
                                        <td>
                                            @if ($coupon->isCurrentlyValid())
                                                <span class="badge bg-light-success text-success">Válido</span>
                                            @elseif(!$coupon->is_active)
                                                <span class="badge bg-light-secondary text-muted">Inativo</span>
                                            @else
                                                <span class="badge bg-light-danger text-danger">Expirado</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown">
                                                @include('admin.partials.delete_modal')

                                                <a class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" href="#" role="button"
                                                    id="couponActions{{ $coupon->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="couponActions{{ $coupon->id }}">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('coupons.edit', $coupon) }}">
                                                            <i class="bi bi-pencil-square me-3"></i>Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirm-deletion"
                                                            onclick="showDeleteModal('{{ $coupon->code }}', '{{ route('coupons.destroy', $coupon) }}')">
                                                            <i class="bi bi-trash me-3"></i>Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">Nenhum cupom cadastrado.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                            <span class="mb-2 mb-md-0">
                                @if ($coupons->count())
                                    Mostrando {{ $coupons->firstItem() }} a {{ $coupons->lastItem() }} de {{ $coupons->total() }} resultados
                                @else
                                    Nenhum resultado encontrado
                                @endif
                            </span>
                            <nav class="mt-2 mt-md-0">
                                {{ $coupons->appends([
                                    'search' => request('search'),
                                    'status' => request('status'),
                                ])->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

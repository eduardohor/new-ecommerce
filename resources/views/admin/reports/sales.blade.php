@extends('admin.layouts.dashboard')
@section('title', 'Relatório de Vendas')

@section('content')
<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Relatório de Vendas</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Relatórios</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.reports.sales.export.excel', array_filter($filters ?? [])) }}" class="btn btn-outline-success">
                            <i class="bi bi-file-earmark-excel"></i> Exportar Excel
                        </a>
                        <a href="{{ route('admin.reports.sales.export.pdf', array_filter($filters ?? [])) }}" class="btn btn-outline-danger">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form class="row gy-3 align-items-end" method="GET" action="{{ route('admin.reports.sales.index') }}">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Data inicial</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ $filters['start_date'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Data final</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ $filters['end_date'] ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select">
                            @foreach($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-search"></i> Filtrar
                        </button>
                        <a href="{{ route('admin.reports.sales.index') }}" class="btn btn-light">
                            Limpar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Receita Total</p>
                        <h4 class="mb-0">R$ {{ number_format($summary['total_revenue'], 2, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Pedidos</p>
                        <h4 class="mb-0">{{ $summary['total_orders'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Descontos</p>
                        <h4 class="mb-0">R$ {{ number_format($summary['total_discount'], 2, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <p class="text-muted mb-1">Ticket Médio</p>
                        <h4 class="mb-0">R$ {{ number_format($summary['average_ticket'], 2, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                @if($orders->count())
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-end">Desconto</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="fw-semibold">#{{ $order->order_number }}</td>
                                        <td>{{ $order->user?->name ?? 'Cliente convidado' }}</td>
                                        <td>
                                            @php
                                                $statusLabels = [
                                                    'pending' => 'warning',
                                                    'processing' => 'info',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger',
                                                ];
                                                $status = $order->status ?? 'pending';
                                                $badge = $statusLabels[$status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $badge }}">{{ $statusOptions[$status] ?? ucfirst($status) }}</span>
                                        </td>
                                        <td class="text-end">R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                        <td class="text-end">R$ {{ number_format($order->total_discount ?? 0, 2, ',', '.') }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-top">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-6">
                        <h5 class="mb-1">Nenhum pedido encontrado</h5>
                        <p class="text-muted mb-0">Ajuste os filtros para visualizar resultados.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

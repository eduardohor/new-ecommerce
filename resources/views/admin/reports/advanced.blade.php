@extends('admin.layouts.dashboard')
@section('title', 'Relatórios avançados')

@section('content')
<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Relatórios avançados</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Relatórios</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link {{ $activeTab === 'top-selling' ? 'active' : '' }}"
                    href="{{ route('admin.reports.advanced.index', ['tab' => 'top-selling'] + array_filter($filters ?? [])) }}">
                    Produtos mais vendidos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeTab === 'low-stock' ? 'active' : '' }}"
                    href="{{ route('admin.reports.advanced.index', ['tab' => 'low-stock', 'threshold' => $threshold]) }}">
                    Falta de estoque
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeTab === 'top-customers' ? 'active' : '' }}"
                    href="{{ route('admin.reports.advanced.index', ['tab' => 'top-customers'] + array_filter($filters ?? [])) }}">
                    Clientes que mais compraram
                </a>
            </li>
        </ul>

        @if($activeTab === 'top-selling')
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row gy-3 align-items-end" method="GET" action="{{ route('admin.reports.advanced.index') }}">
                        <input type="hidden" name="tab" value="top-selling">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Data inicial</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                value="{{ $filters['start_date'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Data final</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                value="{{ $filters['end_date'] ?? '' }}">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-search"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.reports.advanced.index', ['tab' => 'top-selling']) }}" class="btn btn-light">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    @if($products->count())
                        <div class="table-responsive">
                            <table class="table table-hover table-centered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Produto</th>
                                        <th>SKU</th>
                                        <th>Categoria</th>
                                        <th class="text-end">Quantidade</th>
                                        <th class="text-end">Receita</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="fw-semibold">
                                                <a class="text-reset" href="{{ route('products.edit', $product->id) }}">
                                                    {{ $product->title }}
                                                </a>
                                            </td>
                                            <td>{{ $product->sku ?? '-' }}</td>
                                            <td>{{ $product->category?->name ?? '-' }}</td>
                                            <td class="text-end">{{ number_format($product->total_quantity ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end">R$ {{ number_format($product->total_revenue ?? 0, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                            <span class="mb-2 mb-md-0">Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }}
                                de {{ $products->total() }} resultados</span>
                            <nav class="mt-2 mt-md-0">
                                {{ $products->appends([
                                    'tab' => 'top-selling',
                                    'start_date' => $filters['start_date'] ?? null,
                                    'end_date' => $filters['end_date'] ?? null,
                                ])->links() }}
                            </nav>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <h5 class="mb-1">Nenhum produto encontrado</h5>
                            <p class="text-muted mb-0">Ajuste os filtros para visualizar resultados.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if($activeTab === 'low-stock')
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row gy-3 align-items-end" method="GET" action="{{ route('admin.reports.advanced.index') }}">
                        <input type="hidden" name="tab" value="low-stock">
                        <div class="col-md-3">
                            <label for="threshold" class="form-label">Estoque baixo (até)</label>
                            <input type="number" min="0" id="threshold" name="threshold" class="form-control"
                                value="{{ $threshold }}">
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-search"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.reports.advanced.index', ['tab' => 'low-stock']) }}" class="btn btn-light">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    @if($lowStockProducts->count())
                        <div class="table-responsive">
                            <table class="table table-hover table-centered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Produto</th>
                                        <th>SKU</th>
                                        <th class="text-end">Quantidade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockProducts as $product)
                                        @php
                                            $isOut = !$product->in_stock || $product->quantity <= 0;
                                        @endphp
                                        <tr>
                                            <td class="fw-semibold">
                                                <a class="text-reset" href="{{ route('products.edit', $product->id) }}">
                                                    {{ $product->title }}
                                                </a>
                                            </td>
                                            <td>{{ $product->sku ?? '-' }}</td>
                                            <td class="text-end">{{ number_format($product->quantity ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                @if($isOut)
                                                    <span class="badge bg-danger">Fora de estoque</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Estoque baixo</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                            <span class="mb-2 mb-md-0">Mostrando {{ $lowStockProducts->firstItem() }} a {{ $lowStockProducts->lastItem() }}
                                de {{ $lowStockProducts->total() }} resultados</span>
                            <nav class="mt-2 mt-md-0">
                                {{ $lowStockProducts->appends([
                                    'tab' => 'low-stock',
                                    'threshold' => $threshold,
                                ])->links() }}
                            </nav>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <h5 class="mb-1">Nenhum produto encontrado</h5>
                            <p class="text-muted mb-0">Ajuste o limite de estoque para visualizar resultados.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if($activeTab === 'top-customers')
            <div class="card mb-4">
                <div class="card-body">
                    <form class="row gy-3 align-items-end" method="GET" action="{{ route('admin.reports.advanced.index') }}">
                        <input type="hidden" name="tab" value="top-customers">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Data inicial</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                value="{{ $filters['start_date'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">Data final</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                value="{{ $filters['end_date'] ?? '' }}">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bi bi-search"></i> Filtrar
                            </button>
                            <a href="{{ route('admin.reports.advanced.index', ['tab' => 'top-customers']) }}" class="btn btn-light">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    @if($customers->count())
                        <div class="table-responsive">
                            <table class="table table-hover table-centered mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Email</th>
                                        <th class="text-end">Pedidos</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td class="fw-semibold">
                                                <a class="text-reset" href="{{ route('customers.edit', $customer->id) }}">
                                                    {{ $customer->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-reset" href="{{ route('customers.edit', $customer->id) }}">
                                                    {{ $customer->email }}
                                                </a>
                                            </td>
                                            <td class="text-end">{{ number_format($customer->total_orders ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end">R$ {{ number_format($customer->total_spent ?? 0, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                            <span class="mb-2 mb-md-0">Mostrando {{ $customers->firstItem() }} a {{ $customers->lastItem() }}
                                de {{ $customers->total() }} resultados</span>
                            <nav class="mt-2 mt-md-0">
                                {{ $customers->appends([
                                    'tab' => 'top-customers',
                                    'start_date' => $filters['start_date'] ?? null,
                                    'end_date' => $filters['end_date'] ?? null,
                                ])->links() }}
                            </nav>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <h5 class="mb-1">Nenhum cliente encontrado</h5>
                            <p class="text-muted mb-0">Ajuste os filtros para visualizar resultados.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</main>
@endsection

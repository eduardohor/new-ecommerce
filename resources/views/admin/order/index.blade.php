@extends('admin.layouts.dashboard')
@section('title', 'Pedidos')
@section('content')

@php
use Carbon\Carbon;

Carbon::setLocale('pt_BR');
@endphp

<main class="main-content-wrapper">
    <div class="container">
        <!-- row -->
        <div class="row mb-8">
            <div class="col-md-12">
                <!-- page header -->
                <div>
                    <h2>Lista de Pedidos</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Painel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista de Pedidos</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <!-- card -->
                <div class="card h-100 card-lg">

                    <div class="px-6 py-6 ">
                        <div class="row justify-content-between">
                            <!-- form -->
                            <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                                <form class="d-flex" role="search" method="get" action="{{ route('orders.index') }}">
                                    <input class="form-control" type="search" placeholder="Pesquisar Pedidos"
                                        name="search">
                                    <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                                </form>
                            </div>
                            <!-- select option -->
                            <div class="col-lg-2 col-md-4 col-12">
                                <form method="get" action="{{ route('orders.index') }}">
                                    <select class="form-select" name="status" id="status-select">
                                        <option selected>Status</option>
                                        <option value="pending">Pendente</option>
                                        <option value="processing">Processando</option>
                                        <option value="completed">Concluído</option>
                                        <option value="cancelled">Cancelado</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- card body -->
                    <div class="card-body p-0">
                        <!-- table responsive -->
                        <div class="table-responsive">
                            <table
                                class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                                <thead class="bg-light">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                                <label class="form-check-label" for="checkAll">

                                                </label>
                                            </div>
                                        </th>
                                        <th>Imagem</th>
                                        <th>Número do Pedido</th>
                                        <th>Cliente</th>
                                        <th>Data</th>
                                        <th>Pagamento</th>
                                        <th>Status</th>
                                        <th>Entrega</th>
                                        <th>Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>

                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="orderOne">
                                                <label class="form-check-label" for="orderOne">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#!">
                                                <img src="{{ asset('storage/' . $order->products->first()->productImages->first()->image_path) }}"
                                                    alt="" class="icon-shape icon-md">
                                            </a>
                                        </td>
                                        <td><a href="{{ route('orders.show', $order->order_number) }}" class="text-reset">{{
                                                $order->order_number }}</a></td>
                                        <td>{{ $order->user->name }}</td>

                                        <td>{{ $order->created_at->translatedFormat('d M Y') }}</td>
                                        @if ($order->payment->payment_type == 'credit_card')
                                        <td>Cartão de Crédito</td>
                                        @elseif ($order->payment->payment_type == 'bank_transfer')
                                        <td>Pix</td>
                                        @else
                                        <td>Outro Método de Pagamento</td>
                                        @endif

                                        <td>
                                            @if ($order->status == 'pending')
                                            <span class="badge bg-light-warning text-dark-warning">Pendente</span>
                                            @elseif($order->status == 'processing')
                                            <span class="badge bg-light-info text-dark-info">Processando</span>
                                            @elseif($order->status == 'completed')
                                            <span class="badge bg-light-primary text-dark-primary">Concluído</span>
                                            @elseif($order->status == 'cancelled')
                                            <span class="badge bg-light-danger text-dark-danger">Cancelado</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->shipping && $order->shipping->shipping_option === 'pickup')
                                                <span class="badge bg-success-subtle text-success">Retirada</span>
                                            @else
                                                <span class="badge bg-secondary-subtle text-secondary">Entrega</span>
                                            @endif
                                        </td>
                                        <td>R$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="feather-icon icon-more-vertical fs-5"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('orders.show', $order->order_number) }}"><i
                                                                class="bi bi-eye-fill me-3"></i>Visualizar</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="bi bi-trash me-3"></i>Excluir</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="bi bi-pencil-square me-3 "></i>Editar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Nenhum Pedido Encontrado.</td>
                                    </tr>

                                    @endforelse

                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                        <span class="mb-2 mb-md-0">Mostrando {{ $orders->firstItem() }} a {{ $orders->lastItem() }}
                            de {{
                            $orders->total() }} resultados</span>
                        <nav class="mt-2 mt-md-0">
                            {{ $orders->appends([
                            'search' => request()->get('search', ''),
                            'status' => request()->get('status', '')
                            ])->links() }}
                        </nav>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#status-select').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>

@endsection

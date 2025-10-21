@extends('front/layouts/account')
@section('title', 'Pedidos')

@section('content')

@php
use Carbon\Carbon;

Carbon::setLocale('pt_BR');
@endphp

<div class="col-lg-9 col-md-8 col-12">
    <div class="py-6 p-md-6 p-lg-10">
        <!-- heading -->
        <h2 class="mb-6">Detalhe do Pedido</h2>

        <!-- row -->
        <div class="row ">
            <div class="col-xl-12 col-12 mb-5">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <div class="card-body p-6">
                        <div class="d-md-flex justify-content-between">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <h2 class="mb-0">ID do Pedido: #{{ $order->order_number }}</h2>

                                @if ($order->status == 'pending')
                                <span class="badge bg-light-warning text-dark-warning ms-2">Pendente</span>
                                @elseif($order->status == 'processing')
                                <span class="badge bg-light-info text-dark-info ms-2">Processando</span>
                                @elseif($order->status == 'completed')
                                <span class="badge bg-light-primary text-dark-primary ms-2">Concluído</span>
                                @elseif($order->status == 'cancelled')
                                <span class="badge bg-light-danger text-dark-danger ms-2">Cancelado</span>
                                @endif
                            </div>
                            <!-- select option -->
                            <div class="d-md-flex">
                                <!-- button -->
                                <div class="ms-md-3">
                                    <a href="{{ route('orders.download.invoice', $order->order_number) }}"
                                        class="btn btn-secondary">Baixar o Invoice</a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <div class="row">
                                <!-- address -->
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-6">
                                        <h6>Detalhes do Cliente</h6>
                                        <p class="mb-1 lh-lg">{{ $order->user->name }}<br>
                                            {{ $order->user->email }}<br>
                                            {{ $order->user->phone }}</p>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-6">
                                        <h6>Endereço de Envio</h6>
                                        <p class="mb-1 lh-lg">{{ $order->address->street }}, {{ $order->address->number
                                            }}<br>
                                            {{ $order->address->city }} - {{ $order->address->state }}<br>
                                            {{ $order->address->zip_code }} <br>
                                    </div>
                                </div>
                                <!-- address -->
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="mb-6">
                                        <h6>Detalhes do Pedido</h6>
                                        <p class="mb-1 lh-lg">ID do Pedido: <span class="text-dark">{{
                                                $order->order_number }}</span><br>
                                            Data do Pedido: <span class="text-dark">{{
                                                $order->created_at->translatedFormat('d M Y') }}</span><br>
                                            Total do Pedido: <span class="text-dark">R${{
                                                number_format($order->total_amount, 2, ',', '.') }}</span></p>
                                    </div>
                                </div>
                            </div>
                            @if ($order->shipping)
                            <div class="row">
                                <div class="col-12">
                                    <div class="border rounded-3 p-4 bg-light">
                                        @if ($order->shipping->shipping_option === 'pickup')
                                            <h6 class="mb-2">Retirada na Loja</h6>
                                            <p class="mb-0 small text-muted">
                                                <span class="d-block text-success fw-semibold">Sem custo de frete</span>
                                                @if ($order->shipping->pickup_address)
                                                    <span class="d-block">Endereço: {{ $order->shipping->pickup_address }}</span>
                                                @endif
                                                @if ($order->shipping->pickup_hours)
                                                    <span class="d-block">Horário para retirada: {{ $order->shipping->pickup_hours }}</span>
                                                @endif
                                                @if ($order->shipping->pickup_instructions)
                                                    <span class="d-block">{{ $order->shipping->pickup_instructions }}</span>
                                                @endif
                                            </p>
                                        @else
                                            <h6 class="mb-2">Detalhes do Envio</h6>
                                            <p class="mb-0 small text-muted">
                                                <span class="d-block">Transportadora: {{ $order->shipping->shipping_company }}</span>
                                                <span class="d-block">Serviço: {{ $order->shipping->shipping_type }}</span>
                                                <span class="d-block">Prazo estimado: {{ $order->shipping->shipping_minimum_term }} a {{ $order->shipping->shipping_deadline }} dias</span>
                                                <span class="d-block">Valor do frete: R${{ number_format($order->shipping->shipping_price, 2, ',', '.') }}</span>
                                                @if ($order->shipping->tracking_number)
                                                    <span class="d-block">Código de rastreio: {{ $order->shipping->tracking_number }}</span>
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-centered">
                                    <!-- Table Head -->
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Produtos</th>
                                            <th>Preço</th>
                                            <th>Quantidade</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <!-- tbody -->
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        @endphp

                                        @foreach ($order->products as $product)

                                        @php
                                        $productTotal = $product->pivot->price * $product->pivot->quantity;
                                        $subtotal += $productTotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ route('product.show', $product->slug) }}"
                                                    class="text-inherit" target="_blank">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <img src="{{ asset('storage/' .  $product->productImages->first()->image_path) }}"
                                                                alt="" class="icon-shape icon-lg">
                                                        </div>
                                                        <div class="ms-lg-4 mt-2 mt-lg-0">
                                                            <h5 class="mb-0 h6">
                                                                {{ $product->title }}
                                                            </h5>

                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td><span class="text-body">R${{ number_format($product->pivot->price, 2,
                                                    ',', '.') }}</span></td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>R${{ number_format($product->pivot->price * $product->pivot->quantity,
                                                2, ',', '.') }}</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td class="border-bottom-0 pb-0"></td>
                                            <td class="border-bottom-0 pb-0"></td>
                                            <td colspan="1" class="fw-medium text-dark ">
                                                <!-- text -->
                                                Subtotal :
                                            </td>
                                            <td class="fw-medium text-dark ">
                                                <!-- text -->
                                                R${{ number_format($subtotal, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom-0 pb-0"></td>
                                            <td class="border-bottom-0 pb-0"></td>
                                            <td colspan="1" class="fw-medium text-dark ">
                                                <!-- text -->
                                                Frete
                                            </td>
                                            <td class="fw-medium text-dark  ">
                                                <!-- text -->
                                                R${{ number_format($order->shipping->shipping_price, 2, ',', '.') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="1" class="fw-semi-bold text-dark ">
                                                <!-- text -->
                                                Total Geral
                                            </td>
                                            <td class="fw-semi-bold text-dark ">
                                                <!-- text -->
                                                R${{ number_format($order->total_amount, 2, ',', '.') }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-6">
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-lg-0">
                                <h6>Informação do Pagamento</h6>
                                @if ($order->payment->payment_type == 'credit_card')
                                <span>Cartão de Crédito</span>
                                @elseif ($order->payment->payment_type == 'bank_transfer')
                                <span>Pix</span>
                                @else
                                <span>Outro Método de Pagamento</span>
                                @endif
                                <h6 class="mt-3">ID da transação</h6>
                                <span>{{ $order->payment->transaction_id }}</span>
                            </div>
                            <div class="col-md-6">
                                <h5>Anotações</h5>
                                <p>{{ $order->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection

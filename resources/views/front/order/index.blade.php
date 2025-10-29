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
        <h2 class="mb-6">Seus Pedidos</h2>

        <div class="table-responsive-xxl border-0">
            <!-- Table -->
            <table class="table mb-0 text-nowrap table-centered ">
                <!-- Table Head -->
                <thead class="bg-light">
                    <tr>
                        <th>&nbsp;</th>
                        <th>Produto</th>
                        <th>Pedido</th>
                        <th>Data</th>
                        <th>Pagamento</th>
                        <th>Status</th>
                        <th>Entrega</th>
                        <th>Valor</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table body -->
                    @forelse ($orders as $order)
                    <tr>
                        <td class="align-middle border-top-0 w-0">
                            <img src="{{ asset('storage/' . $order->products->first()->productImages->first()->image_path) }}"
                                alt="Ecommerce" class="icon-shape icon-xl">

                        </td>
                        <td class="align-middle border-top-0">
                            <h6 class="mb-0">{{ $order->products->first()->title }}</h6>
                        </td>
                        <td class="align-middle border-top-0">
                            <a href="#" class="text-inherit">#{{ $order->order_number }}</a>

                        </td>
                        <td class="align-middle border-top-0">
                            {{ $order->created_at->translatedFormat('d M Y') }}

                        </td>
                        @if ($order->payment->payment_type == 'credit_card')
                        <td class="align-middle border-top-0">Cartão de Crédito</td>
                        @elseif ($order->payment->payment_type == 'bank_transfer')
                        <td class="align-middle border-top-0">Pix</td>
                        @else
                        <td class="align-middle border-top-0">Outro Método de Pagamento</td>
                        @endif
                        <td class="align-middle border-top-0">
                            @if ($order->status == 'pending')
                            <span class="badge bg-warning">Pendente</span>
                            @elseif($order->status == 'processing')
                            <span class="badge bg-info">Processando</span>
                            @elseif($order->status == 'completed')
                            <span class="badge bg-primary">Concluído</span>
                            @elseif($order->status == 'cancelled')
                            <span class="badge bg-danger">Cancelado</span>
                            @endif
                        </td>
                        <td class="align-middle border-top-0">
                            @if ($order->shipping && $order->shipping->shipping_option === 'pickup')
                                <span class="badge bg-success-subtle text-success">Retirada na loja</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Entrega</span>
                            @endif
                        </td>
                        <td class="align-middle border-top-0">
                            R${{ number_format($order->total_amount, 2, ',', '.') }}
                            @if ($order->coupon_discount > 0)
                                <span class="d-block small text-success">
                                    @if ($order->coupon_code)
                                        Cupom {{ $order->coupon_code }} aplicado
                                    @else
                                        Desconto aplicado
                                    @endif
                                     (- R$ {{ number_format($order->coupon_discount, 2, ',', '.') }})
                                </span>
                            @endif
                        </td>
                        <td class="text-muted align-middle border-top-0">
                            <a href="{{ route('orders.show.customer', $order->order_number) }}" class="text-inherit"
                                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Visualizar"><i
                                    class="feather-icon icon-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhum pedido realizado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

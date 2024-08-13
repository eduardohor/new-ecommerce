@extends('admin.layouts.dashboard')
@section('title', 'Pedido Detalhado')
@section('content')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@php
use Carbon\Carbon;

Carbon::setLocale('pt_BR');
@endphp


<main class="main-content-wrapper">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <!-- page header -->
                        <h2>Pedido Detalhado</h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}" class="text-inherit">Pedidos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pedido Detalhado</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Voltar para todos os pedidos</a>
                    </div>

                </div>
            </div>
        </div>
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
                                <div class="mb-2 mb-md-0">
                                    <form id="formUpdateStatus" action="{{ route('orders.update.status') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <select class="form-select" name="status" id="status-select">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : ''
                                                }}>Pendente</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' :
                                                ''
                                                }}>Processando</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : ''
                                                }}>Concluído</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : ''
                                                }}>Cancelado</option>
                                        </select>
                                    </form>
                                </div>
                                <!-- button -->
                                <div class="ms-md-3">
                                    <button type="submit" form="formUpdateStatus"
                                        class="btn btn-primary">Salvar</button>
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
                                        <a href="#">Ver Perfil</a>
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
                                <form action="{{ route('orders.update.notes') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <textarea class="form-control mb-3" rows="3"
                                        placeholder="Escrever anotações sobre o pedido"
                                        name="notes">{{ $order->notes }}</textarea>
                                    <button type="submit" class="btn btn-primary">Salvar Anotações</button>
                                </form>
                            </div>
                        </div>
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
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>


@endsection

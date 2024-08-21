@extends('admin.layouts.dashboard')
@section('title', 'Painel')
@section('content')

@php
use Carbon\Carbon;

Carbon::setLocale('pt_BR');
@endphp

<!-- main wrapper -->
<main class="main-content-wrapper">
    <section class="container">
        <!-- row -->
        <div class="row mb-8">
            <div class="col-md-12">
                <!-- card -->
                <div class="card bg-light border-0 rounded-4"
                    style="background-image: url({{ asset('images/slider/slider-image-1.jpg') }}); background-repeat: no-repeat; background-size: cover; background-position: right;">
                    <div class="card-body p-lg-12">
                        <h1>Bem vindo de volta! {{ auth()->user()->name }}
                        </h1>
                        <p>Um e-commerce com design simples e limpo.</p>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            Criar Produto
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- table -->

        <div class="row">
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Ganhos</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                                <i class="bi bi-currency-dollar fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2">R${{ number_format($statistics['total_earnings_year'], 2,
                                ',', '.')}}</h1>
                            <span>Receita anual</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Pedidos</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
                                <i class="bi bi-cart fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2">{{ $statistics['total_orders'] }}</h1>
                            <span>
                                <span class="text-dark me-1">{{ $statistics['total_orders_today'] }}</span>
                                @if ($statistics['total_orders_today'] == 1)
                                Nova Venda
                                @else
                                Novas Vendas
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div>
                                <h4 class="mb-0 fs-5">Clientes</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-info text-dark-info rounded-circle">
                                <i class="bi bi-people fs-5"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div class="lh-1">
                            <h1 class=" mb-2 fw-bold fs-2">{{ $statistics['total_customers'] }}</h1>
                            <span>
                                <span class="text-dark me-1">{{ $statistics['total_customers_last_two_days'] }}</span>
                                @if ($statistics['total_customers_last_two_days'] == 1)
                                Novo em 2 dias
                                @else
                                Novos em 2 dias
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row -->
        <div class="row ">
            <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <div class="card-body p-6">
                        <!-- heading -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="mb-1 fs-5">Receita Anual </h3>
                            </div>
                            <div>
                                <!-- select option -->
                                <select id="yearSelect">
                                    @forelse ($years as $year)
                                    <option value="{{ $year }}" {{ $year==$selectedYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                        </div>
                        <!-- chart -->
                        <div id="revenueChart" class="mt-6"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <!-- heading -->
                        <h3 class="mb-0 fs-5">Vendas Totais </h3>
                        <div id="totalSale" class="mt-6 d-flex justify-content-center"></div>
                        <div class="mt-4">
                            <!-- list -->
                            <ul id="sales-list" class="list-unstyled mb-0">
                                @php
                                $colors = [
                                'Pedidos Pendentes' => 'text-warning',
                                'Pedidos Processando' => 'text-info',
                                'Pedidos Completos' => 'text-success',
                                'Pedidos Cancelados' => 'text-danger'
                                ];
                                @endphp

                                @foreach ($orderValues as $status => $value)
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                                        class="bi bi-circle-fill {{ $colors[$status] }}" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg>
                                    <span class="ms-1">
                                        <span class="text-dark">{{ $status }} R${{ number_format($value, 2, ',', '.')
                                            }}</span>
                                    </span>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
        {{-- <div class="row ">
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-6">
                <!-- card -->
                <div class="card h-100 card-lg">
                    <!-- card body -->
                    <div class="card-body p-6">
                        <h3 class="mb-0 fs-5">Visão Geral de Vendas </h3>
                        <div class="mt-6">
                            <!-- text -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Lucro Total</h5>
                                    <span><span class="me-1 text-dark">R$1.619</span> (8.6%)</span>
                                </div>
                                <!-- main wrapper -->
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-light-primary" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            aria-label="Example 1px high" style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <!-- text -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Renda Total</h5>
                                    <span><span class="me-1 text-dark">R$3.571</span> (86.4%)</span>
                                </div>
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-info-soft" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            aria-label="Example 1px high" style="width: 88%;" aria-valuenow="88"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- text -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="fs-6">Despesas Total</h5>
                                    <span><span class="me-1 text-dark">R$3.430</span> (74.5%)</span>
                                </div>
                                <div>
                                    <!-- progressbar -->
                                    <div class="progress bg-light-danger" style="height: 6px;">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            aria-label="Example 1px high" style="width: 45%;" aria-valuenow="45"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-6">
                <div class=" position-relative h-100">
                    <!-- card -->
                    <div class="card card-lg mb-6">
                        <!-- card body -->
                        <div class="card-body px-6 py-8">
                            <div class="d-flex align-items-center">
                                <div>
                                    <!-- svg -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                        class="bi bi-bell text-warning" viewBox="0 0 16 16">
                                        <path
                                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                    </svg>
                                </div>
                                <!-- text -->
                                <div class="ms-4">
                                    <h5 class="mb-1">Comece o seu dia com novas Notificações.</h5>
                                    <p class="mb-0">Você tem <a class="link-info" href="#!">2 novas notificações</a></p>
                                </div>

                            </div>



                        </div>
                    </div>
                    <!-- card -->
                    <div class="card card-lg">
                        <!-- card body -->
                        <div class="card-body px-6 py-8">
                            <div class="d-flex align-items-center">
                                <!-- svg -->
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                        class="bi bi-lightbulb text-success" viewBox="0 0 16 16">
                                        <path
                                            d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z" />
                                    </svg>
                                </div>
                                <!-- text -->
                                <div class="ms-4">
                                    <h5 class="mb-1">Monitore suas vendas e lucratividade</h5>
                                    <p class="mb-0"> <a class="link-info" href="#!">Ver Desempenho</a></p>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- row -->
        <div class="row ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                <div class="card h-100 card-lg">
                    <!-- heading -->
                    <div class="p-6">
                        <h3 class="mb-0 fs-5">Pedidos Recentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table table-centered table-borderless text-nowrap table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Número do Pedido</th>
                                        <th scope="col">Nome do Cliente</th>
                                        <th scope="col">Data do Pedido</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order->order_number) }}">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->created_at->translatedFormat('d M Y') }}</td>
                                        <td>R${{ number_format($order->total_amount, 2, ',', '.') }}</td>
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
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection


@section('scripts')

<script>

</script>


<script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/vendors/chart.js') }}"></script>

<script>
    window.revenues = @json($revenues);
    window.orderQuantities = @json($orderQuantities);

    $(document).ready(function() {

        $('#yearSelect').on('change', function() {
            const selectedYear = $(this).val();

            $.ajax({
                url: "{{ route('dashboard.revenues') }}",
                type: 'GET',
                data: { year: selectedYear },
                dataType: 'json',
                success: function(data) {
                    updateChart(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });

        function updateChart(newData) {
            if (window.revenueChart) {
                var revenueArray = Object.values(newData.revenues).map(value => Number(value));

                window.revenueChart.updateSeries([{
                    name: "Renda Total",
                    data: revenueArray
                }]);
            } else {
                console.error('Gráfico de receita não encontrado');
            }


            if (window.totalSaleChart) {
                var saleValues = [
                    newData.orderValues['Pedidos Pendentes'],
                    newData.orderValues['Pedidos Processando'],
                    newData.orderValues['Pedidos Completos'],
                    newData.orderValues['Pedidos Cancelados']
                ];

                var saleQuantities = [
                    newData.orderQuantities['Pedidos Pendentes'],
                    newData.orderQuantities['Pedidos Processando'],
                    newData.orderQuantities['Pedidos Completos'],
                    newData.orderQuantities['Pedidos Cancelados']
                ];

                window.totalSaleChart.updateSeries(saleQuantities);
            } else {
                console.error('Gráfico de vendas totais não encontrado');
            }

            updateSalesList(newData)

        }

        function updateSalesList(newData) {
            $('#sales-list').empty();

            // Define as cores dos indicadores
            const colors = ['text-warning', 'text-info', 'text-success', 'text-danger'];

            console.log(newData.orderValues)

            $.each(newData.orderValues, function(key, value) {
                // Cria o item da lista
                const listItem = `
                    <li class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                            fill="currentColor" class="bi bi-circle-fill ${colors[Object.keys(newData.orderValues).indexOf(key) % colors.length]}" viewBox="0 0 16 16">
                            <circle cx="8" cy="8" r="8" />
                        </svg>
                        <span class="ms-1">
                            <span class="text-dark">${key} R$${value}</span>
                        </span>
                    </li>
                `;

                // Adiciona o item à lista
                $('#sales-list').append(listItem);
            });
        }


    });
</script>

@endsection

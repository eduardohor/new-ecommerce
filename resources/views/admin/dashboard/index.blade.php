@extends('admin.layouts.dashboard')
@section('title', 'Painel')
@section('content')
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
                            <span>Receita mensal</span>
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
                                    @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year==$selectedYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                    @endforeach
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
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                        fill="currentColor" class="bi bi-circle-fill text-primary" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg> <span class="ms-1"><span class="text-dark">Remessas
                                            R$32,98</span> (2%)</span></li>
                                <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                        fill="currentColor" class="bi bi-circle-fill text-warning" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg> <span class="ms-1"><span class="text-dark">Reembolsos R$11.00</span>
                                        (11%)</span></li>
                                <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                        fill="currentColor" class="bi bi-circle-fill text-danger" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg> <span class="ms-1"><span class="text-dark">Pedidos R$14,87</span>
                                        (1%)</span></li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor"
                                        class="bi bi-circle-fill text-info" viewBox="0 0 16 16">
                                        <circle cx="8" cy="8" r="8" />
                                    </svg> <span class="ms-1"><span class="text-dark">Renda R$3.271</span>
                                        (86%)</span></li>
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
                                        <th scope="col">Nome do Produo</th>
                                        <th scope="col">Data do Pedido</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>#FC0005</td>
                                        <td>Haldiram's Sev Bhujia</td>
                                        <td>28 de Março 2023</td>
                                        <td>R$18.00</td>
                                        <td>
                                            <span class="badge bg-light-primary text-dark-primary">Enviado</span>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>#FC0004</td>
                                        <td>NutriChoice Digestive</td>
                                        <td>24 de Março 2023</td>
                                        <td>R$24.00</td>
                                        <td>
                                            <span class="badge bg-light-warning text-dark-warning">Pendente</span>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>#FC0003</td>
                                        <td>Onion Flavour Potato</td>
                                        <td>8 de Fevereiro de 2023</td>
                                        <td>R$9.00</td>
                                        <td>
                                            <span class="badge bg-light-danger text-dark-danger">Cancelado</span>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>#FC0002</td>
                                        <td>Blueberry Greek Yogurt</td>
                                        <td>20 de Janeiro de 2023</td>
                                        <td>R$12.00</td>
                                        <td>
                                            <span class="badge bg-light-warning text-dark-warning">Pendente</span>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>#FC0001</td>
                                        <td>Slurrp Millet Chocolate</td>
                                        <td>14 de Janeiro de 2023</td>
                                        <td>R$8.00</td>
                                        <td>
                                            <span class="badge bg-light-info text-dark-info">Em processamento</span>
                                        </td>
                                    </tr>
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
    window.revenues = @json($revenues)
</script>

<script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/vendors/chart.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#yearSelect').on('change', function() {
            const selectedYear = $(this).val();

            $.ajax({
                url: "{{ route('dashboard.index') }}",
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
        }
    });
</script>

@endsection

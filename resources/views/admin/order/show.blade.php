@extends('admin.layouts.dashboard')
@section('title', 'Pedido Detalhado')
@section('content')

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
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Painel</a></li>
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
                <h2 class="mb-0">ID do Pedido: #FC001</h2>
                <span class="badge bg-light-warning text-dark-warning ms-2">Pendente</span>
              </div>
              <!-- select option -->
              <div class="d-md-flex">
                <div class="mb-2 mb-md-0">
                  <select class="form-select">
                    <option selected>Status</option>
                    <option value="Success">Sucesso</option>
                    <option value="Pending">Pendente</option>
                    <option value="Cancel">Cancelado</option>
                  </select>
                </div>
                <!-- button -->
                <div class="ms-md-3">
                  <a href="#" class="btn btn-primary">Salvar</a>
                  <a href="#" class="btn btn-secondary">Baixar o Invoice</a>
                </div>
              </div>
            </div>
            <div class="mt-8">
              <div class="row">
                <!-- address -->
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="mb-6">
                    <h6>Detalhes do Cliente</h6>
                    <p class="mb-1 lh-lg">John Alex<br>
                      anderalex@example.com<br>
                      +998 99 22123456</p>
                    <a href="#">Ver Perfil</a>
                  </div>
                </div>
                <!-- address -->
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="mb-6">
                    <h6>Endereço de Envio</h6>
                    <p class="mb-1 lh-lg">Gerg Harvell<br>
                      568, Suite Ave.<br>
                      Austrlia, 235153 <br>
                      Contact No. +91 99999 12345</p>

                  </div>
                </div>
                <!-- address -->
                <div class="col-lg-4 col-md-4 col-12">
                  <div class="mb-6">
                    <h6>Detalhes do Pedido</h6>
                    <p class="mb-1 lh-lg">ID do Pedido: <span class="text-dark">FC001</span><br>
                      Data do Pedido: <span class="text-dark">October 22, 2023</span><br>
                      Total do Pedido: <span class="text-dark">R$734.28</span></p>
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
                    <tr>
                      <td>
                        <a href="#" class="text-inherit">
                          <div class="d-flex align-items-center">
                            <div>
                              <img src="{{ asset('images/products/product-img-1.jpg') }}" alt=""
                                class="icon-shape icon-lg">
                            </div>
                            <div class="ms-lg-4 mt-2 mt-lg-0">
                              <h5 class="mb-0 h6">
                                Haldiram's Sev Bhujia
                              </h5>

                            </div>
                          </div>
                        </a>
                      </td>
                      <td><span class="text-body">R$18.0</span></td>
                      <td>1</td>
                      <td>R$18.00</td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#" class="text-inherit">
                          <div class="d-flex align-items-center">
                            <div>
                              <img src="{{ asset('images/products/product-img-2.jpg') }}" alt=""
                                class="icon-shape icon-lg">
                            </div>
                            <div class="ms-lg-4 mt-2 mt-lg-0">
                              <h5 class="mb-0 h6">
                                NutriChoice Digestive
                              </h5>

                            </div>
                          </div>
                        </a>
                      </td>
                      <td><span class="text-body">R$24.0</span></td>
                      <td>1</td>
                      <td>R$24.00</td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#" class="text-inherit">
                          <div class="d-flex align-items-center">
                            <div>
                              <img src="{{ asset('images/products/product-img-3.jpg') }}" alt=""
                                class="icon-shape icon-lg">
                            </div>
                            <div class="ms-lg-4 mt-2 mt-lg-0">
                              <h5 class="mb-0 h6">
                                Cadbury 5 Star Chocolate
                              </h5>

                            </div>
                          </div>
                        </a>
                      </td>
                      <td><span class="text-body">R$32.0</span></td>
                      <td>1</td>
                      <td>R$32.0</td>
                    </tr>
                    <tr>
                      <td>
                        <a href="#" class="text-inherit">
                          <div class="d-flex align-items-center">
                            <div>
                              <img src="{{ asset('images/products/product-img-4.jpg') }}" alt=""
                                class="icon-shape icon-lg">
                            </div>
                            <div class="ms-lg-4 mt-2 mt-lg-0">
                              <h5 class="mb-0 h6">
                                Onion Flavour Potato
                              </h5>

                            </div>
                          </div>
                        </a>
                      </td>
                      <td><span class="text-body">R$3.0</span></td>
                      <td>2</td>
                      <td>R$6.0</td>
                    </tr>
                    <tr>
                      <td class="border-bottom-0 pb-0"></td>
                      <td class="border-bottom-0 pb-0"></td>
                      <td colspan="1" class="fw-medium text-dark ">
                        <!-- text -->
                        Subtotal :
                      </td>
                      <td class="fw-medium text-dark ">
                        <!-- text -->
                        R$80.00
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
                        R$10.00
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
                        R$90.00
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
                <span>Pagamento na Entrega</span>
              </div>
              <div class="col-md-6">
                <h5>Anotações</h5>
                <textarea class="form-control mb-3" rows="3" placeholder="Escrever anotações sobre o pedido"></textarea>
                <a href="#" class="btn btn-primary">Salvar Anotações</a>
              </div>
            </div>
          </div>




        </div>

      </div>

    </div>

  </div>

</main>

@endsection
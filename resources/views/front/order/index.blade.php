@extends('front/layouts/account')
@section('title', 'Pedidos')

@section('content')

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
            <th>Quant.</th>
            <th>Status</th>
            <th>Valor</th>

            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body -->
          <tr>
            <td class="align-middle border-top-0 w-0">
              <a href="#"> <img src="{{ asset('images/products/product-img-1.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>

            </td>
            <td class="align-middle border-top-0">

              <a href="#" class="fw-semi-bold text-inherit">
                <h6 class="mb-0">Haldiram's Nagpur Aloo Bhujia</h6>
              </a>
              <span><small class="text-muted">400g</small></span>

            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#14899</a>

            </td>
            <td class="align-middle border-top-0">
              5 de Março de 2023

            </td>
            <td class="align-middle border-top-0">
              1

            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-warning">Processando</span>
            </td>
            <td class="align-middle border-top-0">
              R$15.00
            </td>
            <td class="text-muted align-middle border-top-0">
              <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td class="align-middle border-top-0 w-0">
              <a href="#"> <img src="{{ asset('images/products/product-img-2.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>

            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="fw-semi-bold text-inherit">
                <h6 class="mb-0">Nutri Choise Biscuit</h6>
              </a>
              <span><small class="text-muted">2 Pkt</small></span>

            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#14658
              </a>
            </td>
            <td class="align-middle border-top-0">
              9 de Julho de 2023
            </td>
            <td class="align-middle border-top-0">
              2
            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-success">Concluído</span>
            </td>
            <td class="align-middle border-top-0">
              R$45.00
            </td>
            <td class="text-muted align-middle border-top-0">
                <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td class="align-middle border-top-0 w-0">
            <a href="#"> <img src="{{ asset('images/products/product-img-3.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">
                <h6 class="mb-0">Cadbury Dairy Milk 5 Star Bites </h6>
                <span><small class="text-muted">202 g</small></span>
              </a>

            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#13778
              </a>
            </td>
            <td class="align-middle border-top-0">
              3 de Outubro de 2023
            </td>
            <td class="align-middle border-top-0">
              4

            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-success">Concluído</span>
            </td>
            <td class="align-middle border-top-0">
              R$99.00
            </td>
            <td class="text-muted align-middle border-top-0">
                <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td class="align-middle border-top-0 w-0">
              <a href="#"> <img src="{{ asset('images/products/product-img-4.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>

            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="fw-semi-bold text-inherit">
                <h6 class="mb-0">Onion Flavour Potato </h6>
              </a>
              <span><small class="text-muted">100 g</small></span>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#13746
              </a>
            </td>
            <td class="align-middle border-top-0">
              5 de Março de 2023
            </td>
            <td class="align-middle border-top-0">
              1
            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-success">Concluído</span>
            </td>
            <td class="align-middle border-top-0">
              R$12.00
            </td>
            <td class="text-muted align-middle border-top-0">
                <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td class="align-middle border-top-0 w-0">
              <a href="#"> <img src="{{ asset('images/products/product-img-5.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="fw-semi-bold text-inherit">
                <h6 class="mb-0">Salted Instant Popcorn </h6>
              </a>
              <span><small class="text-muted">500 g</small></span>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#13566
              </a>
            </td>
            <td class="align-middle border-top-0">
              9 de julho de 2023
            </td>
            <td class="align-middle border-top-0">
              2
            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-danger">Cancelado</span>
            </td>
            <td class="align-middle border-top-0">
              R$6.00
            </td>
            <td class="text-muted align-middle border-top-0">
                <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
          <tr>
            <td class="align-middle border-top-0 w-0">
              <a href="#"> <img src="{{ asset('images/products/product-img-6.jpg') }}" alt="Ecommerce"
                  class="icon-shape icon-xl"></a>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="fw-semi-bold text-inherit">
                <h6 class="mb-0">Blueberry Greek Yogurt </h6>
              </a>
              <span><small class="text-muted">500 g</small></span>
            </td>
            <td class="align-middle border-top-0">
              <a href="#" class="text-inherit">#12094
              </a>
            </td>
            <td class="align-middle border-top-0">
              03 de Outubro de 2023
            </td>
            <td class="align-middle border-top-0">
              4
            </td>
            <td class="align-middle border-top-0">
              <span class="badge bg-success">Concluído</span>
            </td>
            <td class="align-middle border-top-0">
              R$18.00
            </td>
            <td class="text-muted align-middle border-top-0">
                <a href="#" class="text-inherit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View"><i class="feather-icon icon-eye"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
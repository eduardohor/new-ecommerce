@extends('front/layouts/store')
@section('title', 'Início')
@section('content')

@section('head')
<link href="{{ asset('libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">

@endsection


<main>
  <section class="mt-8">
    <div class="container">
      <div class="hero-slider ">
        <div
          style="background: url({{ asset('images/slider/slide-1.jpg') }})no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
          <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
            <span class="badge text-bg-warning">Desconto de Abertura 50%</span>

            <h2 class="text-dark display-5 fw-bold mt-4">Supermercado para Produtos Frescos</h2>
            <p class="lead">ntroduzido um novo modelo para compras de supermercado online e entrega conveniente em casa.
            </p>
            <a href="#!" class="btn btn-dark mt-3">Comprar Agora <i class="feather-icon icon-arrow-right ms-1"></i></a>
          </div>

        </div>
        <div class=" "
          style="background: url({{ asset('images/slider/slider-2.jpg') }})no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
          <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
            <span class="badge text-bg-warning">Frete Grátis - pedidos acima de R$100</span>
            <h2 class="text-dark display-5 fw-bold mt-4">Frete Grátis em <br> pedidos acima de <span
                class="text-primary">R$100</span></h2>
            <p class="lead">Frete Grátis somente para Clientes de Primeira Viagem, após aplicação de promoções e
              descontos.
            </p>
            <a href="#!" class="btn btn-dark mt-3">Comprar Agora <i class="feather-icon icon-arrow-right ms-1"></i></a>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- Category Section Start-->
  <section class="mb-lg-10 mt-lg-14 my-8">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-6">

          <h3 class="mb-0">Categorias em Destaque</h3>

        </div>
      </div>
      <div class="category-slider ">

        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-dairy-bread-eggs.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3 img-fluid">
                <div class="text-truncate">Latcínios, Pão e Ovos</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-snack-munchies.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Lanches e Petiscos</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-bakery-biscuits.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Padaria e Biscoitos</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-instant-food.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Instant Food</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-tea-coffee-drinks.jpg') }}"
                  alt="Grocery Ecommerce Template" class="mb-3">
                <div class="text-truncate">Tea, Coffee & Drinks</div>
              </div>
            </div>
          </a></div>
        <div class="item"><a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-atta-rice-dal.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Atta, Rice & Dal</div>
              </div>
            </div>
          </a></div>

        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-baby-care.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Baby Care</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-chicken-meat-fish.jpg') }}"
                  alt="Grocery Ecommerce Template" class="mb-3">
                <div class="text-truncate">Chicken, Meat & Fish</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-cleaning-essentials.jpg') }}"
                  alt="Grocery Ecommerce Template" class="mb-3">
                <div class="text-truncate">Cleaning Essentials</div>
              </div>
            </div>
          </a></div>
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-pet-care.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Pet Care</div>
              </div>
            </div>
          </a></div>
      </div>

    </div>
  </section>
  <!-- Category Section End-->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 mb-3 mb-lg-0">
          <div>
            <div class="py-10 px-8 rounded"
              style="background:url({{ asset('images/banner/grocery-banner.png') }})no-repeat; background-size: cover; background-position: center;">
              <div>
                <h3 class="fw-bold mb-1">Frutas e Vegetais
                </h3>
                <p class="mb-4">Ganhe até <span class="fw-bold">30%</span> de desconto</p>
                <a href="#!" class="btn btn-dark">Comprar Agora</a>
              </div>
            </div>

          </div>

        </div>
        <div class="col-12 col-md-6 ">

          <div>
            <div class="py-10 px-8 rounded"
              style="background:url({{ asset('images/banner/grocery-banner-2.jp') }}g)no-repeat; background-size: cover; background-position: center;">
              <div>
                <h3 class="fw-bold mb-1">Pãezinhos Frescos Assados</h3>
                <p class="mb-4">Ganhe até <span class="fw-bold">25%</span> de desconto</p>
                <a href="#!" class="btn btn-dark">Comprar Agora</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Popular Products Start-->
  <section class="my-lg-14 my-8">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-6">

          <h3 class="mb-0">Produtos Populares</h3>

        </div>
      </div>

      <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
        <div class="col">
          <div class="card card-product">
            <div class="card-body">

              <div class="text-center position-relative ">
                <div class=" position-absolute top-0 start-0">
                  <span class="badge bg-danger">Sale</span>
                </div>
                <a href="#!"> <img src="{{ asset('images/products/product-img-1.jpg') }}"
                    alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>

                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>

              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Haldiram's
                  Sev Bhujia</a></h2>
              <div>

                <small class="text-warning"> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5(149)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$18</span> <span
                    class="text-decoration-line-through text-muted">R$24</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative">
                <div class=" position-absolute top-0 start-0">
                  <span class="badge bg-success">14%</span>
                </div>
                <a href="{{ route('product') }}"><img src="{{ asset('') }}images/products/product-img-2.jpg"
                    alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>

              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Padaria e
                    Biscoitos</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">NutriChoice
                  Digestive </a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (25)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$24</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-3.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Padaria e
                    Biscoitos</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Cadbury 5
                  Star Chocolate</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i></small> <span class="text-muted small">5 (469)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$32</span> <span
                    class="text-decoration-line-through text-muted">R$35</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-4.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
                <div class=" position-absolute top-0 start-0">
                  <span class="badge bg-danger">Hot</span>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Onion
                  Flavour Potato</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i></small> <span class="text-muted small">3.5 (456)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$3</span> <span class="text-decoration-line-through text-muted">R$5</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-5.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Instant
                    Food</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Salted
                  Instant Popcorn </a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (39)</span>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <div><span class="text-dark">R$13</span> <span
                    class="text-decoration-line-through text-muted">R$18</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">

              <div class="text-center position-relative ">
                <div class=" position-absolute top-0 start-0">
                  <span class="badge bg-danger">Sale</span>
                </div>
                <a href="#!"> <img src="{{ asset('') }}images/products/product-img-6.jpg"
                    alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Dairy, Bread &
                    Eggs</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Blueberry
                  Greek Yogurt</a></h2>
              <div>

                <small class="text-warning"> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (189)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$18</span> <span
                    class="text-decoration-line-through text-muted">R$24</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-7.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Dairy, Bread &
                    Eggs</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Britannia
                  Cheese Slices</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i></small> <span class="text-muted small">5 (345)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$24</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-8.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Instant
                    Food</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Kellogg's
                  Original Cereals</a>
              </h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4 (90)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$32</span> <span
                    class="text-decoration-line-through text-muted">R$35</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-9.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Snack &
                    Munchies</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Slurrp
                  Millet Chocolate </a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5 (67)</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div><span class="text-dark">R$3</span> <span class="text-decoration-line-through text-muted">R$5</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card card-product">
            <div class="card-body">
              <div class="text-center position-relative"> <a href="{{ route('product') }}"><img
                    src="{{ asset('') }}images/products/product-img-10.jpg" alt="Grocery Ecommerce Template"
                    class="mb-3 img-fluid"></a>
                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                      class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="../pages/shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a>
                </div>
              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Dairy, Bread &
                    Eggs</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Amul
                  Butter - 500 g</a></h2>
              <div class="text-warning">

                <small> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                  <i class="bi bi-star"></i></small> <span class="text-muted small">3.5 (89)</span>
              </div>
              <div class="d-flex justify-content-between mt-4">
                <div><span class="text-dark">R$13</span> <span
                    class="text-decoration-line-through text-muted">R$18</span>
                </div>
                <div><a href="#!" class="btn btn-primary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Popular Products End-->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-6">
          <h3 class="mb-0">Mais Vendidos Diariamente</h3>
        </div>
      </div>
      <div class="table-responsive-xl pb-6">
        <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4 flex-nowrap">
          <div class="col">
            <div class=" pt-8 px-6 px-xl-8 rounded"
              style="background:url({{ asset('images/banner/banner-deal.jpg') }})no-repeat; background-size: cover; height: 470px;">
              <div>
                <h3 class="fw-bold text-white">100% Orgânico
                  Grãos de Café.
                </h3>
                <p class="text-white">Obtenha a melhor oferta antes do encerramento.</p>
                <a href="#!" class="btn btn-primary">Comprar Agora <i
                    class="feather-icon icon-arrow-right ms-1"></i></a>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card card-product">
              <div class="card-body">
                <div class="text-center  position-relative "> <a href="{{ route('product') }}"><img
                      src="{{ asset('') }}images/products/product-img-11.jpg" alt="Grocery Ecommerce Template"
                      class="mb-3 img-fluid"></a>

                  <div class="card-product-action">
                    <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                        class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                      title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                        class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
                <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Tea, Coffee &
                      Drinks</small></a></div>
                <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Roast
                    Ground Coffee</a></h2>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div><span class="text-dark">R$13</span> <span
                      class="text-decoration-line-through text-muted">R$18</span>
                  </div>
                  <div>
                    <small class="text-warning"> <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span><small>4.5</small></span>
                  </div>
                </div>
                <div class="d-grid mt-2"><a href="#!" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar ao carrinho </a></div>
                <div class="d-flex justify-content-start text-center mt-3">
                  <div class="deals-countdown w-100" data-countdown="2028/10/10 00:00:00"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card card-product">
              <div class="card-body">
                <div class="text-center  position-relative "> <a href="{{ route('product') }}"><img
                      src="{{ asset('') }}images/products/product-img-12.jpg" alt="Grocery Ecommerce Template"
                      class="mb-3 img-fluid"></a>
                  <div class="card-product-action">
                    <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                        class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                      title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                        class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
                <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Fruits &
                      Vegetables</small></a></div>
                <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Crushed
                    Tomatoes</a></h2>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div><span class="text-dark">R$13</span> <span
                      class="text-decoration-line-through text-muted">R$18</span>
                  </div>
                  <div>
                    <small class="text-warning"> <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span><small>4.5</small></span>
                  </div>
                </div>
                <div class="d-grid mt-2"><a href="#!" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar ao carrinho </a></div>
                <div class="d-flex justify-content-start text-center mt-3 w-100">
                  <div class="deals-countdown w-100" data-countdown="2028/12/9 00:00:00"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card card-product">
              <div class="card-body">
                <div class="text-center  position-relative "> <a href="{{ route('product') }}"><img
                      src="{{ asset('') }}images/products/product-img-13.jpg" alt="Grocery Ecommerce Template"
                      class="mb-3 img-fluid"></a>
                  <div class="card-product-action">
                    <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                        class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                      title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                        class="bi bi-arrow-left-right"></i></a>
                  </div>
                </div>
                <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>Fruits &
                      Vegetables</small></a></div>
                <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">Golden
                    Pineapple</a></h2>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div><span class="text-dark">R$13</span> <span
                      class="text-decoration-line-through text-muted">R$18</span>
                  </div>
                  <div>
                    <small class="text-warning"> <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i></small>
                    <span><small>4.5</small></span>
                  </div>
                </div>
                <div class="d-grid mt-2"><a href="#!" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <line x1="12" y1="5" x2="12" y2="19"></line>
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg> Adicionar ao carrinho </a></div>
                <div class="d-flex justify-content-start text-center mt-3">
                  <div class="deals-countdown w-100" data-countdown="2028/11/11 00:00:00"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="my-lg-14 my-8">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('') }}images/icons/clock.svg" alt=""></div>
            <h3 class="h5 mb-3">
              Mercearia de 10 minutos agora
            </h3>
            <p>Faça com que seu pedido seja entregue à sua porta o mais rápido possível nas lojas de coleta FreshCart
              perto de você.</p>
          </div>
        </div>
        <div class="col-md-6  col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('') }}images/icons/gift.svg" alt=""></div>
            <h3 class="h5 mb-3">Melhores preços e ofertas</h3>
            <p>Preços mais baratos do que o supermercado local, ótimas ofertas de reembolso para completar. Obtenha os
              melhores preços e ofertas.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('') }}images/icons/package.svg" alt=""></div>
            <h3 class="h5 mb-3">Ampla variedade</h3>
            <p>Escolha entre mais de 5.000 produtos em alimentos, cuidados pessoais, casa, padaria, vegetais e não
              vegetais e outras categorias.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('') }}images/icons/refresh-cw.svg" alt=""></div>
            <h3 class="h5 mb-3">Devoluções fáceis</h3>
            <p>Não está satisfeito com um produto? Devolva-o na porta e receba um reembolso em poucas horas. Sem
              perguntas sobre política.
              <a href="#!">política</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


<!-- Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-8">
        <div class="position-absolute top-0 end-0 me-3 mt-3">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <!-- img slide -->
            <div class="product productModal" id="productModal">
              <div class="zoom" onmousemove="zoom(event)" style="
                  background-image: url({{ asset('images/products/product-single-img-1.jpg') }});
                ">
                <!-- img -->
                <img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
              </div>
              <div>
                <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-2.jpg') }});
                  ">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
                </div>
              </div>
              <div>
                <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-3.jpg') }});
                  ">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
                </div>
              </div>
              <div>
                <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-4.jpg') }});
                  ">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
                </div>
              </div>
            </div>
            <!-- product tools -->
            <div class="product-tools">
              <div class="thumbnails row g-3" id="productModalThumbnails">
                <div class="col-3" class="tns-nav-active">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
                  </div>
                </div>
                <div class="col-3">
                  <div class="thumbnails-img">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ps-lg-8 mt-6 mt-lg-0">
              <a href="#!" class="mb-4 d-block">Padaria e Biscoitos</a>
              <h2 class="mb-1 h1">Napolitanke Ljesnjak</h2>
              <div class="mb-4">
                <small class="text-warning">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small><a href="#" class="ms-2">(30 avaliações)</a>
              </div>
              <div class="fs-4">
                <span class="fw-bold text-dark">R$32</span>
                <span class="text-decoration-line-through text-muted">R$35</span><span><small
                    class="fs-6 ms-2 text-danger">26% de desconto</small></span>
              </div>
              <hr class="my-6">
              <div class="mb-4">
                <button type="button" class="btn btn-outline-secondary">
                  250g
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  500g
                </button>
                <button type="button" class="btn btn-outline-secondary">
                  1kg
                </button>
              </div>
              <div>
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <div class="mt-3 row justify-content-start g-2 align-items-center">

                <div class="col-lg-4 col-md-5 col-6 d-grid">
                  <!-- button -->
                  <!-- btn -->
                  <button type="button" class="btn btn-primary">
                    <i class="feather-icon icon-shopping-bag me-2"></i>Adicionar
                  </button>
                </div>
                <div class="col-md-4 col-5">
                  <!-- btn -->
                  <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare"><i
                      class="bi bi-arrow-left-right"></i></a>
                  <a class="btn btn-light" href="#!" data-bs-toggle="tooltip" data-bs-html="true"
                    aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
                </div>
              </div>
              <hr class="my-6">
              <div>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>Código do Produto:</td>
                      <td>FBB00255</td>
                    </tr>
                    <tr>
                      <td>Disponibilidade:</td>
                      <td>Em Estoque</td>
                    </tr>
                    <tr>
                      <td>Tipo:</td>
                      <td>Frutas</td>
                    </tr>
                    <tr>
                      <td>Envia:</td>
                      <td>
                        <small>01 dia de envio.<span class="text-muted">(Retirada gratuita hoje)</span></small>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('footer')

<script src="{{ asset('js/vendors/countdown.js') }}"></script>
<script src="{{ asset('libs/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/vendors/slick-slider.js') }}"></script>
<script src="{{ asset('libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('js/vendors/zoom.js') }}"></script>
<script src="{{ asset('js/vendors/increment-value.js') }}"></script>

@endsection

@endsection
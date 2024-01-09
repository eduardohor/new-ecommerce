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

        @forelse ($categories as $category)
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
            <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('storage/' . $category->image) }}" alt="Grocery Ecommerce Template"
                  class="mb-3 img-fluid">
                <div class="text-truncate">{{ $category->name }}</div>
              </div>
            </div>
          </a>
        </div>
        @empty
        <p>Aguardando Categorias</p>
        @endforelse


        {{-- <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
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
        <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit"> --}}
            {{-- <div class="card card-product mb-lg-4">
              <div class="card-body text-center py-8">
                <img src="{{ asset('images/category/category-pet-care.jpg') }}" alt="Grocery Ecommerce Template"
                  class="mb-3">
                <div class="text-truncate">Pet Care</div>
              </div>
            </div>
          </a></div> --}}
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

  @include('front.partials.product-view-modal')

  <!-- Popular Products Start-->
  <section class="my-lg-14 my-8">
    <div class="container">
      <div class="row">
        <div class="col-12 mb-6">

          <h3 class="mb-0">Produtos Populares</h3>

        </div>
      </div>

      <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">

        @forelse ($popularProducts as $popularProduct)
        @php
        $categoryPopularProduct = $popularProduct->category;
        $imagesPopularProduct = $popularProduct->productImages;
        @endphp

        <div class="col">
          <div class="card card-product">
            <div class="card-body">

              <div class="text-center position-relative ">
                <div class="position-absolute top-0 start-0">
                  @if($popularProduct->sale_price > 0)
                  @php
                  $regularPrice = $popularProduct->regular_price;
                  $salePrice = $popularProduct->sale_price;
                  $discountPercentage = round(($regularPrice - $salePrice) / $regularPrice * 100);
                  @endphp

                  <span class="badge bg-success">{{ $discountPercentage }}%</span>
                  @endif
                </div>
                <a href="#!"> <img src="{{ asset('storage/' . $imagesPopularProduct->first()->image_path) }}"
                    alt="Image Produto {{ $popularProduct->title }}" class="mb-4 mt-6 img-fluid"></a>

                <div class="card-product-action">
                  <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#productViewModal"
                    onclick="showProductViewModal({{ $popularProduct }})"><i class="bi bi-eye" data-bs-toggle="tooltip"
                      data-bs-html="true" title="Olhada Rápida"></i></a>
                  <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                  {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true" title="Comparar"><i
                      class="bi bi-arrow-left-right"></i></a> --}}
                </div>
                @include('front.partials.product-view-modal')


              </div>
              <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>{{
                    $categoryPopularProduct->name }}</small></a></div>
              <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">{{
                  $popularProduct->title }}</a></h2>

              {{-- <div>
                AVALIAÇÃO
                <small class="text-warning"> <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i></small> <span class="text-muted small">4.5(149)</span>
              </div> --}}
              <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                  @if($popularProduct->sale_price > 0)
                  <span class="text-dark">{{ 'R$' . number_format($popularProduct->sale_price, 2, ',', '.') }}</span>
                  @endif

                  @if($popularProduct->regular_price > 0)
                  <span
                    class="{{ $popularProduct->sale_price > 0 ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                    {{ 'R$' . number_format($popularProduct->regular_price, 2, ',', '.') }}
                  </span>
                  @endif
                </div>

                <div>
                  <a href="#!" class="btn btn-primary btn-sm">Adicionar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <p>Aguardando Produtos...</p>
        @endforelse
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

          @forelse ($topSellingProducts as $topSellingProduct)
          @php
          $categoryTopProduct = $topSellingProduct->category;
          $imagesTopProduct = $topSellingProduct->productImages;
          @endphp
          <div class="col">
            <div class="card card-product">
              <div class="card-body">
                <div class="text-center  position-relative "> <a href="{{ route('product') }}"><img
                      src="{{ asset('storage/' .$imagesTopProduct->first()->image_path) }}"
                      alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>

                  <div class="card-product-action">
                    <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#productViewModal"
                      onclick="showProductViewModal({{ $topSellingProduct }})"><i class="bi bi-eye"
                        data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                      title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                    {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                      title="Comparar"><i class="bi bi-arrow-left-right"></i></a> --}}
                  </div>
                </div>
                <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>{{
                      $categoryTopProduct->name }}</small></a></div>
                <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">{{
                    $topSellingProduct->title }}</a></h2>

                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div>
                    @if ($topSellingProduct->sale_price > 0)
                    <span class="text-dark">{{ 'R$' . number_format($topSellingProduct->sale_price, 2, ',', '.')
                      }}</span>
                    @endif
                    <span
                      class="{{ $topSellingProduct->sale_price > 0 ? 'text-decoration-line-through text-muted' : 'text-dark' }}">{{
                      'R$' . number_format($topSellingProduct->regular_price, 2, ',', '.') }}</span>
                  </div>

                  {{-- Classificação --}}
                  {{-- <div>
                    <small class="text-warning"> <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </small>
                    <span><small>4.5</small></span>
                  </div> --}}

                </div>
                <div class="d-grid mt-2">
                  <a href="#!" class="btn btn-primary ">Adicionar ao carrinho </a>
                </div>
                <div class="d-flex justify-content-start text-center mt-3">
                  <div class="deals-countdown w-100" data-countdown="2024/01/30 00:00:00"></div>
                </div>
              </div>
            </div>
          </div>

          @empty

          <p>Aguardando Produtos...</p>

          @endforelse
        </div>
      </div>
    </div>
  </section>
  <section class="my-lg-14 my-8">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('images/icons/clock.svg') }}" alt=""></div>
            <h3 class="h5 mb-3">
              Mercearia de 10 minutos agora
            </h3>
            <p>Faça com que seu pedido seja entregue à sua porta o mais rápido possível nas lojas de coleta FreshCart
              perto de você.</p>
          </div>
        </div>
        <div class="col-md-6  col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('images/icons/gift.svg') }}" alt=""></div>
            <h3 class="h5 mb-3">Melhores preços e ofertas</h3>
            <p>Preços mais baratos do que o supermercado local, ótimas ofertas de reembolso para completar. Obtenha os
              melhores preços e ofertas.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('images/icons/package.svg') }}" alt=""></div>
            <h3 class="h5 mb-3">Ampla variedade</h3>
            <p>Escolha entre mais de 5.000 produtos em alimentos, cuidados pessoais, casa, padaria, vegetais e não
              vegetais e outras categorias.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="mb-8 mb-xl-0">
            <div class="mb-6"><img src="{{ asset('images/icons/refresh-cw.svg') }}" alt=""></div>
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

@section('footer')

<script src="{{ asset('js/vendors/countdown.js') }}"></script>
<script src="{{ asset('libs/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/vendors/slick-slider.js') }}"></script>
<script src="{{ asset('libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('js/vendors/increment-value.js') }}"></script>

@endsection

@endsection
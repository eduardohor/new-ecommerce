@extends('front/layouts/store')
@section('title', 'Loja')
@section('content')

@section('head')
<link href="{{ asset('libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
<link href="{{ asset('libs/nouislider/dist/nouislider.min.css') }}" rel="stylesheet">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">

@endsection

<main>
  <!-- section-->
  <div class="mt-4">
    <div class="container">
      <!-- row -->
      <div class="row ">
        <!-- col -->
        <div class="col-12">
          <!-- breadcrumb -->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
              <li class="breadcrumb-item active" aria-current="page">Loja</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->
  <div class=" mt-8 mb-lg-14 mb-8">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row gx-10">
        <!-- col -->
        <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
          <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 " tabindex="-1" id="offcanvasCategory"
            aria-labelledby="offcanvasCategoryLabel">

            <div class="offcanvas-header d-lg-none">
              <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filtros</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ps-lg-2 pt-lg-0">
              <div class="mb-8">
                <!-- title -->
                <h5 class="mb-3">Categorias</h5>
                <!-- nav -->
                <ul class="nav nav-category" id="categoryCollapseMenu">
                  @foreach ($categories as $category)
                  <li class="nav-item border-bottom w-100">
                    <div class="d-flex align-items-center">
                      <a href="{{ route('category-products', ['slug' => $category->slug]) }}"
                        class="nav-link flex-grow-1">
                        {{ $category->name }}
                      </a>
                      <i class="feather-icon icon-chevron-right" data-bs-toggle="collapse"
                        data-bs-target="#category{{ $category->id }}" aria-expanded="false"
                        aria-controls="category{{ $category->id }}"></i>
                    </div>

                    @if ($category->children)
                    <!-- accordion collapse -->
                    <div id="category{{ $category->id }}" class="accordion-collapse collapse"
                      data-bs-parent="#categoryCollapseMenu">
                      <div>
                        <!-- nav -->
                        <ul class="nav flex-column ms-3">
                          @foreach ($category->children as $child)
                          <!-- nav item -->
                          <li class="nav-item">
                            <a href="{{ route('category-products', ['slug' => $child->slug]) }}" class="nav-link">
                              {{ $child->name }}
                            </a>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    @endif
                  </li>
                  @endforeach
                </ul>

              </div>

              {{-- <div class="mb-8">

                <h5 class="mb-3">Stores</h5>
                <div class="my-4">
                  <!-- input -->
                  <input type="search" class="form-control" placeholder="Search by store">
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="eGrocery" checked>
                  <label class="form-check-label" for="eGrocery">
                    E-Grocery
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="DealShare">
                  <label class="form-check-label" for="DealShare">
                    DealShare
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="Dmart">
                  <label class="form-check-label" for="Dmart">
                    DMart
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="Blinkit">
                  <label class="form-check-label" for="Blinkit">
                    Blinkit
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="BigBasket">
                  <label class="form-check-label" for="BigBasket">
                    BigBasket
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="StoreFront">
                  <label class="form-check-label" for="StoreFront">
                    StoreFront
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="Spencers">
                  <label class="form-check-label" for="Spencers">
                    Spencers
                  </label>
                </div>
                <!-- form check -->
                <div class="form-check mb-2">
                  <!-- input -->
                  <input class="form-check-input" type="checkbox" value="" id="onlineGrocery">
                  <label class="form-check-label" for="onlineGrocery">
                    Online Grocery
                  </label>
                </div>

              </div> --}}
              {{-- <div class="mb-8">
                <!-- price -->
                <h5 class="mb-3">Preço</h5>
                <div>
                  <!-- range -->
                  <div id="priceRange" class="mb-3"></div>
                  <small class="text-muted">Preço:</small> <span id="priceRange-value" class="small"></span>

                </div>



              </div> --}}
              <!-- rating -->
              {{-- <div class="mb-8">

                <h5 class="mb-3">Avaliação</h5>
                <div>
                  <!-- form check -->
                  <div class="form-check mb-2">
                    <!-- input -->
                    <input class="form-check-input" type="checkbox" value="" id="ratingFive">
                    <label class="form-check-label" for="ratingFive">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                    </label>
                  </div>
                  <!-- form check -->
                  <div class="form-check mb-2">
                    <!-- input -->
                    <input class="form-check-input" type="checkbox" value="" id="ratingFour" checked>
                    <label class="form-check-label" for="ratingFour">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star text-warning"></i>
                    </label>
                  </div>
                  <!-- form check -->
                  <div class="form-check mb-2">
                    <!-- input -->
                    <input class="form-check-input" type="checkbox" value="" id="ratingThree">
                    <label class="form-check-label" for="ratingThree">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star-fill text-warning "></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                    </label>
                  </div>
                  <!-- form check -->
                  <div class="form-check mb-2">
                    <!-- input -->
                    <input class="form-check-input" type="checkbox" value="" id="ratingTwo">
                    <label class="form-check-label" for="ratingTwo">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                    </label>
                  </div>
                  <!-- form check -->
                  <div class="form-check mb-2">
                    <!-- input -->
                    <input class="form-check-input" type="checkbox" value="" id="ratingOne">
                    <label class="form-check-label" for="ratingOne">
                      <i class="bi bi-star-fill text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                      <i class="bi bi-star text-warning"></i>
                    </label>
                  </div>
                </div>


              </div> --}}
              <div class="mb-8 position-relative">
                <!-- Banner Design -->
                <!-- Banner Content -->
                <div class="position-absolute p-5 py-8">
                  <h3 class="mb-0">Frutas frescas </h3>
                  <p>Ganhe até 25% de desconto</p>
                  <a href="#" class="btn btn-dark">Comprar Agora<i class="feather-icon icon-arrow-right ms-1"></i></a>
                </div>
                <!-- Banner Content -->
                <!-- Banner Image -->
                <!-- img --><img src="{{ asset('images/banner/assortment-citrus-fruits.png') }}" alt=""
                  class="img-fluid rounded ">
                <!-- Banner Image -->
              </div>
            </div>
          </div>
        </aside>
        <section class="col-lg-9 col-md-12">
          <!-- card -->
          <div class="card mb-4 bg-light border-0">
            <!-- card body -->
            <div class="card-body">
              <h2 class="mb-0 fs-1">Todos os Produtos</h2>
            </div>
          </div>
          <!-- list icon -->
          <div class="d-lg-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
              <p class="mb-0"> <span class="text-dark">{{ !empty($products) ? $products->total() : 0}} </span> Produtos
                encontrados </p>
            </div>

            <!-- icon -->
            <div class="d-md-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center justify-content-between">
                {{-- <div>

                  <a href="shop-list.html" class="text-muted me-3"><i class="bi bi-list-ul"></i></a>
                  <a href="shop-grid.html" class=" me-3 active"><i class="bi bi-grid"></i></a>
                  <a href="shop-grid-3-column.html" class="me-3 text-muted"><i class="bi bi-grid-3x3-gap"></i></a>
                </div> --}}
                <div class="ms-2 d-lg-none">
                  {{-- <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas"
                    href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory"><svg
                      xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-filter me-2">
                      <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg> Filtros</a> --}}
                </div>
              </div>

              <form method="GET" action="{{ route('store') }}">
                <div class="d-flex mt-2 mt-lg-0">
                  <div class="me-2 flex-grow-1">
                    <!-- select option -->
                    <select name="per_page" class="form-select" onchange="this.form.submit()">
                      <option value="32" {{ Request::get('per_page')==32 ? 'selected' : '' }}>Exibir: 32</option>
                      <option value="24" {{ Request::get('per_page')==24 ? 'selected' : '' }}>Exibir: 24</option>
                      <option value="16" {{ Request::get('per_page')==16 ? 'selected' : '' }}>Exibir: 16</option>
                    </select>
                  </div>
                  <div>
                    <!-- select option -->
                    <select name="order_by" class="form-select" onchange="this.form.submit()">
                      <option value="highlighted" {{ Request::get('order_by')=='featured' ? 'selected' : '' }}>Em
                        destaque
                      </option>
                      <option value="low_to_high" {{ Request::get('order_by')=='low_to_high' ? 'selected' : '' }}>Preço:
                        menor para o maior</option>
                      <option value="high_to_low" {{ Request::get('order_by')=='high_to_low' ? 'selected' : '' }}>Price:
                        maior para o menor</option>
                      <option value="release_date" {{ Request::get('order_by')=='release_date' ? 'selected' : '' }}>Data
                        de lançamento</option>
                    </select>
                  </div>
                </div>
              </form>


            </div>
          </div>
          <!-- row -->
          <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">

            @forelse ($products as $product)
            @php
            $categoryProduct = $product->category;
            $imagesProduct = $product->productImages;
            @endphp

            <div class="col">
              <div class="card card-product">
                <div class="card-body">

                  <div class="text-center position-relative ">
                    <div class="position-absolute top-0 start-0">
                      @if($product->sale_price > 0)
                      @php
                      $regularPrice = $product->regular_price;
                      $salePrice = $product->sale_price;
                      $discountPercentage = round(($regularPrice - $salePrice) / $regularPrice * 100);
                      @endphp

                      <span class="badge bg-success">{{ $discountPercentage }}%</span>
                      @endif
                    </div>
                    <a href="#!"> <img src="{{ asset('storage/' . $imagesProduct->first()->image_path) }}"
                        alt="Image Produto {{ $product->title }}" class="mb-4 mt-6 img-fluid"></a>

                    <div class="card-product-action">
                      <a href="#!" class="btn-action" data-bs-toggle="modal" data-bs-target="#productViewModal"
                        onclick="showProductViewModal({{ $product }})"><i class="bi bi-eye" data-bs-toggle="tooltip"
                          data-bs-html="true" title="Olhada Rápida"></i></a>
                      <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                        title="Lista de Favoritos"><i class="bi bi-heart"></i></a>
                      {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                        title="Comparar"><i class="bi bi-arrow-left-right"></i></a> --}}
                    </div>

                  </div>
                  <div class="text-small mb-1"><a href="#!" class="text-decoration-none text-muted"><small>{{
                        $categoryProduct->name }}</small></a></div>
                  <h2 class="fs-6"><a href="{{ route('product') }}" class="text-inherit text-decoration-none">{{
                      $product->title }}</a></h2>

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
                      @if($product->sale_price > 0)
                      <span class="text-dark">{{ 'R$' . number_format($product->sale_price, 2, ',', '.')
                        }}</span>
                      @endif

                      @if($product->regular_price > 0)
                      <span
                        class="{{ $product->sale_price > 0 ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                        {{ 'R$' . number_format($product->regular_price, 2, ',', '.') }}
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
          @if($products)
          <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
            <span class="mb-2 mb-md-0">Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{
              $products->total() }} resultados</span>
            <nav class="mt-2 mt-md-0">
              {{ $products->appends([
              'order_by' => request()->get('order_by', ''),
              'per_page' => request()->get('per_page', '')
              ])->links() }}
            </nav>
          </div>

          @endif
        </section>
      </div>
    </div>
  </div>

  @include('front.partials.product-view-modal')

</main>


@section('footer')

<!-- Javascript-->
<script src="{{ asset('libs/nouislider/dist/nouislider.min.js') }}"></script>
<script src="{{ asset('libs/wnumb/wNumb.min.js') }}"></script>

<script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>

<script src="{{ asset('libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('js/vendors/zoom.js') }}"></script>
<script src="{{ asset('js/vendors/increment-value.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>

@endsection


@endsection
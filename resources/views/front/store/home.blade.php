@extends('front/layouts/store')
@section('title', 'Início')

@section('head')
<link href="{{ asset('libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">

@endsection


@section('content')


<main>
    {{-- <a href="{{ route('email') }}">email</a> --}}
    <section class="mt-8">
        <div class="container">
            @if(isset($heroBanners) && $heroBanners->count())
                <div class="hero-slider">
                    @foreach($heroBanners as $banner)
                        <div>
                            @if($banner->link_url)
                                <a href="{{ $banner->link_url }}" class="d-block position-relative hero-slide" target="{{ $banner->link_target }}" rel="noopener"
                                    style="background: url({{ $banner->image_url ?? asset('images/placeholder.jpg') }}) no-repeat; background-size: cover; background-position: center; border-radius: .5rem; min-height: 625px;">
                                    <span class="visually-hidden">Banner</span>
                                </a>
                            @else
                                <div class="d-block position-relative hero-slide"
                                    style="background: url({{ $banner->image_url ?? asset('images/placeholder.jpg') }}) no-repeat; background-size: cover; background-position: center; border-radius: .5rem; min-height: 625px;">
                                    <span class="visually-hidden">Banner</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="hero-slider ">
                    <div
                        style="background: url({{ asset('images/slider/slide-1.jpg') }})no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
                        <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                            <span class="badge text-bg-warning">Desconto de Abertura 50%</span>

                            <h2 class="text-dark display-5 fw-bold mt-4">Supermercado para Produtos Frescos</h2>
                            <p class="lead">ntroduzido um novo modelo para compras de supermercado online e entrega
                                conveniente em casa.
                            </p>
                            <a href="#!" class="btn btn-dark mt-3">Comprar Agora <i
                                    class="feather-icon icon-arrow-right ms-1"></i></a>
                        </div>

                    </div>
                    <div class=" "
                        style="background: url({{ asset('images/slider/slider-2.jpg') }})no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
                        <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                            <span class="badge text-bg-warning">Frete Grátis - pedidos acima de R$100</span>
                            <h2 class="text-dark display-5 fw-bold mt-4">Frete Grátis em <br> pedidos acima de <span
                                    class="text-primary">R$100</span></h2>
                            <p class="lead">Frete Grátis somente para Clientes de Primeira Viagem, após aplicação de
                                promoções e
                                descontos.
                            </p>
                            <a href="#!" class="btn btn-dark mt-3">Comprar Agora <i
                                    class="feather-icon icon-arrow-right ms-1"></i></a>
                        </div>

                    </div>

                </div>
            @endif
        </div>
    </section>

    <!-- Category Section Start-->
    <section class="mb-lg-10 mt-lg-14 my-8">
        @if ($categories->count())
        <div class="container">
            <div class="row">
                <div class="col-12 mb-6">

                    <h3 class="mb-0">Categorias em Destaque</h3>

                </div>
            </div>
            <div class="category-slider ">

                @forelse ($categories as $category)
                <div class="item"> <a href="{{ route('category-products', $category->slug) }}"
                        class="text-decoration-none text-inherit">
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
                                <img src="{{ asset('images/category/category-snack-munchies.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
                                <div class="text-truncate">Lanches e Petiscos</div>
                            </div>
                        </div>
                    </a></div>
                <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
                        <div class="card card-product mb-lg-4">
                            <div class="card-body text-center py-8">
                                <img src="{{ asset('images/category/category-bakery-biscuits.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
                                <div class="text-truncate">Padaria e Biscoitos</div>
                            </div>
                        </div>
                    </a></div>
                <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
                        <div class="card card-product mb-lg-4">
                            <div class="card-body text-center py-8">
                                <img src="{{ asset('images/category/category-instant-food.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
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
                                <img src="{{ asset('images/category/category-atta-rice-dal.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
                                <div class="text-truncate">Atta, Rice & Dal</div>
                            </div>
                        </div>
                    </a></div>

                <div class="item"> <a href="{{ route('store') }}" class="text-decoration-none text-inherit">
                        <div class="card card-product mb-lg-4">
                            <div class="card-body text-center py-8">
                                <img src="{{ asset('images/category/category-baby-care.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
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
                                <img src="{{ asset('images/category/category-pet-care.jpg') }}"
                                    alt="Grocery Ecommerce Template" class="mb-3">
                                <div class="text-truncate">Pet Care</div>
                            </div>
                        </div>
                    </a></div> --}}
            </div>

        </div>
        @endif
    </section>
    <!-- Category Section End-->
    <section>
        <div class="container">
            @if(isset($featuredBanners) && $featuredBanners->count())
                <div class="row">
                    @foreach($featuredBanners as $banner)
                        <div class="col-12 col-md-6 mb-3 mb-lg-0">
                            @if($banner->link_url)
                                <a href="{{ $banner->link_url }}" class="d-block" target="{{ $banner->link_target }}" rel="noopener">
                                    <img src="{{ $banner->image_url ?? asset('images/placeholder.jpg') }}" alt="Banner" class="img-fluid rounded-3 w-100">
                                </a>
                            @else
                                <img src="{{ $banner->image_url ?? asset('images/placeholder.jpg') }}" alt="Banner" class="img-fluid rounded-3 w-100">
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
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
                                style="background:url({{ asset('images/banner/grocery-banner-2.jpg') }})no-repeat; background-size: cover; background-position: center;">
                                <div>
                                    <h3 class="fw-bold mb-1">Pãezinhos Frescos Assados</h3>
                                    <p class="mb-4">Ganhe até <span class="fw-bold">25%</span> de desconto</p>
                                    <a href="#!" class="btn btn-dark">Comprar Agora</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
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
                                    @if($popularProduct->hasActiveSale())
                                    @php
                                    $regularPrice = $popularProduct->regular_price;
                                    $salePrice = $popularProduct->sale_price;
                                    $discountPercentage = round(($regularPrice - $salePrice) / $regularPrice * 100);
                                    @endphp

                                    <span class="badge bg-success">{{ $discountPercentage }}%</span>
                                    @endif
                                </div>
                                <a href="{{ route('product.show', $popularProduct->slug) }}"> <img
                                        src="{{ asset('storage/' . $imagesPopularProduct->first()->image_path) }}"
                                        alt="Image Produto {{ $popularProduct->title }}"
                                        class="mb-4 mt-6 img-fluid"></a>

                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#productViewModal"
                                        onclick="showProductViewModal({{ $popularProduct }})"><i class="bi bi-eye"
                                            data-bs-toggle="tooltip" data-bs-html="true" title="Olhada Rápida"></i></a>
                                    <a href="#!" class="btn-action toggle-favorite" data-bs-toggle="tooltip"
                                        data-bs-html="true" data-product-id="{{ $popularProduct->id }}"
                                        data-favorited="{{ auth()->check() && auth()->user()->favorites()->where('product_id', $popularProduct->id)->exists() ? 'true' : 'false' }}"
                                        title="Lista de Favoritos">
                                        <i
                                            class="bi {{ auth()->check() && auth()->user()->favorites()->where('product_id', $popularProduct->id)->exists() ? 'bi-heart-fill text-success' : 'bi-heart' }}"></i>
                                    </a>


                                    {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Comparar"><i class="bi bi-arrow-left-right"></i></a> --}}
                                </div>

                            </div>
                            <div class="text-small mb-1"><a
                                    href="{{ route('category-products', $categoryPopularProduct->slug) }}"
                                    class="text-decoration-none text-muted"><small>{{
                                        $categoryPopularProduct->name }}</small></a></div>
                            <h2 class="fs-6"><a href="{{ route('product.show', $popularProduct->slug) }}"
                                    class="text-inherit text-decoration-none">{{
                                    $popularProduct->title }}</a></h2>

                            {{-- <div>
                                AVALIAÇÃO
                                <small class="text-warning"> <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i></small> <span
                                    class="text-muted small">4.5(149)</span>
                            </div> --}}
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    @if($popularProduct->hasActiveSale())
                                    <span class="text-dark">{{ 'R$' . number_format($popularProduct->sale_price, 2, ',',
                                        '.') }}</span>
                                    @endif

                                    @if($popularProduct->regular_price > 0)
                                    <span
                                        class="{{ $popularProduct->hasActiveSale() ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                                        {{ 'R$' . number_format($popularProduct->regular_price, 2, ',', '.') }}
                                    </span>
                                    @endif
                                </div>

                                <div>
                                    <form action="{{ route('cart.add-product-to-cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $popularProduct->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
                                    </form>
                                </div>
                            </div>
                            @include('front.partials.product-countdown', ['product' => $popularProduct, 'class' => 'text-danger small mt-2'])
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
                        @if(isset($dealBanner) && $dealBanner)
                            @if($dealBanner->link_url)
                                <a href="{{ $dealBanner->link_url }}" class="d-block pt-8 px-6 px-xl-8 rounded text-white text-decoration-none"
                                    target="{{ $dealBanner->link_target }}" rel="noopener"
                                    style="background:url({{ $dealBanner->image_url ?? asset('images/placeholder.jpg') }})no-repeat; background-size: cover; height: 470px;">
                                    <span class="visually-hidden">Banner</span>
                                </a>
                            @else
                                <div class="pt-8 px-6 px-xl-8 rounded"
                                    style="background:url({{ $dealBanner->image_url ?? asset('images/placeholder.jpg') }})no-repeat; background-size: cover; height: 470px;">
                                    <span class="visually-hidden">Banner</span>
                                </div>
                            @endif
                        @else
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
                        @endif
                    </div>

                    @forelse ($topSellingProducts as $topSellingProduct)
                    @php
                    $categoryTopProduct = $topSellingProduct->category;
                    $imagesTopProduct = $topSellingProduct->productImages;
                    @endphp
                    <div class="col">
                        <div class="card card-product">
                            <div class="card-body">
                                <div class="text-center  position-relative "> <a
                                        href="{{ route('product.show', $topSellingProduct->slug) }}"><img
                                            src="{{ asset('storage/' .$imagesTopProduct->first()->image_path) }}"
                                            alt="Grocery Ecommerce Template" class="mb-3 img-fluid"></a>

                                    <div class="card-product-action">
                                        <a href="{{ route('product.show', $topSellingProduct->slug) }}"
                                            class="btn-action" data-bs-toggle="modal" data-bs-target="#productViewModal"
                                            onclick="showProductViewModal({{ $topSellingProduct }})"><i
                                                class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                title="Olhada Rápida"></i></a>
                                        <!-- Favoritos -->
                                        <a href="#!" class="btn-action toggle-favorite" data-bs-toggle="tooltip"
                                            data-bs-html="true" data-product-id="{{ $topSellingProduct->id }}"
                                            data-favorited="{{ auth()->check() && auth()->user()->favorites()->where('product_id', $topSellingProduct->id)->exists() ? 'true' : 'false' }}"
                                            title="Lista de Favoritos">
                                            <i
                                                class="bi {{ auth()->check() && auth()->user()->favorites()->where('product_id', $topSellingProduct->id)->exists() ? 'bi-heart-fill text-success' : 'bi-heart' }}"></i>
                                        </a>
                                        {{-- <a href="#!" class="btn-action" data-bs-toggle="tooltip"
                                            data-bs-html="true" title="Comparar"><i
                                                class="bi bi-arrow-left-right"></i></a> --}}
                                    </div>
                                </div>
                                <div class="text-small mb-1"><a
                                        href="{{ route('category-products', $categoryTopProduct->slug) }}"
                                        class="text-decoration-none text-muted"><small>{{
                                            $categoryTopProduct->name }}</small></a></div>
                                <h2 class="fs-6"><a href="{{ route('product.show', $topSellingProduct->slug) }}"
                                        class="text-inherit text-decoration-none">{{
                                        $topSellingProduct->title }}</a></h2>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        @if ($topSellingProduct->hasActiveSale())
                                        <span class="text-dark">{{ 'R$' . number_format($topSellingProduct->sale_price,
                                            2, ',', '.')
                                            }}</span>
                                        @endif
                                        <span
                                            class="{{ $topSellingProduct->hasActiveSale() ? 'text-decoration-line-through text-muted' : 'text-dark' }}">{{
                                            'R$' . number_format($topSellingProduct->regular_price, 2, ',', '.')
                                            }}</span>
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
                                    <form action="{{ route('cart.add-product-to-cart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $topSellingProduct->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary ">Adicionar ao carrinho </button>
                                    </form>
                                </div>
                                @if($topSellingProduct->hasActiveSale())
                                <div class="d-flex justify-content-start text-center mt-3">
                                    <div class="deals-countdown w-100" data-countdown="{{ $topSellingProduct->sale_end_date->format('Y/m/d H:i:s') }}"></div>
                                </div>
                                @endif
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
                        <p>Faça com que seu pedido seja entregue à sua porta o mais rápido possível nas lojas de coleta
                            FreshCart
                            perto de você.</p>
                    </div>
                </div>
                <div class="col-md-6  col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6"><img src="{{ asset('images/icons/gift.svg') }}" alt=""></div>
                        <h3 class="h5 mb-3">Melhores preços e ofertas</h3>
                        <p>Preços mais baratos do que o supermercado local, ótimas ofertas de reembolso para completar.
                            Obtenha os
                            melhores preços e ofertas.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6"><img src="{{ asset('images/icons/package.svg') }}" alt=""></div>
                        <h3 class="h5 mb-3">Ampla variedade</h3>
                        <p>Escolha entre mais de 5.000 produtos em alimentos, cuidados pessoais, casa, padaria, vegetais
                            e não
                            vegetais e outras categorias.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6"><img src="{{ asset('images/icons/refresh-cw.svg') }}" alt=""></div>
                        <h3 class="h5 mb-3">Devoluções fáceis</h3>
                        <p>Não está satisfeito com um produto? Devolva-o na porta e receba um reembolso em poucas horas.
                            Sem
                            perguntas sobre política.
                            <a href="#!">política</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.partials.product-view-modal')

</main>

@endsection

@section('footer')

<script src="{{ asset('js/vendors/countdown.js') }}"></script>
<script src="{{ asset('libs/slick-carousel/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/vendors/slick-slider.js') }}"></script>
<script src="{{ asset('libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
{{-- <script src="{{ asset('js/vendors/tns-slider.js') }}"></script> --}}
<script src="{{ asset('js/vendors/increment-value.js') }}"></script>
<script src="{{ asset('js/vendors/zoom.js') }}"></script>

<script>
    $(document).ready(function() {
    $('.toggle-favorite').on('click', function(e) {
        e.preventDefault();

        let $this = $(this);
        let productId = $this.data('product-id');
        let favorited = $this.data('favorited');
        let icon = $this.find('i');

        let url = favorited ? `/favoritos/remove/${productId}` : `/favoritos/add/${productId}`;

        $.ajax({
            url: url,
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    $this.data('favorited', !favorited);

                    if (!favorited) {
                        icon.removeClass('bi-heart').addClass('bi-heart-fill text-success');
                    } else {
                        icon.removeClass('bi-heart-fill text-success').addClass('bi-heart');
                    }
                    location.reload();
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    window.location.href = "{{ route('login') }}";
                } else {
                    console.error('Erro ao adicionar/remover favorito:', xhr);
                }
            }
        });
    });
});


</script>

@endsection

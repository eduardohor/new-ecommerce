<style>
    #search-results {
        position: absolute;
        z-index: 1000;
        background-color: white;
        width: 100%;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 300px;
        overflow-y: auto;
        display: none;
        border-radius: 8px;

    }

    .product-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item:hover {
        background-color: #f1f1f1;
    }
</style>



<header>
    <div class="border-bottom ">
        <div class="py-5">
            <div class="container">
                <div class="row w-100 align-items-center gx-lg-2 gx-0">
                    <div class="col-xxl-2 col-lg-3">
                        <a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
                            <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
                                alt="Logo">
                        </a>
                        <div class="d-flex justify-content-between w-100 d-lg-none">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
                                    alt="Logo">
                            </a>

                            <div class="d-flex align-items-center lh-1">

                                <div class="list-inline me-4">
                                    @auth
                                    <div class="list-inline-item">

                                        <a href="#" class="text-muted dropdown-toggle" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('orders.index.customer') }}">Pedidos</a></li>
                                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Sair</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @endauth
                                    @guest
                                    <div class="list-inline-item">

                                        <a href="{{ route('login') }}" class="text-muted">
                                            Entrar
                                        </a>
                                    </div>
                                    @endguest
                                    <div class="list-inline-item">

                                        <a class="text-muted position-relative " data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight" href="#offcanvasExample" role="button"
                                            aria-controls="offcanvasRight">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-shopping-bag">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6">
                                                </line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                1
                                                <span class="visually-hidden">Mensagens não lidas</span>
                                            </span>
                                        </a>
                                    </div>

                                </div>
                                <!-- Button -->
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#navbar-default" aria-controls="navbar-default"
                                    aria-label="Toggle navigation">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                        class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                                        <path
                                            d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </button>

                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-5 col-lg-5 d-none d-lg-block position-relative">
                        <form id="search-form" action="#">
                            <div class="input-group">
                                <input id="search-input" class="form-control rounded" type="search"
                                    placeholder="Pesquisar produtos">
                                <span class="input-group-append">
                                    <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <div id="search-results" class="mt-3"></div>
                    </div>

                    <div class="col-md-2 col-xxl-3 d-none d-lg-block">
                        {{--
                        <!-- Button trigger modal -->
                        <button type="button" class="btn  btn-outline-gray-400 text-muted" data-bs-toggle="modal"
                            data-bs-target="#locationModal">
                            <i class="feather-icon icon-map-pin me-2"></i>Localização
                        </button> --}}


                    </div>
                    <div class="col-md-2 col-xxl-2 text-end d-none d-lg-block">

                        <div class="list-inline">
                            @auth
                            <div class="list-inline-item">
                                <a href="#" class="text-muted dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('orders.index.customer') }}">Pedidos</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item" type="submit">Sair</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endauth
                            @guest
                            <div class="list-inline-item  ">
                                <a href="{{ route('login') }}" class="text-muted">
                                    Entrar
                                </a>
                            </div>
                            @endguest
                            <div class="list-inline-item me-5">

                                <a href="{{ route('wishlist') }}" class="text-muted position-relative">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-heart">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        {{ $favoritesProvider }}

                                        {{-- <span class="visually-hidden">mensagens não lidas</span> --}}
                                    </span>
                                </a>
                            </div>
                            <div class="list-inline-item">

                                <a class="text-muted position-relative " href="{{ route('cart.show') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>

                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        {{ $cartProvider ? $cartProvider->item_count : 0}}
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4 "
            aria-label="Offcanvas navbar large">
            <div class="container">


                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default"
                    aria-labelledby="navbar-defaultLabel">
                    <div class="offcanvas-header pb-1">
                        <a href="{{ route('home') }}">
                            <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
                                alt="Logo">
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="d-block d-lg-none mb-4">
                            <form action="#">
                                <div class="input-group ">
                                    <input class="form-control rounded" type="search" placeholder="Pesquisar Produtos">
                                    <span class="input-group-append">
                                        <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                </line>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <div class="mt-2">
                                {{-- <button type="button" class="btn  btn-outline-gray-400 text-muted w-100 "
                                    data-bs-toggle="modal" data-bs-target="#locationModal">
                                    <i class="feather-icon icon-map-pin me-2"></i>Escolha o Local
                                </button> --}}
                            </div>
                        </div>
                        <div class="d-block d-lg-none mb-4">
                            <a class="btn btn-primary w-100 d-flex justify-content-center align-items-center"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                aria-controls="collapseExample">
                                <span class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg></span> Todos os departamentos
                            </a>
                            <div class="collapse mt-2" id="collapseExample">
                                <div class="card card-body">
                                    <ul class="mb-0 list-unstyled">
                                        @forelse ($categoriesProvider as $categoryProvider)
                                        <li><a class="dropdown-item text-primary"
                                                href="{{ route('category-products', ['slug' => $categoryProvider->slug]) }}">{{
                                                $categoryProvider->name
                                                }}</a>
                                            @if ($categoryProvider->children)
                                            <ul class="mb-0 ms-2 list-unstyled">
                                                @foreach ($categoryProvider->children as $child)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('category-products', ['slug' => $child->slug]) }}">{{
                                                        $child->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @empty
                                        <li><a class="dropdown-item" href="#">Aguandando
                                                Categorias...</a></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown me-3 d-none d-lg-block">
                            <button class="btn btn-primary px-6 " type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-grid">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg></span> Todos os departamentos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @forelse ($categoriesProvider as $categoryProvider)
                                <li><a class="dropdown-item text-primary"
                                        href="{{ route('category-products', ['slug' => $categoryProvider->slug]) }}">{{
                                        $categoryProvider->name
                                        }}</a>
                                    @if ($categoryProvider->children)
                                    <ul class="mb-0 ms-2 list-unstyled">
                                        @foreach ($categoryProvider->children as $child)
                                        <li><a class="dropdown-item"
                                                href="{{ route('category-products', ['slug' => $child->slug]) }}">{{
                                                $child->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @empty
                                <li><a class="dropdown-item" href="#">Aguandando
                                        Categorias...</a></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="">
                            <ul class="navbar-nav align-items-center ">
                                <li class="nav-item dropdown w-100 w-lg-auto">
                                    <a class="nav-link" href="{{ route('home') }}" aria-expanded="false">
                                        Início
                                    </a>
                                    {{-- <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./index.html">Home 1</a></li>
                                        <li><a class="dropdown-item" href="./pages/index-2.html">Home 2</a></li>
                                        <li><a class="dropdown-item" href="./pages/index-3.html">Home 3</a></li>
                                        <li><a class="dropdown-item" href="./pages/index-4.html">Home 4</a></li>
                                        <li><a class="dropdown-item" href="./pages/index-5.html">Home 5 <span
                                                    class="badge bg-light-info text-dark-info ms-1">New</span></a></li>
                                    </ul> --}}
                                </li>
                                <li class="nav-item dropdown w-100 w-lg-auto">
                                    <a class="nav-link" href="{{ route('store') }}" aria-expanded="false">
                                        Loja
                                    </a>
                                    {{-- <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Shop Grid -
                                                Filter</a></li>
                                        <li><a class="dropdown-item" href="./pages/shop-grid-3-column.html">Shop Grid -
                                                3 column</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/shop-list.html">Shop List -
                                                Filter</a></li>
                                        <li><a class="dropdown-item" href="./pages/shop-filter.html">Shop - Filter</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/shop-fullwidth.html">Shop Wide</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/shop-single.html">Shop Single</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/shop-single-2.html">Shop Single
                                                v2</a></li>
                                        <li><a class="dropdown-item" href="./pages/shop-wishlist.html">Shop Wishlist</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/shop-cart.html">Shop Cart</a></li>
                                        <li><a class="dropdown-item" href="./pages/shop-checkout.html">Shop Checkout</a>
                                        </li>
                                    </ul> --}}
                                </li>
                                {{-- <li class="nav-item dropdown w-100 w-lg-auto">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Lojas
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./pages/store-list.html">Store List</a></li>
                                        <li><a class="dropdown-item" href="./pages/store-grid.html">Store Grid</a></li>
                                        <li><a class="dropdown-item" href="./pages/store-single.html">Store Single</a>
                                        </li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="nav-item dropdown w-100 w-lg-auto dropdown-fullwidth">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Mega menu
                                    </a>
                                    <div class=" dropdown-menu pb-0">
                                        <div class="row p-2 p-lg-4">
                                            <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                                <h6 class="text-primary ps-3">Dairy, Bread & Eggs</h6>
                                                <a class="dropdown-item" href="#">Butter</a>
                                                <a class="dropdown-item" href="#">Milk Drinks</a>
                                                <a class="dropdown-item" href="#">Curd & Yogurt</a>
                                                <a class="dropdown-item" href="#">Eggs</a>
                                                <a class="dropdown-item" href="#">Buns & Bakery</a>
                                                <a class="dropdown-item" href="#">Cheese</a>
                                                <a class="dropdown-item" href="#">Condensed
                                                    Milk</a>
                                                <a class="dropdown-item" href="#">Dairy
                                                    Products</a>
                                            </div>
                                            <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                                <h6 class="text-primary ps-3">Breakfast & Instant Food</h6>
                                                <a class="dropdown-item" href="#">Breakfast
                                                    Cereal</a>
                                                <a class="dropdown-item" href="#"> Noodles, Pasta &
                                                    Soup</a>
                                                <a class="dropdown-item" href="#">Frozen Veg
                                                    Snacks</a>
                                                <a class="dropdown-item" href="#"> Frozen Non-Veg
                                                    Snacks</a>
                                                <a class="dropdown-item" href="#"> Vermicelli</a>
                                                <a class="dropdown-item" href="#"> Instant
                                                    Mixes</a>
                                                <a class="dropdown-item" href="#"> Batter</a>
                                                <a class="dropdown-item" href="#"> Fruit and
                                                    Juices</a>
                                            </div>
                                            <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                                <h6 class="text-primary ps-3">Cold Drinks & Juices</h6>
                                                <a class="dropdown-item" href="#">Soft Drinks</a>
                                                <a class="dropdown-item" href="#">Fruit Juices</a>
                                                <a class="dropdown-item" href="#">Coldpress</a>
                                                <a class="dropdown-item" href="#">Water & Ice
                                                    Cubes</a>
                                                <a class="dropdown-item" href="#">Soda & Mixers</a>
                                                <a class="dropdown-item" href="#">Health Drinks</a>
                                                <a class="dropdown-item" href="#">Herbal Drinks</a>
                                                <a class="dropdown-item" href="#">Milk Drinks</a>
                                            </div>
                                            <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                                                <div class="card border-0">
                                                    <img src="{{ asset('images/banner/menu-banner.jpg') }}"
                                                        alt="eCommerce HTML Template" class="img-fluid">
                                                    <div class="position-absolute ps-6 mt-8">
                                                        <h5 class=" mb-0 ">Dont miss this <br>offer today.</h5>
                                                        <a href="#" class="btn btn-primary btn-sm mt-3">Comprar
                                                            Agora</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li class="nav-item dropdown w-100 w-lg-auto">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Páginas
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./pages/blog.html">Blog</a></li>
                                        <li><a class="dropdown-item" href="./pages/blog-single.html">Blog Single</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/blog-category.html">Blog Category</a>
                                        </li>
                                        <li><a class="dropdown-item" href="./pages/about.html">About us</a></li>
                                        <li><a class="dropdown-item" href="./pages/404error.html">404 Error</a></li>
                                        <li><a class="dropdown-item" href="./pages/contact.html">Contact</a></li>
                                    </ul>
                                </li> --}}
                                {{-- <li class="nav-item dropdown w-100 w-lg-auto">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Conta
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./pages/signin.html">Sign in</a></li>
                                        <li><a class="dropdown-item" href="./pages/signup.html">Signup</a></li>
                                        <li><a class="dropdown-item" href="./pages/forgot-password.html">Forgot
                                                Password</a></li>
                                        <li class="dropdown-submenu dropend">
                                            <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                                                My Account
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="./pages/account-orders.html">Orders</a></li>
                                                <li><a class="dropdown-item"
                                                        href="./pages/account-settings.html">Settings</a></li>
                                                <li><a class="dropdown-item"
                                                        href="./pages/account-address.html">Address</a></li>
                                                <li><a class="dropdown-item"
                                                        href="./pages/account-payment-method.html">Payment Method</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="./pages/account-notification.html">Notification</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> --}}
                                @auth
                                @if (auth()->user()->is_admin == 1)
                                <li class="nav-item w-100 w-lg-auto">
                                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                                        Painel
                                    </a>
                                </li>
                                @endif
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Cadastre-se</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Digite seu nome"
                                required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" placeholder="Digite seu e-mail"
                                required="">
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" placeholder="Digite sua senha"
                                required="">
                            <small class="form-text">Ao se cadastrar, você concorda com nossos <a href="#!">Termos de
                                    Serviço</a> & <a href="#!">Política de
                                    Privacidade</a></small>
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">

                    Já possui uma conta ? <a href="{{ route('login') }}">Entrar</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Shop Cart -->

    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <div class="text-start">
                <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Carrinho de Compras</h5>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="">
                <!-- alert -->
                <div class="alert alert-danger p-2" role="alert">
                    Você tem entrega GRATUITA. Comece a finalizar a <a href="#!" class="alert-link">compra
                        agora!</a>
                </div>
                <ul class="list-group list-group-flush">
                    <!-- list group -->
                    <li class="list-group-item py-3 ps-0 border-top">
                        <!-- row -->
                        <div class="row align-items-center">

                            <div class="col-6 col-md-6 col-lg-7">
                                <div class="d-flex">
                                    <img src="{{ asset('images/products/product-img-1.jpg') }}" alt="Ecommerce"
                                        class="icon-shape icon-xxl">
                                    <div class="ms-3">
                                        <!-- title -->
                                        <a href="./pages/shop-single.html" class="text-inherit">
                                            <h6 class="mb-0">Haldiram's Sev Bhujia</h6>
                                        </a>
                                        <span><small class="text-muted">.98 / lb</small></span>
                                        <!-- text -->
                                        <div class="mt-2 small lh-1"> <a href="#!"
                                                class="text-decoration-none text-inherit"> <span
                                                    class="me-1 align-text-bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-success">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg></span><span class="text-muted">Remover</span></a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- input group -->
                            <div class="col-4 col-md-3 col-lg-3">
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" min="1" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>

                            </div>
                            <!-- price -->
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold">$5.00</span>

                            </div>
                        </div>

                    </li>
                    <!-- list group -->
                    <li class="list-group-item py-3 ps-0">
                        <!-- row -->
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6 col-lg-7">
                                <div class="d-flex">
                                    <img src="{{ asset('images/products/product-img-2.jpg') }}" alt="Ecommerce"
                                        class="icon-shape icon-xxl">
                                    <div class="ms-3">
                                        <a href="./pages/shop-single.html" class="text-inherit">
                                            <h6 class="mb-0">NutriChoice Digestive </h6>
                                        </a>
                                        <span><small class="text-muted">250g</small></span>
                                        <!-- text -->
                                        <div class="mt-2 small lh-1"> <a href="#!"
                                                class="text-decoration-none text-inherit"> <span
                                                    class="me-1 align-text-bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-success">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg></span><span class="text-muted">Remover</span></a></div>
                                    </div>
                                </div>
                            </div>


                            <!-- input group -->
                            <div class="col-4 col-md-3 col-lg-3">
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" min="1" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>
                            </div>
                            <!-- price -->
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold text-danger">$20.00</span>
                                <div class="text-decoration-line-through text-muted small">$26.00</div>
                            </div>
                        </div>

                    </li>
                    <!-- list group -->
                    <li class="list-group-item py-3 ps-0">
                        <!-- row -->
                        <div class="row align-items-center">

                            <div class="col-6 col-md-6 col-lg-7">
                                <div class="d-flex">
                                    <img src="{{ asset('images/products/product-img-3.jpg') }}" alt="Ecommerce"
                                        class="icon-shape icon-xxl">
                                    <div class="ms-3">
                                        <!-- title -->
                                        <a href="./pages/shop-single.html" class="text-inherit">
                                            <h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
                                        </a>
                                        <span><small class="text-muted">1 kg</small></span>
                                        <!-- text -->
                                        <div class="mt-2 small lh-1"> <a href="#!"
                                                class="text-decoration-none text-inherit"> <span
                                                    class="me-1 align-text-bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-success">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg></span><span class="text-muted">Remover</span></a></div>
                                    </div>
                                </div>
                            </div>

                            <!-- input group -->
                            <div class="col-4 col-md-3 col-lg-3">
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" min="1" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>
                            </div>
                            <!-- price -->
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold">$15.00</span>
                                <div class="text-decoration-line-through text-muted small">$20.00</div>
                            </div>
                        </div>

                    </li>
                    <!-- list group -->
                    <li class="list-group-item py-3 ps-0">
                        <!-- row -->
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6 col-lg-7">
                                <div class="d-flex">
                                    <img src="{{ asset('images/products/product-img-4.jpg') }}" alt="Ecommerce"
                                        class="icon-shape icon-xxl">
                                    <div class="ms-3">
                                        <!-- title -->
                                        <!-- title -->
                                        <a href="./pages/shop-single.html" class="text-inherit">
                                            <h6 class="mb-0">Onion Flavour Potato</h6>
                                        </a>
                                        <span><small class="text-muted">250g</small></span>
                                        <!-- text -->
                                        <div class="mt-2 small lh-1"> <a href="#!"
                                                class="text-decoration-none text-inherit"> <span
                                                    class="me-1 align-text-bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-success">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg></span><span class="text-muted">Remover</span></a></div>
                                    </div>
                                </div>
                            </div>

                            <!-- input group -->
                            <div class="col-4 col-md-3 col-lg-3">
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" min="1" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>
                            </div>
                            <!-- price -->
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold">$15.00</span>
                                <div class="text-decoration-line-through text-muted small">$20.00</div>
                            </div>
                        </div>

                    </li>
                    <!-- list group -->
                    <li class="list-group-item py-3 ps-0 border-bottom">
                        <!-- row -->
                        <div class="row align-items-center">
                            <div class="col-6 col-md-6 col-lg-7">
                                <div class="d-flex">
                                    <img src="{{ asset('images/products/product-img-5.jpg') }}" alt="Ecommerce"
                                        class="icon-shape icon-xxl">
                                    <div class="ms-3">
                                        <!-- title -->
                                        <a href="./pages/shop-single.html" class="text-inherit">
                                            <h6 class="mb-0">Salted Instant Popcorn </h6>
                                        </a>
                                        <span><small class="text-muted">100g</small></span>
                                        <!-- text -->
                                        <div class="mt-2 small lh-1"> <a href="#!"
                                                class="text-decoration-none text-inherit"> <span
                                                    class="me-1 align-text-bottom">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 text-success">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg></span><span class="text-muted">Remover</span></a></div>
                                    </div>
                                </div>
                            </div>

                            <!-- input group -->
                            <div class="col-4 col-md-3 col-lg-3">
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner  ">
                                    <input type="button" value="-" class="button-minus  btn  btn-sm "
                                        data-field="quantity">
                                    <input type="number" min="1" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input   ">
                                    <input type="button" value="+" class="button-plus btn btn-sm "
                                        data-field="quantity">
                                </div>
                            </div>
                            <!-- price -->
                            <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                <span class="fw-bold">$15.00</span>
                                <div class="text-decoration-line-through text-muted small">$25.00</div>
                            </div>
                        </div>

                    </li>

                </ul>
                <!-- btn -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="#!" class="btn btn-primary">Continue Comprando</a>
                    <a href="#!" class="btn btn-dark">Atualizar Carrinho</a>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body p-6">
                    <div class="d-flex justify-content-between align-items-start ">
                        <div>
                            <h5 class="mb-1" id="locationModalLabel">Escolha o seu Local de Entrega</h5>
                            <p class="mb-0 small">Digite seu endereço e especificaremos a área de oferta para você.
                            </p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="my-5">
                        <input type="search" class="form-control" placeholder="Pesquise sua área">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Selecione o Local</h6>
                        <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Limpar Tudo</a>


                    </div>
                    <div>
                        <div data-simplebar style="height:300px;">
                            <div class="list-group list-group-flush">

                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">
                                    <span>Alabama</span><span>Min:$20</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Alaska</span><span>Min:$30</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Arizona</span><span>Min:$50</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>California</span><span>Min:$29</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Colorado</span><span>Min:$80</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Florida</span><span>Min:$90</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Arizona</span><span>Min:$50</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>California</span><span>Min:$29</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Colorado</span><span>Min:$80</span></a>
                                <a href="#"
                                    class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                    <span>Florida</span><span>Min:$90</span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</header>

<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
    $('#search-input').on('input', function() {
        var query = $(this).val();
        console.log(query)

        if (query.length >= 3) {
            $.ajax({
                url: "{{ route('product.search') }}",
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    $('#search-results').empty().show();;

                    if (data.length > 0) {
                        $.each(data, function(index, product) {
                            var imageUrl = product.product_images.length > 0
                                            ? "{{ asset('storage/') }}" + '/' + product.product_images[0].image_path
                                            : '';

                            var productItem = `
                                <a href="/produto/${product.slug}" class="product-item" style="display: flex; align-items: center; margin-bottom: 10px;">
                                    ${imageUrl ? `<img src="${imageUrl}" alt="${product.title}" style="width: 50px; height: 50px; margin-right: 10px; border-radius: 5px;">` : ''}
                                    <h5 style="margin: 0;">${product.title}</h5>
                                </a>
                            `;

                            $('#search-results').append(productItem);
                        });
                    } else {
                        $('#search-results').html('<p class="product-item">Nenhum produto encontrado.</p>');
                    }
                }
            });
        } else {
            $('#search-results').hide();
        }
    });
});


</script>

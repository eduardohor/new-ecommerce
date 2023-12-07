<header>
  <div class="border-bottom ">
    <div class="py-5">
      <div class="container">
        <div class="row w-100 align-items-center gx-lg-2 gx-0">
          <div class="col-xxl-2 col-lg-3">
            <a class="navbar-brand d-none d-lg-block" href="{{ route('home') }}">
              <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="eCommerce HTML Template">

            </a>
            <div class="d-flex justify-content-between w-100 d-lg-none">
              <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="eCommerce HTML Template">

              </a>

              <div class="d-flex align-items-center lh-1">

                <div class="list-inline me-4">
                  <div class="list-inline-item">

                    <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                      </svg>
                    </a>
                  </div>
                  <div class="list-inline-item">

                    <a class="text-muted position-relative " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                      href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-shopping-bag">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                      </svg>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        1
                        <span class="visually-hidden">mensagens não lidas</span>
                      </span>
                    </a>
                  </div>

                </div>
                <!-- Button -->
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-label="Toggle navigation">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                    <path
                      d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                  </svg>
                </button>

              </div>
            </div>

          </div>
          <div class="col-xxl-5 col-lg-5 d-none d-lg-block">

            <form action="#">
              <div class="input-group ">
                <input class="form-control rounded" type="search" placeholder="Pesquisar produtos">
                <span class="input-group-append">
                  <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-search">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                  </button>
                </span>
              </div>

            </form>
          </div>
          <div class="col-md-2 col-xxl-3 d-none d-lg-block">
            <!-- Button trigger modal -->
            <button type="button" class="btn  btn-outline-gray-400 text-muted" data-bs-toggle="modal"
              data-bs-target="#locationModal">
              <i class="feather-icon icon-map-pin me-2"></i>Localização
            </button>


          </div>
          <div class="col-md-2 col-xxl-2 text-end d-none d-lg-block">

            <div class="list-inline">
              <div class="list-inline-item me-5">

                <a href="./pages/shop-wishlist.html" class="text-muted position-relative">

                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-heart">
                    <path
                      d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                    </path>
                  </svg>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    5
                    <span class="visually-hidden">mensagens não lidas</span>
                  </span>
                </a></div>
              <div class="list-inline-item me-5">

                <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </a></div>
              <div class="list-inline-item">

                <a class="text-muted position-relative " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                  href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-shopping-bag">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                  </svg>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    1
                    <span class="visually-hidden">mensagens não lidas</span>
                  </span>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4 " aria-label="Offcanvas navbar large">
      <div class="container">


        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
          <div class="offcanvas-header pb-1">
            <a href="./index.html"><img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="eCommerce HTML Template"></a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="d-block d-lg-none mb-4">
              <form action="#">
                <div class="input-group ">
                  <input class="form-control rounded" type="search" placeholder="Search for products">
                  <span class="input-group-append">
                    <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </span>
                </div>
              </form>
              <div class="mt-2">
                <button type="button" class="btn  btn-outline-gray-400 text-muted w-100 " data-bs-toggle="modal"
                  data-bs-target="#locationModal">
                  <i class="feather-icon icon-map-pin me-2"></i>Escolha o Local
                </button>
              </div>
            </div>
            <div class="d-block d-lg-none mb-4">
              <a class="btn btn-primary w-100 d-flex justify-content-center align-items-center" data-bs-toggle="collapse"
                href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="me-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-grid">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                  </svg></span> Todos os departamentos
              </a>
              <div class="collapse mt-2" id="collapseExample">
                <div class="card card-body">
                  <ul class="mb-0 list-unstyled">
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Dairy, Bread & Eggs</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Snacks & Munchies</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Fruits & Vegetables</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Cold Drinks & Juices</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Breakfast & Instant Food</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Bakery & Biscuits</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Chicken, Meat & Fish</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="dropdown me-3 d-none d-lg-block">
              <button class="btn btn-primary px-6 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="me-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-grid">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                  </svg></span> Todos os departamentos
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Dairy, Bread & Eggs</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Snacks & Munchies</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Fruits & Vegetables</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Cold Drinks & Juices</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Breakfast & Instant Food</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Bakery & Biscuits</a></li>
                <li><a class="dropdown-item" href="./pages/shop-grid.html">Chicken, Meat & Fish</a></li>
              </ul>
            </div>
            <div class="">
              <ul class="navbar-nav align-items-center ">
                <li class="nav-item dropdown w-100 w-lg-auto">
                  <a class="nav-link" href="{{ route('home') }}"
                    aria-expanded="false">
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
                  <a class="nav-link" href="{{ route('store') }}"
                    aria-expanded="false">
                    Loja
                  </a>
                  {{-- <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./pages/shop-grid.html">Shop Grid - Filter</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-grid-3-column.html">Shop Grid - 3 column</a>
                    </li>
                    <li><a class="dropdown-item" href="./pages/shop-list.html">Shop List - Filter</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-filter.html">Shop - Filter</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-fullwidth.html">Shop Wide</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-single.html">Shop Single</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-single-2.html">Shop Single v2</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-wishlist.html">Shop Wishlist</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-cart.html">Shop Cart</a></li>
                    <li><a class="dropdown-item" href="./pages/shop-checkout.html">Shop Checkout</a></li>
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
                    <li><a class="dropdown-item" href="./pages/store-single.html">Store Single</a></li>
                  </ul>
                </li> --}}
                <li class="nav-item dropdown w-100 w-lg-auto dropdown-fullwidth">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Mega menu
                  </a>
                  <div class=" dropdown-menu pb-0">
                    <div class="row p-2 p-lg-4">
                      <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                        <h6 class="text-primary ps-3">Dairy, Bread & Eggs</h6>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Butter</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Milk Drinks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Curd & Yogurt</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Eggs</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Buns & Bakery</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Cheese</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Condensed Milk</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Dairy Products</a>
                      </div>
                      <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                        <h6 class="text-primary ps-3">Breakfast & Instant Food</h6>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Breakfast Cereal</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Noodles, Pasta & Soup</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Frozen Veg Snacks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Frozen Non-Veg Snacks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Vermicelli</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Instant Mixes</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Batter</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html"> Fruit and Juices</a>
                      </div>
                      <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                        <h6 class="text-primary ps-3">Cold Drinks & Juices</h6>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Soft Drinks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Fruit Juices</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Coldpress</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Water & Ice Cubes</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Soda & Mixers</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Health Drinks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Herbal Drinks</a>
                        <a class="dropdown-item" href="./pages/shop-grid.html">Milk Drinks</a>
                      </div>
                      <div class="col-lg-3 col-12 mb-4 mb-lg-0">
                        <div class="card border-0">
                          <img src="{{ asset('images/banner/menu-banner.jpg') }}" alt="eCommerce HTML Template"
                            class="img-fluid">
                          <div class="position-absolute ps-6 mt-8">
                            <h5 class=" mb-0 ">Dont miss this <br>offer today.</h5>
                            <a href="#" class="btn btn-primary btn-sm mt-3">Comprar Agora</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                {{-- <li class="nav-item dropdown w-100 w-lg-auto">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Páginas
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./pages/blog.html">Blog</a></li>
                    <li><a class="dropdown-item" href="./pages/blog-single.html">Blog Single</a></li>
                    <li><a class="dropdown-item" href="./pages/blog-category.html">Blog Category</a></li>
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
                    <li><a class="dropdown-item" href="./pages/forgot-password.html">Forgot Password</a></li>
                    <li class="dropdown-submenu dropend">
                      <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                        My Account
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./pages/account-orders.html">Orders</a></li>
                        <li><a class="dropdown-item" href="./pages/account-settings.html">Settings</a></li>
                        <li><a class="dropdown-item" href="./pages/account-address.html">Address</a></li>
                        <li><a class="dropdown-item" href="./pages/account-payment-method.html">Payment Method</a>
                        </li>
                        <li><a class="dropdown-item" href="./pages/account-notification.html">Notification</a></li>
                      </ul>
                    </li>
                  </ul>
                </li> --}}
                <li class="nav-item w-100 w-lg-auto">
                  <a class="nav-link" href="./dashboard/index.html">
                    Painel
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>

</header>
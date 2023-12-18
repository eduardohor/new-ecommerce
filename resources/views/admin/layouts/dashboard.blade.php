<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>@yield('title')</title>
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">

  <!-- Libs CSS -->
  <link href="{{ asset('libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
  <!-- Google tag (gtag.js) -->

  <!-- End Tag -->

  @yield('links')

</head>

<body>
  <!-- main -->
  <div>
    <nav class="navbar navbar-expand-lg navbar-glass">
      <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
          <div class="d-flex align-items-center">

            <a class="text-inherit d-block d-xl-none me-4" data-bs-toggle="offcanvas" href="#offcanvasExample"
              role="button" aria-controls="offcanvasExample">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                class="bi bi-text-indent-right" viewBox="0 0 16 16">
                <path
                  d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm10.646 2.146a.5.5 0 0 1 .708.708L11.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zM2 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
              </svg>
            </a>

            <form role="search">
              <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Search">

            </form>
          </div>
          <div>
            <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
              {{-- Noficication --}}
              {{-- <li class="dropdown-center ">
                <a class="position-relative btn-icon btn-ghost-secondary btn rounded-circle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-bell fs-5"></i>
                  <span
                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                    2
                    <span class="visually-hidden">mensagens não lidas</span>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0 border-0 ">
                  <div class="border-bottom p-5 d-flex
                   justify-content-between align-items-center">
                    <div>
                      <h5 class="mb-1">Notificações</h5>
                      <p class="mb-0 small">Você tem 2 mensagens não lidas</p>
                    </div>
                    <a href="#!" class="text-muted">
                      <a href="#" class="btn btn-ghost-secondary btn-icon rounded-circle" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="Mark all as read">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                          class="bi bi-check2-all text-success" viewBox="0 0 16 16">
                          <path
                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                          <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                        </svg>
                      </a>
                    </a>
                  </div>
                  <div data-simplebar style="height: 250px;">
                    <!-- List group -->
                    <ul class="list-group list-group-flush notification-list-scroll fs-6">
                      <!-- List group item -->
                      <li class="list-group-item px-5 py-4 list-group-item-action active">
                        <a href="#!" class="text-muted">
                          <div class="d-flex">
                            <img src="{{ asset('images/avatar/avatar-1.jpg') }}" alt=""
                              class="avatar avatar-md rounded-circle ">
                            <div class="ms-4">
                              <p class="mb-1">
                                <span class="text-dark">Seu pedido foi feito</span> aguardando envio
                              </p>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                  class="bi bi-clock text-muted" viewBox="0 0 16 16">
                                  <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                </svg><small class="ms-2">1 minuto atrás</small></span>
                            </div>
                          </div>
                        </a>



                      </li>
                      <li class="list-group-item  px-5 py-4 list-group-item-action">
                        <a href="#!" class="text-muted">
                          <div class="d-flex">
                            <img src="{{ asset('images/avatar/avatar-5.jpg') }}" alt=""
                              class="avatar avatar-md rounded-circle ">
                            <div class="ms-4">
                              <p class="mb-1">
                                <span class="text-dark">Jitu Chauhan </span>respondeu à sua lista de pedidos pendentes
                                com notas
                              </p>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                  class="bi bi-clock text-muted" viewBox="0 0 16 16">
                                  <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                </svg><small class="ms-2">2 dias atrás</small></span>
                            </div>
                          </div>
                        </a>



                      </li>
                      <li class="list-group-item px-5 py-4 list-group-item-action">
                        <a href="#!" class="text-muted">
                          <div class="d-flex">
                            <img src="{{ asset('images/avatar/avatar-2.jpg') }}" alt=""
                              class="avatar avatar-md rounded-circle ">
                            <div class="ms-4">
                              <p class="mb-1">
                                <span class="text-dark">Você tem novas mensagens </span> 2 mensagens não lidas
                              </p>
                              <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                  class="bi bi-clock text-muted" viewBox="0 0 16 16">
                                  <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                </svg><small class="ms-2">3 dias atrás</small></span>
                            </div>
                          </div>
                        </a>



                      </li>

                    </ul>
                  </div>
                  <div class="border-top px-5 py-4 text-center">
                    <a href="#!" class=" ">
                      Ver Tudo
                    </a>
                  </div>
                </div>

              </li> --}}
              <li class="dropdown ms-4">
                <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset('images/avatar/avatar.png') }}" alt="" class="avatar avatar-md rounded-circle">
                </a>

                <div class="dropdown-menu dropdown-menu-end p-0">

                  <div class="lh-1 px-5 py-4 border-bottom">
                    <h5 class="mb-1 h6">Administrador {{ auth()->user()->name }}</h5>
                    <small>{{ auth()->user()->email }}</small>
                  </div>

                  <ul class="list-unstyled px-2 py-3">

                    <li>
                      <a class="dropdown-item" href="{{ route('profile.edit.admin') }}">
                        Perfil
                      </a>

                    </li>
                  </ul>
                  <div class="border-top px-1 py-3">
                    <form action="{{ route('logout') }}" method="post">
                      @csrf
                      <button class="btn text-primary">Sair</button>
                    </form>
                  </div>

                </div>

              </li>
            </ul>

          </div>

        </div>
      </div>
    </nav>

    <div class="main-wrapper">
      <!-- navbar vertical -->

      <nav class="navbar-vertical-nav d-none d-xl-block ">
        <div class="navbar-vertical">
          <div class="px-4 py-5">
            <a href="{{ route('home') }}" class="navbar-brand">
              <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="">
            </a>
          </div>
          <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">

              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('dashboard.index') ? " active" : ' ' }} " href=" {{
                  route('dashboard.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-house"></i></span>
                    <span class="nav-link-text">Painel</span>
                  </div>
                </a>
              </li>
              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Gestão da Loja</span>
              </li>
              @if (auth()->user()->is_super_admin)
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('users.index') || request()->routeIs('users.create') ? 'active' : ''}}"
                  href="{{ route('users.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-person"></i></span>
                    <span class="nav-link-text">Usuários</span>
                  </div>
                </a>
              </li>
              @endif
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('categories.index') || request()->routeIs('categories.create') ? "
                  active" : ' ' }}" href="{{ route('categories.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-list-task"></i></span>
                    <span class="nav-link-text">Categorias</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('products.index') || request()->routeIs('products.create') ? 'active' : '' }}"
                  href="{{ route('products.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-cart"></i></span>
                    <span class="nav-link-text">Produtos</span>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('orders.index') || request()->routeIs('orders.show') ? 'active' : ''}}"
                  href="{{ route('orders.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-bag"></i></span>
                    <span class="nav-link-text">Pedidos</span>
                  </div>
                </a>
              </li>

              {{-- <li class="nav-item ">
                <a class="nav-link " href="../dashboard/vendor-grid.html">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-shop"></i></span>
                    <span class="nav-link-text">Lojas / Vendedores</span>
                  </div>
                </a>
              </li> --}}
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('customers.index') ? 'active' : ''}}"
                  href="{{ route('customers.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-people"></i></span>
                    <span class="nav-link-text">Clientes</span>
                  </div>
                </a>
              </li>
              {{-- <li class="nav-item ">
                <a class="nav-link " href="../dashboard/reviews.html">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-star"></i></span>
                    <span class="nav-link-text">Avaliações</span>
                  </div>
                </a>
              </li> --}}
              <!-- Nav item -->
              {{-- <li class="nav-item">
                <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#navMenuLevelFirst"
                  aria-expanded="false" aria-controls="navMenuLevelFirst">
                  <span class="nav-link-icon"><i class=" bi bi-arrow-90deg-down"></i></span>
                  <span class="nav-link-text">Menu de Nível</span>
                </a>
                <div id="navMenuLevelFirst" class="collapse " data-bs-parent="#sideNavbar">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link " href="#" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond1"
                        aria-expanded="false" aria-controls="navMenuLevelSecond1">
                        Dois Níveis
                      </a>
                      <div id="navMenuLevelSecond1" class="collapse" data-bs-parent="#navMenuLevel">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a class="nav-link " href="#">NavItem 1</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">NavItem 2</a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link  collapsed  " href="#" data-bs-toggle="collapse"
                        data-bs-target="#navMenuLevelThreeOne1" aria-expanded="false"
                        aria-controls="navMenuLevelThreeOne1">
                        Três Níveis
                      </a>
                      <div id="navMenuLevelThreeOne1" class="collapse " data-bs-parent="#navMenuLevel">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                              data-bs-target="#navMenuLevelThreeTwo" aria-expanded="false"
                              aria-controls="navMenuLevelThreeTwo">
                              NavItem 1
                            </a>
                            <div id="navMenuLevelThreeTwo" class="collapse collapse "
                              data-bs-parent="#navMenuLevelThree">
                              <ul class="nav flex-column">
                                <li class="nav-item">
                                  <a class="nav-link " href="#">
                                    NavChild Item 1
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">Nav
                              Item 2</a>
                          </li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </div>
              </li> --}}

              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Configurações do Site</span> <span class="badge bg-light-info text-dark-info">Em
                  breve</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-newspaper"></i></span>
                    <span class="nav-link-text">Blog</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-images"></i></span>
                    <span class="nav-link-text">Meios de Comunicação</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-gear"></i></span>
                    <span class="nav-link-text">Configurações da Loja</span>
                  </div>
                </a>
              </li>

              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Suporte</span> <span class="badge bg-light-info text-dark-info">Em breve</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-headphones"></i></span>
                    <span class="nav-link-text">Suporte Técnico</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-question-circle"></i></span>
                    <span class="nav-link-text">Central de Ajuda</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-infinity"></i></span>
                    <span class="nav-link-text">Como Funciona o FreshCart</span>
                  </div>
                </a>
              </li>

              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Nossos Aplicativos</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-apple"></i></span>
                    <span class="nav-link-text">Apple Store</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-google-play"></i></span>
                    <span class="nav-link-text">Google Play Store</span>
                  </div>
                </a>
              </li>


            </ul>
          </div>
        </div>
      </nav>

      <nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
        <div class="navbar-vertical">
          <div class="px-4 py-5 d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="navbar-brand">
              <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column">
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('dashboard.index') ? " active" : ' ' }} " href=" {{
                  route('dashboard.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-house"></i></span>
                    <span>Painel</span>
                  </div>
                </a>
              </li>
              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Gestão da Loja</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : ''}}"
                  href="{{ route('users.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-person"></i></span>
                    <span class="nav-link-text">Usuários</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('categories.index') || request()->routeIs('categories.create') ? "
                  active" : ' ' }}" href="{{ route('categories.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-list-task"></i></span>
                    <span class="nav-link-text">Categorias</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('products.index') || request()->routeIs('products.create') ? 'active' : '' }}"
                  href="{{ route('products.create') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-cart"></i></span>
                    <span class="nav-link-text">Produtos</span>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link   {{ request()->routeIs('orders.index') || request()->routeIs('orders.show') ? 'active' : ''}}"
                  href="{{ route('orders.show') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-bag"></i></span>
                    <span class="nav-link-text">Pedidos</span>
                  </div>
                </a>
              </li>
              {{-- <li class="nav-item ">
                <a class="nav-link " href="../dashboard/vendor-grid.html">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-shop"></i></span>
                    <span class="nav-link-text">Lojas / Vendedores</span>
                  </div>
                </a>
              </li> --}}
              <li class="nav-item ">
                <a class="nav-link {{ request()->routeIs('customers.index') ? 'active' : ''}}"
                  href="{{ route('customers.index') }}">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-people"></i></span>
                    <span class="nav-link-text">Clientes</span>
                  </div>
                </a>
              </li>
              {{-- <li class="nav-item ">
                <a class="nav-link " href="../dashboard/reviews.html">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-star"></i></span>
                    <span class="nav-link-text">Avaliações</span>
                  </div>
                </a>
              </li> --}}
              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Configurações do Site</span> <span class="badge bg-light-info text-dark-info">Em
                  breve</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-newspaper"></i></span>
                    <span class="nav-link-text">Blog</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-images"></i></span>
                    <span class="nav-link-text">Meios de Comunicação</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-gear"></i></span>
                    <span class="nav-link-text">Configurações da Loja</span>
                  </div>
                </a>
              </li>
              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Suporte</span> <span class="badge bg-light-info text-dark-info">Em breve</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-headphones"></i></span>
                    <span class="nav-link-text">Suporte Técnico</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-question-circle"></i></span>
                    <span class="nav-link-text">Central de Ajuda</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-infinity"></i></span>
                    <span class="nav-link-text">Como funciona o FreshCart</span>
                  </div>
                </a>
              </li>

              <li class="nav-item mt-6 mb-3">
                <span class="nav-label">Nossos Aplicativos</span>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-apple"></i></span>
                    <span class="nav-link-text">Apple Store</span>
                  </div>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link disabled" href="#!">
                  <div class="d-flex align-items-center">
                    <span class="nav-link-icon"> <i class="bi bi-google-play"></i></span>
                    <span class="nav-link-text">Google Play Store</span>
                  </div>
                </a>
              </li>
              <li id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link " href="#" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond2"
                      aria-expanded="false" aria-controls="navMenuLevelSecond2">
                      Dois Níveis
                    </a>
                    <div id="navMenuLevelSecond2" class="collapse" data-bs-parent="#navMenuLevel">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link " href="#">NavItem 1</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " href="#">NavItem 2</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  collapsed  " href="#" data-bs-toggle="collapse"
                      data-bs-target="#navMenuLevelThree2" aria-expanded="false" aria-controls="navMenuLevelThree2">
                      Três Níveis
                    </a>
                    <div id="navMenuLevelThree2" class="collapse " data-bs-parent="#navMenuLevel">
                      <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link  collapsed " href="#" data-bs-toggle="collapse"
                            data-bs-target="#navMenuLevelThree3" aria-expanded="false"
                            aria-controls="navMenuLevelThree3">
                            NavItem 1
                          </a>
                          <div id="navMenuLevelThree3" class="collapse collapse " data-bs-parent="#navMenuLevelThree">
                            <ul class="nav flex-column">
                              <li class="nav-item">
                                <a class="nav-link " href="#">
                                  NavChild Item 1
                                </a>
                              </li>
                            </ul>
                          </div>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link " href="#">Nav
                            Item 2</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </li>


            </ul>
          </div>
        </div>

      </nav>

      @yield('content')

    </div>
  </div>

  <!-- Libs JS -->
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>
  <!-- Theme JS -->
  <script src="{{ asset('js/theme.min.js') }}"></script>

  @yield('scripts')

</body>

</html>
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
</head>

<body>

@include('front.partials.header')

  <main>
  <!-- section -->
  <section>
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- col -->
        <div class="col-12">
          <div class="d-flex justify-content-between align-items-center d-md-none py-4">
            <!-- heading -->
            <h3 class="fs-5 mb-0">Account Setting</h3>
            <!-- button -->
            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3 " type="button"
              data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
              <i class="bi bi-text-indent-left fs-3"></i>
            </button>
          </div>
        </div>
        <!-- col -->
        <div class="col-lg-3 col-md-4 col-12 border-end  d-none d-md-block">
          <div class="pt-10 pe-lg-10">
            <!-- nav -->
            <ul class="nav flex-column nav-pills nav-pills-dark">
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('order.index') ? 'active' : '' }}" href="{{ route('order.index') }}">
                  <i class="feather-icon icon-shopping-bag me-2"></i>Seus Pedidos</a>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                  <i class="feather-icon icon-settings me-2"></i>Configurações</a>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link" href="account-address.html"><i
                    class="feather-icon icon-map-pin me-2"></i>Endereço</a>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link" href="account-payment-method.html"><i
                    class="feather-icon icon-credit-card me-2"></i>Forma de Pagamento</a>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link" href="account-notification.html"><i
                    class="feather-icon icon-bell me-2"></i>Notificação</a>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <hr>
              </li>
              <!-- nav item -->
              <li class="nav-item">
                <a class="nav-link " href="../index.html"><i class="feather-icon icon-log-out me-2"></i>Sair</a>
              </li>
            </ul>
          </div>
        </div>

      @yield('content')

      </div>
    </div>
  </section>

</main>

  <!-- modal -->

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasAccount" aria-labelledby="offcanvasAccountLabel">
    <!-- offcanvas header -->
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasAccountLabel">Offcanvas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
      <!-- offcanvas body -->
    <div class="offcanvas-body">
      <ul class="nav flex-column nav-pills nav-pills-dark">
          <!-- nav item -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('order.index') }}"><i
              class="feather-icon icon-shopping-bag me-2"></i>Seus Pedidos</a>
        </li>
          <!-- nav item -->
        <li class="nav-item">
          <a class="nav-link " href="{{ route('settings.index') }}"><i class="feather-icon icon-settings me-2"></i>Configurações</a>
        </li>
          <!-- nav item -->
        <li class="nav-item">
          <a class="nav-link" href="account-address.html"><i class="feather-icon icon-map-pin me-2"></i>Endereço</a>
        </li>
          <!-- nav item -->
        <li class="nav-item">
          <a class="nav-link" href="account-payment-method.html"><i
              class="feather-icon icon-credit-card me-2"></i>Forma de Pagamento</a>
        </li>
          <!-- nav item -->
        <li class="nav-item">
          <a class="nav-link" href="account-notification.html"><i
              class="feather-icon icon-bell me-2"></i>Notificação</a>
        </li>

      </ul>
      <hr class="my-6">
      <div>
          <!-- nav  -->
        <ul class="nav flex-column nav-pills nav-pills-dark">
            <!-- nav item -->
          <li class="nav-item">
            <a class="nav-link " href="../index.html"><i class="feather-icon icon-log-out me-2"></i>Sair</a>
          </li>

        </ul>
      </div>
    </div>
  </div>

  <!-- footer -->
@include('front.partials.footer')


  <!-- Javascript-->
  <!-- Libs JS -->
<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>

</body>

</html>
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
<link href="{{ asset('libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet') }}">
<link href="{{ asset('libs/feather-webfont/dist/feather-icons.css" rel="stylesheet') }}">
<link href="{{ asset('libs/simplebar/dist/simplebar.min.css" rel="stylesheet') }}">


<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
  <!-- Google tag (gtag.js) -->

<!-- End Tag -->
</head>

<body>

  <!-- navigation -->
<div class="border-bottom shadow-sm">
  <nav class="navbar navbar-light py-2">
    <div class="container justify-content-center justify-content-lg-between">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}"
        alt="Logo" style="width: 160px; height:31px;" class="d-inline-block align-text-top">
      </a>
      <span class="navbar-text">
        @yield('header-text')
      </span>
    </div>
  </nav>
</div>

@yield('content')

 <!-- footer -->
@include('front.partials.footer')

 <!-- Javascript-->
  <!-- Libs JS -->
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('js/theme.min.js') }}"></script>
  <script src="{{ asset('js/vendors/password.js') }}"></script>
  <script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  @stack('scripts')


  </body>

  </html>

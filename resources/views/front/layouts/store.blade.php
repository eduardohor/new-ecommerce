<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>@yield('title')</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">

  <!-- Libs CSS -->
  <link href="{{ asset('libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
  <link href="{{ asset('libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">

  @yield('head')

  <!-- Google tag (gtag.js) -->

  <!-- End Tag -->

</head>

<body>

  @include('front.partials.header')

  @yield('content')

  @include('front.partials.footer')

  <!-- Javascript-->

  <!-- Theme JS -->

  <!-- Libs JS -->
  <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('libs/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>

  @yield('footer')

</body>

</html>
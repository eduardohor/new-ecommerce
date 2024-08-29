<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta content="Codescandy" name="author">
  <title>Página não encontrada </title>

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
  <main>
<!-- section -->
  <section>
    <div class="container d-flex flex-column">
      <!-- row -->
      <div class="row min-vh-100 justify-content-center align-items-center">
        <!-- col -->
        <div class="offset-lg-1 col-lg-10  py-8 py-xl-0">
          <div class=" mb-10 mb-xxl-0">
            <!-- img -->
            <a href="{{ route('home') }}">
                <img src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/logo/freshcart-logo.svg') }}" alt="Logo">
            </a>
          </div>
          <div class="row justify-content-center align-items-center">
            <!-- content -->
            <div class="col-md-6">
              <div class=" mb-6 mb-lg-0">
                <h1>Algo está errado aqui...</h1>
                <p class="mb-8">Não encontramos a página que você procura.<br>
                  Confira nossa central de ajuda ou volte para casa.</p>
   <!-- btn -->
                <a href="#" class="btn btn-dark">Central de Ajuda <i class="feather-icon icon-arrow-right"></i></a>
                 <!-- btn -->
                <a href="{{ route('home') }}" class="btn btn-primary ms-2">De volta para casa</a>
              </div>

            </div>
            <div class="col-md-6">
              <div>
                 <!-- img -->
                <img src="{{ asset('images/svg-graphics/error.svg') }}" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- section -->






  <!-- Javascript-->
  <!-- Libs JS -->
<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>




</body>

</html>

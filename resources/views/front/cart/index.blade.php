@extends('front/layouts/store')
@section('title', 'Carrinho')
@section('content')

@section('head')

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
              <li class="breadcrumb-item"><a href="{{ route('store') }}">Início</a></li>
              <li class="breadcrumb-item"><a href="{{ route('store') }}">Loja</a></li>
              <li class="breadcrumb-item active" aria-current="page">Carrinho de Compras</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- section -->
  <section class="mb-lg-14 mb-8 mt-8">
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-12">
          <!-- card -->
          <div class="card py-1 border-0 mb-8">
            <div>
              <h1 class="fw-bold">Carrinho de Compras</h1>
              {{-- <p class="mb-0">Compras em 382480</p> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- row -->
      @if ($cart && $cart->cartProducts->isNotEmpty())
      <div class="row">
        <div class="col-lg-8 col-md-7">

          <div class="py-3">
            <!-- alert -->
            {{-- <div class="alert alert-danger p-2" role="alert">
              Você tem entrega GRATUITA. Comece a finalizar sua<a href="#!" class="alert-link"> compra agora!</a>
            </div> --}}
            <ul class="list-group list-group-flush">
              @foreach ($cart->cartProducts as $cartProduct)
              <li class="list-group-item py-3 py-lg-0 px-0 border-top">
                <!-- row -->
                <div class="row align-items-center my-3">
                  <div class="col-3 col-md-2">
                    <!-- img --> <img
                      src="{{ asset('storage/' . $cartProduct->product->productImages->first()->image_path) }}"
                      alt="Ecommerce" class="img-fluid">
                  </div>
                  <div class="col-4 col-md-5">
                    <!-- title -->
                    <a href="shop-single.html" class="text-inherit">
                      <h6 class="mb-0">{{ $cartProduct->product->title }}</h6>
                    </a>
                    <span><small class="text-muted">Código do Produto: {{ $cartProduct->product->product_code
                        }}</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1">
                      <form action="{{ route('cart.delete-product-to-cart') }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartProduct->product->id }}">
                        <input type="hidden" name="remove_all" value="1">
                        <button type="submit" class="btn btn-link btn-sm p-0 m-0 text-decoration-none text-inherit">
                          <span class="me-1 align-text-bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-trash-2 text-success">
                              <polyline points="3 6 5 6 21 6"></polyline>
                              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                              </path>
                              <line x1="10" y1="11" x2="10" y2="17"></line>
                              <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                          </span>
                          <span class="text-muted">Remover</span>
                        </button>
                      </form>

                    </div>
                  </div>
                  <!-- input group -->
                  <div class="col-3 col-md-3 col-lg-2">
                    <!-- input -->
                    <div class="input-group input-spinner  ">
                      <form class="cart-form" action="{{ route('cart.delete-product-to-cart') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartProduct->product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="button" value="-" class="button-minus btn btn-sm subtractButton">
                      </form>
                      <input type="number" step="1" max="10" value="{{ $cartProduct->quantity }}" name="quantity"
                        class="quantity-field form-control-sm form-input " readonly>
                      <form action="{{ route('cart.add-product-to-cart') }}" method="post" class="cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartProduct->product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="button" value="+" class="button-plus btn btn-sm additionButton">
                      </form>
                    </div>


                  </div>
                  <!-- price -->
                  <div class=" col-2 text-lg-end text-start text-md-end col-md-2">
                    @if ($cartProduct->product->sale_price > 0)
                    <span class="fw-bold text-danger">R$ {{ number_format($cartProduct->product->sale_price, 2, ',',
                      '.') }}</span>
                    <div class="text-decoration-line-through text-muted small">R$ {{
                      number_format($cartProduct->product->regular_price, 2, ',',
                      '.') }}</div>
                    @else
                    <span class="fw-bold">R$ {{
                      number_format($cartProduct->product->regular_price, 2, ',',
                      '.') }}</span>

                  </div>
                  @endif
                </div>
              </li>

              @endforeach
              <!-- list group -->

              {{--
              <!-- list group -->
              <li class="list-group-item py-3 py-lg-0 px-0">
                <!-- row -->
                <div class="row align-items-center">
                  <div class="col-3 col-md-2">
                    <!-- img --> <img src="{{ asset('images/products/product-img-2.jpg') }}" alt="Ecommerce"
                      class="img-fluid">
                  </div>
                  <div class="col-4 col-md-5">
                    <!-- title -->
                    <a href="shop-single.html" class="text-inherit">
                      <h6 class="mb-0">NutriChoice Digestive </h6>
                    </a>
                    <span><small class="text-muted">250g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remover</span></a></div>
                  </div>
                  <!-- input group -->
                  <div class="col-3 col-md-3 col-lg-2">
                    <!-- input -->
                    <div class="input-group input-spinner  ">
                      <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                      <input type="number" step="1" max="10" value="1" name="quantity"
                        class="quantity-field form-control-sm form-input   ">
                      <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                    </div>

                  </div>
                  <!-- price -->
                  <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                    <span class="fw-bold text-danger">R$ 20.00</span>
                    <div class="text-decoration-line-through text-muted small">R$ 26.00</div>
                  </div>
                </div>

              </li>
              <!-- list group -->
              <li class="list-group-item py-3 py-lg-0 px-0">
                <!-- row -->
                <div class="row align-items-center">
                  <div class="col-3 col-md-2">
                    <!-- img --> <img src="{{ asset('images/products/product-img-3.jpg') }}" alt="Ecommerce"
                      class="img-fluid">
                  </div>
                  <div class="col-4 col-md-5">
                    <!-- title -->
                    <a href="shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
                    </a>
                    <span><small class="text-muted">1 kg</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remover</span></a></div>
                  </div>
                  <!-- input group -->
                  <div class="col-3 col-md-3 col-lg-2">
                    <!-- input -->
                    <div class="input-group input-spinner  ">
                      <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                      <input type="number" step="1" max="10" value="1" name="quantity"
                        class="quantity-field form-control-sm form-input   ">
                      <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                    </div>

                  </div>
                  <!-- price -->
                  <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                    <span class="fw-bold">R$ 15.00</span>
                    <div class="text-decoration-line-through text-muted small">R$ 20.00</div>
                  </div>
                </div>

              </li>
              <!-- list group -->
              <li class="list-group-item py-3 py-lg-0 px-0">
                <!-- row -->
                <div class="row align-items-center">
                  <div class="col-3 col-md-2">
                    <!-- img --> <img src="{{ asset('images/products/product-img-4.jpg') }}" alt="Ecommerce"
                      class="img-fluid">
                  </div>
                  <div class="col-4 col-md-5">
                    <!-- title -->
                    <a href="shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Onion Flavour Potato</h6>
                    </a>
                    <span><small class="text-muted">250g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remover</span></a></div>
                  </div>
                  <!-- input group -->
                  <div class="col-3 col-md-3 col-lg-2">
                    <!-- input -->
                    <div class="input-group input-spinner  ">
                      <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                      <input type="number" step="1" max="10" value="1" name="quantity"
                        class="quantity-field form-control-sm form-input   ">
                      <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                    </div>

                  </div>
                  <!-- price -->
                  <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                    <span class="fw-bold">R$ 15.00</span>
                    <div class="text-decoration-line-through text-muted small">R$ 20.00</div>
                  </div>
                </div>

              </li>
              <!-- list group -->
              <li class="list-group-item py-3 py-lg-0 px-0 border-bottom">
                <!-- row -->
                <div class="row align-items-center">
                  <div class="col-3 col-md-2">
                    <!-- img --> <img src="{{ asset('images/products/product-img-5.jpg') }}" alt="Ecommerce"
                      class="img-fluid">
                  </div>
                  <div class="col-4 col-md-5">
                    <!-- title -->
                    <a href="shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Salted Instant Popcorn </h6>
                    </a>
                    <span><small class="text-muted">100g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remover</span></a></div>
                  </div>
                  <!-- input group -->
                  <div class="col-3 col-md-3 col-lg-2">
                    <!-- input -->
                    <div class="input-group input-spinner  ">
                      <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                      <input type="number" step="1" max="10" value="1" name="quantity"
                        class="quantity-field form-control-sm form-input   ">
                      <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                    </div>

                  </div>
                  <!-- price -->
                  <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                    <span class="fw-bold">R$ 15.00</span>
                    <div class="text-decoration-line-through text-muted small">R$ 25.00</div>
                  </div>
                </div>

              </li> --}}

            </ul>
            <!-- btn -->
            <div class="d-flex justify-content-between mt-4">
              <a href="{{ route('store') }}" class="btn btn-primary">Continue Comprando</a>
              {{-- <a href="#!" class="btn btn-dark">Atualizar Carrinho</a> --}}
            </div>

          </div>
        </div>

        <!-- sidebar -->
        <div class="col-12 col-lg-4 col-md-5">
          <!-- card -->
          <div class="mb-5 card mt-6">
            <div class="card-body p-6">
              <!-- heading -->
              <h2 class="h5 mb-4">Resumo</h2>
              <div class="card mb-2">
                <!-- list group -->
                <ul class="list-group list-group-flush">
                  <!-- list group item -->
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                      <div>Subtotal do Item</div>

                    </div>
                    <span>R$ {{ number_format($cart->total_amount, 2, ',', '.') }}</span>
                  </li>

                  <!-- list group item -->
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                      <div>Frete</div>

                    </div>
                    <span> - - - </span>
                  </li>
                  <!-- list group item -->
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="me-auto">
                      <div class="fw-bold">Subtotal</div>

                    </div>
                    <span class="fw-bold">R$ {{ number_format($cart->total_amount, 2, ',', '.') }}</span>
                  </li>
                </ul>

              </div>
              <div class="d-grid mb-1 mt-4">
                <!-- btn -->
                <button class="btn btn-primary btn-lg d-flex justify-content-between align-items-center" type="submit">
                  Ir para Finalização <span class="fw-bold">R$ {{ number_format($cart->total_amount, 2, ',', '.')
                    }}</span></button>
              </div>
              <!-- text -->
              {{-- <p><small>Ao fazer seu pedido, você concorda em ficar vinculado ao Freshcart <a href="#!">Termos de
                    Serviço</a>
                  e <a href="#!">Política de Privacidade.</a> </small></p> --}}

              <!-- heading -->
              {{-- <div class="mt-8">
                <h2 class="h5 mb-3">Adicionar promoção ou vale-presente</h2>
                <form>
                  <div class="mb-2">
                    <!-- input -->
                    <label for="giftcard" class="form-label sr-only">Endereço de e-mail</label>
                    <input type="text" class="form-control" id="giftcard" placeholder="Promoção ou vale-presente">

                  </div>
                  <!-- btn -->
                  <div class="d-grid"><button type="submit" class="btn btn-outline-dark mb-1">Resgatar</button></div>
                  <p class="text-muted mb-0"> <small>Termos e Condições As condições se aplicam</small></p>
                </form>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      @else
      <!-- Se o carrinho estiver vazio -->
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2>Seu carrinho está vazio</h2>
          <a href="{{ route('store') }}" class="btn btn-primary mt-2">Continue Comprando</a>
        </div>
      </div>
      @endif

    </div>
  </section>

</main>

@section('footer')
<!-- Javascript-->
<script src="{{ asset('js/vendors/increment-value.js') }}"></script>


<!-- Theme JS -->
<script src="{{ asset('js/theme.min.js') }}"></script>

<script>
  $(document).ready(function() {
      $(".subtractButton").click(function() {
          // Encontrar o formulário pai do botão clicado
          var form = $(this).closest('.cart-form');
          form.submit();
      });
      $(".additionButton").click(function() {
          // Encontrar o formulário pai do botão clicado
          var form = $(this).closest('.cart-form');
          form.submit();
      });

  });
</script>

@endsection

@endsection
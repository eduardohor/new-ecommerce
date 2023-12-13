@extends('front/layouts/auth')
@section('title', 'Esqueceu sua Senha')
@section('content')

@section('header-text')
Já possui uma conta? <a href="{{ route('login') }}">Entrar</a>
@endsection

<main>
  <!-- section -->
  <section class="my-lg-14 my-8">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
          <!-- img -->
          <img src="{{ asset('/images/svg-graphics/fp-g.svg') }}" alt="" class="img-fluid">
        </div>
        <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
          <div>
            <div class="mb-lg-9 mb-5">
              <!-- heading -->
              <h1 class="mb-2 h2 fw-bold">Esqueceu sua senha?</h1>
              <p>Por favor, insira o endereço de e-mail associado à sua conta e enviaremos um e-mail com um link para
                redefinir sua senha.</p>
            </div>

            @if (session('status'))
            <div class="alert alert-success mb-4">
              {{ session('status') }}
            </div>
            @endif

            <!-- form -->
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <!-- row -->
              <div class="row g-3">
                <!-- col -->
                <div class="col-12">
                  <!-- input -->
                  <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"
                    value="{{ old('email') }}" required autofocus>
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- btn -->
                <div class="col-12 d-grid gap-2"> <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                  <a href="{{ route('login') }}" class="btn btn-light">Voltar</a>
                </div>


              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </section>
</main>

@endsection
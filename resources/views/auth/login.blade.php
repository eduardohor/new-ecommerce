@extends('front/layouts/auth')
@section('title', 'Entrar')
@section('content')

<main>
  <!-- section -->
  <section class="my-lg-14 my-8">
    <div class="container">
      <!-- row -->
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
          <!-- img -->
          <img src="{{ asset('images/svg-graphics/signin-g.svg') }}" alt="" class="img-fluid">
        </div>
        <!-- col -->
        <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
          <div class="mb-lg-9 mb-5">
            <h1 class="mb-1 h2 fw-bold">Faça login no FreshCart</h1>
            <p>Bem-vindo de volta ao FreshCart! Insira o seu email e senha para iniciar.</p>
          </div>

          @if (session('status'))
          <div class="alert alert-success mb-4">
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="row g-3">
              <!-- row -->

              <div class="col-12">
                <!-- input -->
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"
                  value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-12">
                <!-- input -->
                <div class="password-field position-relative">
                  <input type="password" id="fakePassword" placeholder="Senha" class="form-control" name="password"
                    autocomplete="current-password">
                  <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

              </div>
              <div class="d-flex justify-content-between">
                <!-- form check -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember">
                  <!-- label --> <label class="form-check-label" for="flexCheckDefault">
                    Lembrar de mim
                  </label>
                </div>
                <div> Esqueceu sua senha? <a href="{{ route('password.request') }}">Redefinir</a></div>
              </div>
              <!-- btn -->
              <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
              <!-- link -->
              <div>Não possui uma conta? <a href="{{ route('register') }}"> Cadastre-se</a></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection
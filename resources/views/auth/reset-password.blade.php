@extends('front/layouts/auth')
@section('title','Redefinir Senha')
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
            <h1 class="mb-1 h2 fw-bold">Redefinir Senha</h1>
            <p>Bem-vindo de volta ao FreshCart! Adicione sua nova senha.</p>
          </div>

          <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="row g-3">
              <!-- row -->

              <div class="col-12">
                <!-- input -->
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"
                  value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-12">
                <!-- input -->
                <div class="password-field position-relative">
                  <input type="password" id="fakePassword" placeholder="Senha" class="form-control" name="password"
                    required autocomplete="new-password">
                  <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

              </div>
              <div class="col-12">
                <!-- input -->
                <div class="password-field position-relative">
                  <input type="password" id="fakePassword" placeholder="Confirme sua senha" class="form-control"
                    name="password_confirmation" required autocomplete="new-password">
                  <span><i id="passwordToggler" class="bi bi-eye-slash"></i></span>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

              </div>
              <!-- btn -->
              <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection
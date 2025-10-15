@extends('front/layouts/auth')
@section('title', 'Cadastrar')
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
          <img src="{{ asset('images/svg-graphics/signup-g.svg') }}" alt="" class="img-fluid">
        </div>
        <!-- col -->
        <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
          <div class="mb-lg-9 mb-5">
            <h1 class="mb-1 h2 fw-bold">Comece a Comprar</h1>
            <p>Bem-vindo ao FreshCart! Insira os seus dados para iniciar.</p>
          </div>
          <!-- form -->
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
              <!-- col -->
              <div class="col">
                <!-- input -->
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                  placeholder="Nome" aria-label="Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                <!-- input -->
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                  id="inputEmail4" placeholder="Email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                <div class="password-field position-relative">
                  <input type="password" name="password" id="password" placeholder="Senha"
                    class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="col-12">

                <div class="password-field position-relative">
                  <input type="password" name="password_confirmation" id="fakePassword" placeholder="Confirme sua senha"
                    class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <!-- btn -->
              <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Cadastrar</button>
              </div>

              <!-- text -->
              @php
              $termsPage = optional($institutionalPagesBySlug)['termos-e-condicoes'];
              $privacyPage = optional($institutionalPagesBySlug)['politica-de-privacidade'];
              @endphp
              <p>
                <small>
                  Ao continuar, você concorda com nossos
                  @if ($termsPage)
                    <a href="{{ route('institutional.show', $termsPage->slug) }}" target="_blank" rel="noopener noreferrer">
                      {{ $termsPage->title }}
                    </a>
                  @else
                    Termos e Condições
                  @endif
                  e
                  @if ($privacyPage)
                    <a href="{{ route('institutional.show', $privacyPage->slug) }}" target="_blank" rel="noopener noreferrer">
                      {{ $privacyPage->title }}
                    </a>
                  @else
                    Política de Privacidade
                  @endif
                </small>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>


  </section>
</main>

@endsection

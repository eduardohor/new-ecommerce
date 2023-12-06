@extends('layouts/login')
@section('Cadastrar')
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
          <form>
            <div class="row g-3">
              <!-- col -->
              <div class="col">
                <!-- input --><input type="text" class="form-control" placeholder="Primeiro Nome" aria-label="First name"
                  required>
              </div>
              <div class="col">
                <!-- input --><input type="text" class="form-control" placeholder="Sobrenome" aria-label="Last name"
                  required>
              </div>
              <div class="col-12">

                <!-- input --><input type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
              </div>
              <div class="col-12">

                <div class="password-field position-relative">
                  <input type="password" id="fakePassword" placeholder="Senha" class="form-control" required >
                  <span><i id="passwordToggler"class="bi bi-eye-slash"></i></span>
                </div>
              </div>
              <!-- btn -->
              <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Cadastrar</button>
              </div>

              <!-- text -->
              <p><small>Ao continuar, você concorda com nossos<a href="#!"> Termos de Serviço</a> e <a href="#!">Plítica de Privacidade</a></small></p>
            </div>
          </form>
        </div>
      </div>
    </div>


  </section>
  </main>
    
@endsection
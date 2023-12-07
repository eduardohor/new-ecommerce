@extends('front/layouts/account')
@section('title', 'Configurações')

@section('content')
<div class="col-lg-9 col-md-8 col-12">
  <div class="py-6 p-md-6 p-lg-10">
    <div class="mb-6">
      <!-- heading -->
      <h2 class="mb-0">Configurações de Conta</h2>
    </div>
    <div>
      <!-- heading -->
      <h5 class="mb-4">Detalhes da conta</h5>
      <div class="row">
        <div class="col-lg-5">
          <!-- form -->
          <form>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" class="form-control" placeholder="Seu nome">
            </div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" class="form-control" placeholder="example@gmail.com">
            </div>
            <!-- input -->
            <div class="mb-5">
              <label class="form-label">Telefone</label>
              <input type="text" class="form-control" placeholder="Número do telefone">
            </div>
            <!-- button -->
            <div class="mb-3">
              <button class="btn btn-primary">Salvar Detalhes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <hr class="my-10">
    <div class="pe-lg-14">
      <!-- heading -->
      <h5 class="mb-4">Senha</h5>
      <form class=" row row-cols-1 row-cols-lg-2">
        <!-- input -->
        <div class="mb-3 col">
          <label class="form-label">Nova Senha</label>
          <input type="password" class="form-control" placeholder="**********">
        </div>
        <!-- input -->
        <div class="mb-3 col">
          <label class="form-label">Senha Atual</label>
          <input type="password" class="form-control" placeholder="**********">
        </div>
        <!-- input -->
        <div class="col-12">
          <p class="mb-4">Não consegue lembrar sua senha atual?<a href="#"> Redefina sua senha.</a></p>
          <a href="#" class="btn btn-primary">Salvar Senha</a>
        </div>
      </form>
    </div>
    <hr class="my-10">
    <div>
      <!-- heading -->
      <h5 class="mb-4">Deletar Conta</h5>
      <p class="mb-2">Gostaria de excluir sua conta?</p>
      <p class="mb-5">Esta conta contém 12 pedidos. Excluir sua conta removerá todos os detalhes do pedido associados a ela.
      </p>
      <!-- btn -->
      <a href="#" class="btn btn-outline-danger">Quero excluir minha conta</a>
    </div>
  </div>
</div>

@endsection
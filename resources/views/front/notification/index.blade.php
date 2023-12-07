@extends('front/layouts/account')
@section('title', 'Notificações')

@section('content')
<div class="col-lg-9 col-md-8 col-12">
  <div class="py-6 p-md-6 p-lg-10">
    <div class="mb-6">
      <!-- heading -->
      <h2 class="mb-0">Configurações de notificação</h2>

    </div>

    <div class="mb-10">
      <!-- text -->
      <div class="border-bottom pb-3 mb-5">
        <h5 class="mb-0">Notificações por e-mail</h5>
      </div>
      <!-- text -->
      <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
          <h6 class="mb-1">Notificação Semanal</h6>
          <p class="mb-0 ">Várias versões evoluíram ao longo dos anos, às vezes por acidente, às vezes propositalmente.</p>
        </div>
        <!-- checkbox -->
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault"></label>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <!-- text -->
        <div>
          <h6 class="mb-1">Resumo da conta</h6>
          <p class="mb-0 pe-12 ">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
            turpis eguris eu sollicitudin massa. Nulla
            ipsum odio, aliquam in odio et, fermentum blandit nulla.
          </p>
        </div>
        <!-- form checkbox -->
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
          <label class="form-check-label" for="flexSwitchCheckChecked"></label>
        </div>
      </div>
    </div>
    <div class="mb-10">
      <!-- heading -->
      <div class="border-bottom pb-3 mb-5">
        <h5 class="mb-0">Atualizações de pedidos</h5>
      </div>
      <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
          <!-- heading -->
          <h6 class="mb-0">Mensagens de texto</h6>

        </div>
        <!-- form checkbox -->
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
          <label class="form-check-label" for="flexSwitchCheckDefault2"></label>
        </div>
      </div>
      <!-- text -->
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h6 class="mb-1">Ligue antes de finalizar a compra</h6>
          <p class="mb-0 ">Só ligaremos se houver alterações pendentes
          </p>
        </div>
        <!-- form checkbox -->
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked>
          <label class="form-check-label" for="flexSwitchCheckChecked2"></label>
        </div>
      </div>
    </div>
    <div class="mb-6">
      <!-- text -->
      <div class="border-bottom pb-3 mb-5">
        <h5 class="mb-0">Notificação do site</h5>
      </div>
      <div>
        <!-- form checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckFollower" checked>
          <label class="form-check-label" for="flexCheckFollower">
            Novo Seguidor
          </label>
        </div>
        <!-- form checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckPost">
          <label class="form-check-label" for="flexCheckPost">
            Curtida em Postagem
          </label>
        </div>
        <!-- form checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckPosted">
          <label class="form-check-label" for="flexCheckPosted">
            Alguém que você seguiu postou
          </label>
        </div>
        <!-- form checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckCollection">
          <label class="form-check-label" for="flexCheckCollection">
            Postagem adicionada à coleção
          </label>
        </div>
        <!-- form checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckOrder">
          <label class="form-check-label" for="flexCheckOrder">
            Entrega de Pedidos
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
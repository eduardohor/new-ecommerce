@extends('front/layouts/account')
@section('title', 'Endereços')

@section('content')
<div class="col-lg-9 col-md-8 col-12">
  <div class="py-6 p-md-6 p-lg-10">
    <div class="d-flex justify-content-between mb-6">
      <!-- heading -->
      <h2 class="mb-0">Endereço</h2>
      <!-- button -->
      <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">Adicionar um novo endereço</a>
    </div>
    <div class="row">
      <!-- col -->
      <div class="col-lg-5 col-xxl-4 col-12 mb-4">
        <!-- form -->
        <div class="card">
          <div class="card-body p-6">
          <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="homeRadio" checked>
            <label class="form-check-label text-dark fw-semi-bold" for="homeRadio">
              Casa
            </label>
          </div>
          <!-- address -->
          <p class="mb-6">Jitu Chauhan<br>

            4450 North Avenue Oakland, <br>

            Nebraska, United States,<br>

            402-776-1106</p>
            <!-- btn -->
          <a href="#" class="btn btn-info btn-sm">Endereço padrão</a>
          <div class="mt-4">
            <a href="#" class="text-inherit">Editar </a>
            <a href="#" class="text-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Excluir
            </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-xxl-4 col-12 mb-4">
        <!-- input -->
        <div class="card">
          <div class="card-body p-6">
          <div class="form-check mb-4">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="officeRadio">
            <label class="form-check-label text-dark fw-semi-bold" for="officeRadio">
              Trabalhoo
            </label>
          </div>
          <!-- nav item -->
          <p class="mb-6">Nitu Chauhan<br>

            3853 Coal Road <br>

            Tannersville, Pennsylvania, 18372, United States <br>

            402-776-1106</p>
            <!-- link -->
          <a href="#" class="link-primary">Definir como padrão</a>
          <div class="mt-4">
            <a href="#" class="text-inherit">Editar </a>
            <!-- btn -->
            <a href="#" class="text-danger ms-3" data-bs-toggle="modal" data-bs-target="#deleteModal">Excluir
            </a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <!-- modal content -->
    <div class="modal-content">
      <!-- modal header -->
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Excluir endereço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- modal body -->
      <div class="modal-body">
        <h6>Tem certeza de que deseja excluir este endereço?</h6>
        <p class="mb-6">Jitu Chauhan<br>

          4450 North Avenue Oakland, <br>

          Nebraska, United States,<br>

          402-776-1106</p>
      </div>
      <!-- modal footer -->
      <div class="modal-footer">
        <!-- btn -->
        <button type="button" class="btn btn-outline-gray-400" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Excluir</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- modal content -->
    <div class="modal-content">
      <!-- modal body -->
      <div class="modal-body p-6">
        <div class="d-flex justify-content-between mb-5">
          <div>
            <!-- heading -->
            <h5 class="mb-1" id="addAddressModalLabel">Novo endereço de entrega</h5>
            <p class="small mb-0">Adicione um novo endereço de entrega para a entrega do seu pedido.</p>
          </div>
          <div>
            <!-- button -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
        <!-- row -->
        <div class="row g-3">
          <!-- col -->
          <div class="col-12">
             <!-- input -->
            <input type="text" class="form-control" placeholder="Primeiro nome" aria-label="First name" required="">
          </div>
           <!-- col -->
          <div class="col-12">
             <!-- input -->
            <input type="text" class="form-control" placeholder="Sobrenome" aria-label="Last name" required="">
          </div>
          <!-- col -->
          <div class="col-12">
            <!-- input -->
            <input type="text" class="form-control" placeholder="Endereço Linha 1">
          </div>
           <!-- col -->
          <div class="col-12">
            <!-- input -->
            <input type="text" class="form-control" placeholder="Endereço Linha 2">
          </div>
           <!-- col -->
          <div class="col-12">
          <!-- input -->
            <input type="text" class="form-control" placeholder="Cidade">
          </div>
           <!-- col -->
          {{-- <div class="col-12">
            <!-- form select -->
            <select class="form-select">
              <option selected=""> India</option>
              <option value="1">UK</option>
              <option value="2">USA</option>
              <option value="3">UAE</option>
            </select>
          </div> --}}
           <!-- col -->
          <div class="col-12">
            <!-- form select -->
            <select class="form-select">
              <option selected="">São Paulo</option>
              <option value="1">Rio de Janeiro</option>
              <option value="2">Maranhão</option>
              <option value="3">Piauí</option>
            </select>
          </div>
           <!-- col -->
          <div class="col-12">
            <!-- input -->
            <input type="text" class="form-control" placeholder="CEP">
          </div>
           <!-- col -->
          {{-- <div class="col-12">
            <!-- input -->
            <input type="text" class="form-control" placeholder="Business Name">
          </div> --}}
           <!-- col -->
          <div class="col-12">
             <!-- form check -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                Definir como padrão
              </label>
            </div>
          </div>
           <!-- col -->
          <div class="col-12 text-end">
            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="button">Salvar Endereço</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
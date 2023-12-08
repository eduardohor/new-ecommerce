@extends('admin.layouts.dashboard')
@section('title', 'Produto')
@section('content')

@section('links')
<link href="{{ asset('libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">

@endsection

<main class="main-content-wrapper">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <!-- page header -->
          <div>
            <h2>Adicionar Novo Produto</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Painel</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar Novo Produto</li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="{{ route('product.index') }}" class="btn btn-light">Voltar para Produtos</a>
          </div>
        </div>

      </div>
    </div>
    <!-- row -->
    <div class="row">

      <div class="col-lg-8 col-12">
        <!-- card -->
        <div class="card mb-6 card-lg">
          <!-- card body -->
          <div class="card-body p-6 ">
            <h4 class="mb-4 h5">Informação do Produto</h4>
            <div class="row">
              <!-- input -->
              <div class="mb-3 col-lg-6">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" placeholder="Nome do Produto" required>
              </div>
              <!-- input -->
              <div class="mb-3 col-lg-6">
                <label class="form-label">Categoria do Produto</label>
                <select class="form-select">
                  <option selected>Categoria do Produto</option>
                  <option value="Dairy, Bread & Eggs">Dairy, Bread & Eggs</option>
                  <option value="Snacks & Munchies">Snacks & Munchies</option>
                  <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                </select>
              </div>
              <!-- input -->
              <div class="mb-3 col-lg-6">
                <label class="form-label">Peso</label>
                <input type="text" class="form-control" placeholder="Peso" required>
              </div>
              <!-- input -->
              <div class="mb-3 col-lg-6">
                <label class="form-label">Unidades</label>
                <select class="form-select">
                  <option selected>Seleciona Unidades</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div>
                <div class="mb-3 col-lg-12 mt-5">
                  <!-- heading -->
                  <h4 class="mb-3 h5">Imagens do Produto</h4>

                  <!-- input -->
                  <form action="#" class="d-block dropzone border-dashed rounded-2 ">
                    <div class="fallback">
                      <input name="file" type="file" multiple>
                    </div>
                  </form>
                </div>
              </div>
              <!-- input -->
              <div class="mb-3 col-lg-12 mt-5">
                <h4 class="mb-3 h5">Descrição do Produto</h4>
                <div class="py-8" id="editor"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-4 col-12">
        <!-- card -->
        <div class="card mb-6 card-lg">
          <!-- card body -->
          <div class="card-body p-6">
            <!-- input -->
            <div class="form-check form-switch mb-4">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" checked>
              <label class="form-check-label" for="flexSwitchStock">Em Estoque</label>
            </div>
            <!-- input -->
            <div>
              <div class="mb-3">
                <label class="form-label">Código do Produto</label>
                <input type="text" class="form-control" placeholder="Insira o código do produto">
              </div>
              <!-- input -->
              <div class="mb-3">
                <label class="form-label">SKU do Produto</label>
                <input type="text" class="form-control" placeholder="Insira o titulo do produto">
              </div>
              <!-- input -->
              <div class="mb-3">
                <label class="form-label" id="productSKU">Status</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                    value="option1" checked>
                  <label class="form-check-label" for="inlineRadio1">Ativo</label>
                </div>
                <!-- input -->
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2">
                  <label class="form-check-label" for="inlineRadio2">Desabilitado</label>
                </div>
                <!-- input -->

              </div>

            </div>
          </div>
        </div>
        <!-- card -->
        <div class="card mb-6 card-lg">
          <!-- card body -->
          <div class="card-body p-6">
            <h4 class="mb-4 h5">Preço do Produto</h4>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Preço Regular</label>
              <input type="text" class="form-control" placeholder="R$0.00">
            </div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Preçod de Venda</label>
              <input type="text" class="form-control" placeholder="R$0.00">
            </div>

          </div>
        </div>
        <!-- card -->
        <div class="card mb-6 card-lg">
          <!-- card body -->
          <div class="card-body p-6">
            <h4 class="mb-4 h5">Metadados</h4>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Meta Título</label>
              <input type="text" class="form-control" placeholder="Title">
            </div>

            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Meta Descrição</label>
              <textarea class="form-control" rows="3" placeholder="Meta Descrição"></textarea>
            </div>
          </div>
        </div>
        <!-- button -->
        <div class="d-grid">
          <a href="#" class="btn btn-primary">
            Criar Produto
          </a>
        </div>
      </div>

    </div>
  </div>
</main>

@endsection

@section('scripts')
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('js/vendors/editor.js') }}"></script>
<script src="{{ asset('libs/dropzone/dist/min/dropzone.min.js') }}"></script>


@endsection
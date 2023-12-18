@extends('admin.layouts.dashboard')
@section('title', 'Cadastrar Categoria')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

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
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Categorias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar Nova Categoria</li>
              </ol>
            </nav>
          </div>
          <div>
            <a href="{{ route('categories.index') }}" class="btn btn-light">Voltar às Categorias</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-12">
        <!-- card -->
        <div class="card mb-6 shadow border-0">
          <!-- card body -->
          <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class=" card-body p-6 ">
              <h4 class=" mb-5 h5">Imagem da Categoria</h4>
              <div class="mb-4 d-flex">
                <div class="position-relative">
                  <img class="image icon-shape icon-xxxl bg-light rounded-4"
                    src="{{ old('image', asset('images/icons/bakery.svg')) }}" alt="Image">

                  <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                    <input type="file" class="file-input" name="image" @error('image') autofocus @enderror>
                    <span class="icon-shape icon-sm rounded-circle bg-white">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                        class="bi bi-pencil-fill text-muted" viewBox="0 0 16 16">
                        <path
                          d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                      </svg>
                    </span>
                  </div>
                </div>
              </div>

              @error('image')
              <span class="text-danger ms-3">{{ $message }}</span>
              @enderror
              {{-- Aviso sobre dimensões --}}
              <div class="row">
                <small class="text-muted ms-3">A imagem deve ser 120x120 pixels.</small>
                <small class="text-muted ms-3">A imagem não pode ser maior que 1 Mb.</small>
                <small class="text-muted ms-3">A imagem deve ser dos tipos: jpeg, png, jpg, gif.</small>
              </div>
              <h4 class="mb-4 h5 mt-5">Informações da Categoria</h4>

              <div class="row">
                <!-- input -->
                <div class="mb-3 col-lg-6">
                  <label class="form-label">Nome da Categoria</label>
                  <input type="text" name="name" class="form-control" placeholder="Nome da Categoria" @error('name')
                    autofocus @enderror value="{{ old('name') }}" required>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- input -->
                <div class="mb-3 col-lg-6">
                  <label class="form-label">Slug</label>
                  <input type="text" name="slug" class="form-control" placeholder="Slug" @error('slug') autofocus
                    @enderror value="{{ old('slug') }}" required>
                  @error('slug')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- input -->
                <div class="mb-3 col-lg-6">
                  <label class="form-label">Categoria Superior</label>
                  <select class="form-select" name="parent_id" @error('parent_id') autofocus @enderror>
                    <option value="">Nenhuma (Categoria Principal)</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('parent_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="mb-3 col-lg-6">
                  <label class="form-label">Data</label>
                  <input type="text" name="date" class="form-control flatpickr" placeholder="Selecione a data"
                    @error('date') autofocus @enderror value="{{ old('date') }}">
                  @error('date')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div>

                </div>
                <!-- input -->
                <div class="mb-3 col-lg-12 ">
                  <label class="form-label">Descrições</label>

                  <div class="py-8" id="editor"></div>
                  <input type="hidden" name="description" id="description" @error('description') autofocus @enderror>
                  @error('description')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- input -->
                <div class="mb-3 col-lg-12 ">
                  <label class="form-label">Status</label><br>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Ativo" checked
                      {{ old('status')=='Ativo' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio1">Ativo</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Desabilitado" {{
                      old('status')=='Desabilitado' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inlineRadio2">Desabilitado</label>
                  </div>
                  @error('status')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="mb-3 col-lg-12 mt-5 ">
                  <h4 class="mb-4 h5">Metadados</h4>
                  <!-- input -->
                  <div class="mb-3">
                    <label class="form-label">Metatítulo</label>
                    <input type="text" name="metatitle" class="form-control" placeholder="Título" @error('metatitle')
                      autofocus @enderror value="{{ old('metatitle') }}">
                    @error('metatitle')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <!-- input -->
                  <div class="mb-3">
                    <label class="form-label">Meta Descrição</label>
                    <textarea class="form-control" name="meta_description" rows="3" placeholder="Meta Descrição"
                      @error('meta_description') autofocus @enderror value="{{ old('meta_description') }}"></textarea>
                    @error('meta_description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary">
                    Salvar
                  </button>
                  <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-2">
                    Cancelar
                  </a>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>


    </div>
  </div>
</main>

@endsection

@section('scripts')

<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('js/vendors/editor.js') }}"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function() {
      // Verifica se a sessão contém o status 'user-created'
      var status = "{{ session('status') }}";
      
      if (status === 'category-created') {
        // Configuração do Toastr
        toastr.options = {
          "positionClass": "toast-top-right",
          "closeButton": true,
          "progressBar": true,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "6000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        };
  
        // Exibe a mensagem do Toastr
        toastr.success("Categoria Cadastradada com Sucesso!");
      }
    });
</script>

@endsection
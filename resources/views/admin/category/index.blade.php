@extends('admin.layouts.dashboard')
@section('title', 'Categorias')
@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<main class="main-content-wrapper">
  <div class="container">
    <!-- row -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <!-- pageheader -->
          <div>
            <h2>Categorias</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Categorias</li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Adicionar Nova Categoria</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-xl-12 col-12 mb-5">
        <!-- card -->
        <div class="card h-100 card-lg">
          <div class=" px-6 py-6 ">
            <div class="row justify-content-between">
              <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                <!-- form -->
                <form class="d-flex" role="search" method="get" action="{{ route('categories.index') }}">
                  <input class="form-control" type="search" placeholder="Pesquisar Categorias" name="search">
                  <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                </form>
              </div>
              {{--
              <!-- select option -->
              <div class="col-xl-2 col-md-4 col-12">
                <select class="form-select">
                  <option selected>Status</option>
                  <option value="Published">Publicadas</option>
                  <option value="Unpublished">Não Publicadas</option>
                </select>
              </div> --}}
            </div>
          </div>
          <!-- card body -->
          <div class="card-body p-0">
            <!-- table -->
            <div class="table-responsive ">
              <table class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                <thead class="bg-light">
                  <tr>
                    <th>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkAll">
                        <label class="form-check-label" for="checkAll">

                        </label>
                      </div>
                    </th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Produtos</th>
                    <th>Status</th>

                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>

                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="categoryOne">
                        <label class="form-check-label" for="categoryOne">

                        </label>
                      </div>
                    </td>
                    <td>
                      <a href="#!"> <img src="{{ asset('storage/' . $category->image)  }}" alt=""
                          class="icon-shape icon-sm"></a>
                    </td>
                    <td><a href="#" class="text-reset">{{ $category->name }}</a></td>
                    <td>--</td>

                    <td>
                      <span
                        class="text-dark-primary badge bg-light-{{ $category->status == 'Ativo' ? 'primary' : 'danger' }}">{{
                        $category->status }}</span>
                    </td>

                    <td>
                      <div class="dropdown">
                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="feather-icon icon-more-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-3"></i>Excluir</a></li>
                          <li>
                            <form action="{{ route('categories.edit', $category->id) }}" method="get">
                              <button class="dropdown-item"><i class="bi bi-pencil-square me-3 "></i>Editar</button>
                            </form>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>

          <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
            <span class="mb-2 mb-md-0">Mostrando {{ $categories->firstItem() }} a {{ $categories->lastItem() }} de {{
              $categories->total() }} resultados</span>
            <nav class="mt-2 mt-md-0">
              {{ $categories->appends([
              'search' => request()->get('search', '')
              ])->links() }}
            </nav>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function() {
    var error  = "{{ session('error') }}";
    var warning = "{{ session('warning') }}";
    
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

      if (error) {
        toastr.error(error);
      }
       
      if (warning) {
        toastr.warning(warning);
      }
  });
</script>

@endsection
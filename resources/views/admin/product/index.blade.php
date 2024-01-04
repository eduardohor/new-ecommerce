@extends('admin.layouts.dashboard')
@section('title', 'Produtos')
@section('content')

<main class="main-content-wrapper">
  <div class="container">
    <div class="row mb-8">
      <div class="col-md-12">
        <!-- page header -->
        <div class="d-md-flex justify-content-between align-items-center">
          <div>
            <h2>Produtos</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Painel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produtos</li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar Produto</a>
          </div>
        </div>
      </div>
    </div>
    <!-- row -->
    <div class="row ">
      <div class="col-xl-12 col-12 mb-5">
        <!-- card -->
        <div class="card h-100 card-lg">
          <div class="px-6 py-6 ">
            <div class="row justify-content-between">
              <!-- form -->
              <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                <form class="d-flex" role="search" method="get" action="{{ route('products.index') }}">
                  <input class="form-control" type="search" placeholder="Pesquisar Produtos" name="search">
                  <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                </form>
              </div>
              <!-- select option -->
              <div class="col-lg-2 col-md-4 col-12">
                <select class="form-select">
                  <option selected>Status</option>
                  <option value="1">Ativado</option>
                  <option value="2">Desativado</option>
                  <option value="3">Rascunho</option>
                </select>
              </div>
            </div>
          </div>
          <!-- card body -->
          <div class="card-body p-0">
            <!-- table -->
            <div class="table-responsive">
              <table class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
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
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Preço</th>
                    <th>Criado em</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($products as $product)
                  <tr>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="productOne">
                        <label class="form-check-label" for="productOne">

                        </label>
                      </div>
                    </td>
                    <td>
                      <a href="#!">
                        <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}"
                          alt="Imagem do Produto" class="icon-shape icon-md">
                      </a>
                    </td>
                    <td><a href="#" class="text-reset">{{ $product->title }}</a></td>
                    <td>{{ $product->category->name }}</td>

                    <td>
                      <span
                        class="badge {{ $product->status == 'ativo' ?  'bg-light-primary' : 'bg-light-danger'}}  text-dark-primary">{{
                        $product->status }}</span>
                    </td>
                    <td>{{ 'R$' . number_format($product->regular_price, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M Y') }}</td>
                    <td>
                      <div class="dropdown">
                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="feather-icon icon-more-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li>
                            {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal"
                              data-bs-target="#confirm-deletion"
                              onclick="showDeleteModal('{{ $category->name }}', '{{ route('categories.destroy', $category->id) }}')"><i
                                class="bi bi-trash me-3"></i>Excluir</a> --}}
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}"><i
                                class="bi bi-pencil-square me-3 "></i>Editar</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">Nenhum Produto Encontrado.</td>
                  </tr>
                  @endforelse

                </tbody>
              </table>

            </div>
          </div>
          <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
            <span class="mb-2 mb-md-0">Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{
              $products->total() }} resultados</span>
            <nav class="mt-2 mt-md-0">
              {{ $products->appends([
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
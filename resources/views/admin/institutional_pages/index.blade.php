@extends('admin.layouts.dashboard')
@section('title', 'Páginas Institucionais')

@section('links')
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<main class="main-content-wrapper">
  <div class="container">
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <div>
            <h2>Páginas Institucionais</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Páginas Institucionais</li>
              </ol>
            </nav>
          </div>
          <div>
            <a href="{{ route('institutional-pages.create') }}" class="btn btn-primary">Adicionar Página</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-12 mb-5">
        <div class="card h-100 card-lg">
          <div class="px-6 py-6">
            <div class="row justify-content-between">
              <div class="col-lg-4 col-md-6 col-12">
                <form class="d-flex" role="search" method="get" action="{{ route('institutional-pages.index') }}">
                  <input class="form-control" type="search" placeholder="Pesquisar por título ou slug" name="search" value="{{ request('search') }}">
                  <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                </form>
              </div>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-centered table-hover mb-0 text-nowrap table-borderless">
                <thead class="bg-light">
                  <tr>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Atualizada em</th>
                    <th class="text-end"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($pages as $page)
                    <tr>
                      <td>{{ $page->title }}</td>
                      <td><span class="text-muted small">{{ $page->slug }}</span></td>
                      <td>
                        <span class="badge bg-light-{{ $page->is_active ? 'primary' : 'danger' }}">
                          {{ $page->is_active ? 'Ativa' : 'Inativa' }}
                        </span>
                      </td>
                      <td>{{ $page->updated_at?->format('d/m/Y H:i') }}</td>
                      <td class="text-end">
                        <div class="dropdown">
                          @include('admin.partials.delete_modal')

                          <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="feather-icon icon-more-vertical fs-5"></i>
                          </a>
                          <ul class="dropdown-menu">
                            <li>
                              <a class="dropdown-item" href="{{ route('institutional-pages.edit', $page) }}">
                                <i class="bi bi-pencil-square me-3"></i>Editar
                              </a>
                            </li>
                            <li>
                              <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#confirm-deletion"
                                onclick="showDeleteModal('{{ $page->title }}', '{{ route('institutional-pages.destroy', $page) }}')">
                                <i class="bi bi-trash me-3"></i>Excluir
                              </a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center py-5">Nenhuma página encontrada.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          @if ($pages->hasPages())
            <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
              <span class="mb-2 mb-md-0">
                Mostrando {{ $pages->firstItem() }} a {{ $pages->lastItem() }} de {{ $pages->total() }} resultados
              </span>
              <nav class="mt-2 mt-md-0">
                {{ $pages->appends(['search' => request('search')])->links() }}
              </nav>
            </div>
          @endif
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
    document.addEventListener('DOMContentLoaded', function () {
      const status = @json(session('status'));
      const error = @json(session('error'));

      if (typeof toastr !== 'undefined') {
        toastr.options = {
          positionClass: "toast-top-right",
          closeButton: true,
          progressBar: true,
          timeOut: 5000,
        };

        if (status === 'institutional-page-created') {
          toastr.success('Página criada com sucesso.');
        }

        if (status === 'institutional-page-updated') {
          toastr.success('Página atualizada com sucesso.');
        }

        if (status === 'institutional-page-deleted') {
          toastr.success('Página excluída com sucesso.');
        }

        if (error) {
          toastr.error(error);
        }
      }
    });
  </script>
@endsection

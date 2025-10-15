@extends('admin.layouts.dashboard')
@section('title', 'Criar Página Institucional')

@section('content')
<main class="main-content-wrapper">
  <div class="container">
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <div>
            <h2>Nova Página Institucional</h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{ route('institutional-pages.index') }}" class="text-inherit">Páginas Institucionais</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Nova Página</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-10 col-12 mb-5">
        <form action="{{ route('institutional-pages.store') }}" method="post">
          @csrf
          @include('admin.institutional_pages._form', ['submitLabel' => 'Salvar Página'])
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@section('scripts')
  <script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
  <script src="{{ asset('js/vendors/editor.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const titleInput = document.getElementById('title');
      const slugInput = document.getElementById('slug');
      const initialContent = {!! json_encode(old('content', $page->content)) !!};

      const slugify = (value) => value
        .toString()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');

      titleInput?.addEventListener('input', () => {
        if (!slugInput || slugInput.dataset.touched === 'true') {
          return;
        }

        slugInput.value = slugify(titleInput.value);
      });

      slugInput?.addEventListener('input', () => {
        const sanitized = slugify(slugInput.value);
        slugInput.value = sanitized;
        slugInput.dataset.touched = sanitized.length ? 'true' : 'false';
      });

      if (typeof quill !== 'undefined' && quill && initialContent) {
        quill.root.innerHTML = initialContent;
      }
    });
  </script>
@endsection

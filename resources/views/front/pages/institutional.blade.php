@extends('front.layouts.store')
@section('title', $page->title)
@section('description', \Illuminate\Support\Str::limit(strip_tags($page->content), 150))

@section('content')
  <section class="py-6">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
        </ol>
      </nav>

      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
          <h1 class="mb-4">{{ $page->title }}</h1>
          <article class="cms-content">
            @if ($page->content)
              {!! $page->content !!}
            @else
              <p class="text-muted">Conteúdo em atualização. Volte em breve.</p>
            @endif
          </article>
        </div>
      </div>
    </div>
  </section>
@endsection

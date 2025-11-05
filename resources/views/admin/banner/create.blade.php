@extends('admin.layouts.dashboard')
@section('title', 'Novo Banner')
@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Novo Banner</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banners.index') }}" class="text-inherit">Banners</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('banners.index') }}" class="btn btn-light">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#bannerGuide" aria-expanded="false" aria-controls="bannerGuide">
                    Guia de dimensões e limites
                </button>
                <div class="collapse mt-3" id="bannerGuide">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p class="text-muted mb-4">Consulte os tamanhos ideais e o limite de banners antes de cadastrar.</p>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle">
                                    <thead>
                                        <tr>
                                            <th>Posição</th>
                                            <th>Dimensões sugeridas</th>
                                            <th>Dimensões mobile</th>
                                            <th>Observações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($positions as $key => $config)
                                            <tr>
                                                <td><span class="fw-semibold">{{ $config['label'] ?? $key }}</span><br><small class="text-muted">{{ $key }}</small></td>
                                                <td>
                                                    @if(isset($config['dimensions']))
                                                        {{ $config['dimensions']['width'] }} x {{ $config['dimensions']['height'] }} px
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($config['mobile_dimensions']))
                                                        {{ $config['mobile_dimensions']['width'] }} x {{ $config['mobile_dimensions']['height'] }} px
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $config['notes'] ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.banner.form')
        </form>
    </div>
</main>

@endsection

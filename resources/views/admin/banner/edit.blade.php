@extends('admin.layouts.dashboard')
@section('title', 'Editar Banner')
@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Editar Banner</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banners.index') }}" class="text-inherit">Banners</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Banner #{{ $banner->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('banners.index') }}" class="btn btn-light">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.banner.form', ['banner' => $banner])
        </form>
    </div>
</main>

@endsection

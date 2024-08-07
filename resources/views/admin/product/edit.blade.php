@extends('admin.layouts.dashboard')
@section('title', 'Editar Produto')
@section('content')

@section('links')
{{--
<link href="{{ asset('libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet"> --}}

{{-- <style>
    .dropzone .dz-preview .dz-progress {
        display: none;
        /* Oculta a barra de progresso */
    }
</style> --}}

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
                        <h2>Editar Produto</h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                        class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                                        class="text-inherit">Produtos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar Produto</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- button -->
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-light">Voltar para Produtos</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- row -->
        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card mb-6 card-lg">
                        <div class="card-body p-6">
                            <h4 class="mb-4 h5">Informação do Produto</h4>
                            <div class="row">
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Título <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" placeholder="Nome do Produto"
                                        required value="{{ old('title', $product->title) }}">
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Categoria do Produto <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="category_id">
                                        <option selected disabled>Categoria do Produto</option>
                                        @foreach ($allCategories as $singleCategory)
                                        <option value="{{ $singleCategory->id }}" {{ old('category_id', $product->
                                            category_id) == $singleCategory->id ? 'selected' : '' }}>
                                            {{ $singleCategory->name }}
                                        </option>

                                        @if ($singleCategory->children)
                                        @foreach ($singleCategory->children as $childCategory)
                                        <option value="{{ $childCategory->id }}" {{ old('category_id', $product->
                                            category_id) == $childCategory->id ? 'selected' : '' }}>
                                            -- {{ $childCategory->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Slug" name="slug"
                                        value="{{ old('slug', $product->slug) }}" required>
                                    @error('slug')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Quantidade <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Quantidade" name="quantity"
                                        value="{{ old('quantity', $product->quantity) }}" required>
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Peso <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control weight" placeholder="Peso" name="weight"
                                        value="{{ old('weight', $product->weight) }}" required>
                                    @error('weight')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Largura <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dimensions" placeholder="Largura"
                                            name="width" value="{{ old('width', $product->width) }}" required>
                                        <span class="input-group-text" style="opacity: 0.7;">cm</span>
                                    </div>
                                    @error('width')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Altura <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dimensions" placeholder="Altura"
                                            name="height" value="{{ old('height', $product->height) }}" required>
                                        <span class="input-group-text" style="opacity: 0.7;">cm</span>
                                    </div>
                                    @error('height')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-6">
                                    <label class="form-label">Comprimento <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control dimensions" placeholder="Comprimento"
                                            name="length" value="{{ old('length', $product->length) }}" required>
                                        <span class="input-group-text" style="opacity: 0.7;">cm</span>
                                    </div>
                                    @error('length')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-lg-12 mt-5">
                                    <h4 class="mb-3 h5">Imagens do Produto <span class="text-danger">*</span></h4>
                                    <div class="d-block dropzone border-dashed rounded-2">
                                        <div class="fallback">
                                            <input type="file" name="images[]" multiple>
                                        </div>
                                    </div>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('images.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- Aviso sobre dimensões --}}
                                    <div class="row">
                                        <small class="text-muted ms-3">A imagem deve ser 800x600 pixels.</small>
                                        <small class="text-muted ms-3">A imagem não pode ser maior que 1 Mb.</small>
                                        <small class="text-muted ms-3">A imagem deve ser dos tipos: jpeg, png, jpg,
                                            gif.</small>
                                    </div>
                                </div>
                                <div class="mb-3 col-lg-12 mt-5">
                                    <h4 class="mb-3 h5">Descrição do Produto</h4>
                                    <div class="py-8" id="editor"></div>
                                    <input type="hidden" name="description" id="description"
                                        value="{{ old('description', $product->description) }}">
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- ... outros campos ... -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card mb-6 card-lg">
                        <div class="card-body p-6">
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" name="in_stock" role="switch"
                                    id="flexSwitchStock" {{ old('in_stock', $product->in_stock) ? 'checked' : '' }}
                                @error('in_stock')
                                autofocus @enderror>
                                <label class="form-check-label" for="flexSwitchStock">Em Estoque</label>
                            </div>
                            @error('in_stock')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div>
                                <div class="mb-3">
                                    <label class="form-label">Código do Produto</label>
                                    <input type="text" class="form-control" name="product_code"
                                        placeholder="Insira o código do produto"
                                        value="{{ old('product_code', $product->product_code) }}" @error('product_code')
                                        autofocus @enderror>
                                    @error('product_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">SKU do Produto</label>
                                    <input type="text" class="form-control" name="sku"
                                        placeholder="Insira o titulo do produto" value="{{ old('sku', $product->sku) }}"
                                        @error('sku') autofocus @enderror>
                                    @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="productSKU">Status <span
                                            class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                            value="ativo" {{ old('status', $product->status) == 'ativo' ? 'checked' : ''
                                        }}>
                                        <label class="form-check-label" for="inlineRadio1" @error('status') autofocus
                                            @enderror>Ativo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2"
                                            value="desabilitado" {{ old('status', $product->status) == 'desabilitado' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2" @error('status') autofocus
                                            @enderror>Desabilitado</label>
                                    </div>
                                </div>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6 card-lg">
                        <div class="card-body p-6">
                            <h4 class="mb-4 h5">Preço do Produto</h4>
                            <div class="mb-3">
                                <label class="form-label">Preço Regular <span class="text-danger">*</span></label>
                                <input type="text" class="form-control price" name="regular_price" placeholder="R$0.00"
                                    value="{{ old('regular_price', number_format($product->regular_price, 2, ',', '.')) }}"
                                    @error('regular_price') autofocus @enderror>
                                @error('regular_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Preço de Venda</label>
                                <input type="text" class="form-control price" name="sale_price" placeholder="R$0.00"
                                    value="{{ old('sale_price', number_format($product->sale_price, 2, ',', '.')) }}"
                                    @error('sale_price') autofocus @enderror>
                                @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-6 card-lg">
                        <div class="card-body p-6">
                            <h4 class="mb-4 h5">Metadados</h4>
                            <div class="mb-3">
                                <label class="form-label">Meta Título</label>
                                <input type="text" class="form-control" name="meta_title" placeholder="Title"
                                    value="{{ old('meta_title', $product->meta_title) }}" @error('meta_title') autofocus
                                    @enderror>
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta Descrição</label>
                                <textarea class="form-control" rows="3" name="meta_description"
                                    placeholder="Meta Descrição" @error('meta_description') autofocus
                                    @enderror>{{ old('meta_description', $product->meta_description) }}</textarea>
                                @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary">Editar Produto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

@endsection

@section('scripts')
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('js/vendors/editor.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        // Obtém a instância existente do Quill
        if (quill) {
            // Desativa o Quill temporariamente
            quill.disable();

            // Obtém o conteúdo da descrição e define no editor Quill
            var descriptionContent = {!! json_encode($product->description) !!};
            quill.root.innerHTML = descriptionContent;

            // Reativa o Quill
            quill.enable();
        }

    });
</script>
@endsection

@extends('admin.layouts.dashboard')
@section('title', 'Reajuste de Preços em Lote')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Reajuste de Preços em Lote</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
                                <li class="breadcrumb-item active">Reajuste de Preços</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar para Produtos</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Configurar Reajuste</h4>

                        <form id="adjustmentForm">
                            @csrf

                            <!-- Scope Selection -->
                            <div class="mb-4">
                                <label class="form-label">Aplicar reajuste em:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scope" id="scopeAll" value="all" checked>
                                    <label class="form-check-label" for="scopeAll">
                                        Todos os produtos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="scope" id="scopeCategory" value="category">
                                    <label class="form-check-label" for="scopeCategory">
                                        Por categoria
                                    </label>
                                </div>
                            </div>

                            <!-- Category Selection (hidden by default) -->
                            <div class="mb-4" id="categorySelection" style="display: none;">
                                <label class="form-label">Selecione as categorias:</label>
                                <div style="max-height: 200px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 4px; padding: 10px;">
                                    @foreach($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input category-checkbox" type="checkbox" name="category_ids[]"
                                               value="{{ $category->id }}" id="category{{ $category->id }}">
                                        <label class="form-check-label" for="category{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Adjustment Type -->
                            <div class="mb-4">
                                <label class="form-label">Tipo de reajuste:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="adjustment_type" id="typeIncrease" value="increase" checked>
                                    <label class="form-check-label" for="typeIncrease">
                                        <span class="text-success">Aumento (%)</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="adjustment_type" id="typeDecrease" value="decrease">
                                    <label class="form-check-label" for="typeDecrease">
                                        <span class="text-danger">Desconto (%)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Percentage -->
                            <div class="mb-4">
                                <label for="percentage" class="form-label">Porcentagem *</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="percentage" name="percentage"
                                           step="0.01" min="0.01" max="100" required>
                                    <span class="input-group-text">%</span>
                                </div>
                                <small class="form-text text-muted">Digite um valor entre 0,01% e 100%</small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" id="btnPreview" class="btn btn-primary">
                                    <i class="bi bi-eye"></i> Calcular Preview
                                </button>
                                <button type="button" id="btnApply" class="btn btn-success" style="display: none;">
                                    <i class="bi bi-check-circle"></i> Aplicar Reajuste
                                </button>
                                <button type="button" id="btnCancel" class="btn btn-secondary" style="display: none;">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="col-lg-12" id="previewCard" style="display: none;">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Preview do Reajuste</h5>
                        <small class="text-muted">Verifique os novos valores antes de aplicar</small>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong id="totalProducts">0</strong> produto(s) serão reajustados
                        </div>
                        <div class="table-responsive" style="max-height: 500px;">
                            <table class="table table-sm table-hover">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>Produto</th>
                                        <th class="text-end">Preço Regular Atual</th>
                                        <th class="text-end">Preço Regular Novo</th>
                                        <th class="text-end">Preço Promocional Atual</th>
                                        <th class="text-end">Preço Promocional Novo</th>
                                    </tr>
                                </thead>
                                <tbody id="previewTableBody">
                                    <!-- JavaScript will populate this -->
                                </tbody>
                            </table>
                        </div>
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
    let previewData = null;

    // Show/hide category selection
    $('input[name="scope"]').change(function() {
        if ($(this).val() === 'category') {
            $('#categorySelection').slideDown();
        } else {
            $('#categorySelection').slideUp();
            $('.category-checkbox').prop('checked', false);
        }
        resetPreview();
    });

    // Reset preview when form changes
    $('input[name="adjustment_type"], #percentage').on('change input', function() {
        resetPreview();
    });

    $('.category-checkbox').change(function() {
        resetPreview();
    });

    // Preview button
    $('#btnPreview').click(function() {
        const form = $('#adjustmentForm');
        const scope = $('input[name="scope"]:checked').val();

        if (scope === 'category') {
            const selectedCategories = $('.category-checkbox:checked').length;
            if (selectedCategories === 0) {
                toastr.error('Selecione pelo menos uma categoria');
                return;
            }
        }

        const percentage = $('#percentage').val();
        if (!percentage || percentage <= 0 || percentage > 100) {
            toastr.error('Digite uma porcentagem válida entre 0,01% e 100%');
            return;
        }

        const formData = new FormData(form[0]);

        $.ajax({
            url: '{{ route("products.price-adjustment.preview") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    previewData = response.preview;
                    displayPreview(response.preview, response.total_products);
                    $('#btnApply').show();
                    $('#btnCancel').show();
                    $('#btnPreview').hide();
                    toastr.success('Preview calculado com sucesso!');
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.values(errors).forEach(error => {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error('Erro ao calcular preview');
                }
            }
        });
    });

    // Apply button
    $('#btnApply').click(function() {
        if (!confirm('Tem certeza que deseja aplicar este reajuste? Esta ação não pode ser desfeita!')) {
            return;
        }

        const form = $('#adjustmentForm');
        const formData = new FormData(form[0]);

        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Aplicando...');

        $.ajax({
            url: '{{ route("products.price-adjustment.apply") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message || 'Reajuste aplicado com sucesso!');

                    // Aguarda 1.5 segundos para o usuário ver a mensagem
                    setTimeout(function() {
                        window.location.href = '{{ route("products.price-adjustment.index") }}';
                    }, 1500);
                }
            },
            error: function(xhr) {
                $('#btnApply').prop('disabled', false).html('<i class="bi bi-check-circle"></i> Aplicar Reajuste');

                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.values(errors).forEach(error => {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error('Erro ao aplicar reajuste');
                }
            }
        });
    });

    // Cancel button
    $('#btnCancel').click(function() {
        resetPreview();
    });

    function displayPreview(data, total) {
        $('#totalProducts').text(total);
        $('#previewTableBody').empty();

        data.forEach(function(item) {
            const row = `
                <tr>
                    <td>${escapeHtml(item.title)}</td>
                    <td class="text-end">R$ ${formatPrice(item.old_regular_price)}</td>
                    <td class="text-end text-primary"><strong>R$ ${formatPrice(item.new_regular_price)}</strong></td>
                    <td class="text-end">${item.old_sale_price ? 'R$ ' + formatPrice(item.old_sale_price) : '-'}</td>
                    <td class="text-end text-primary"><strong>${item.new_sale_price ? 'R$ ' + formatPrice(item.new_sale_price) : '-'}</strong></td>
                </tr>
            `;
            $('#previewTableBody').append(row);
        });

        $('#previewCard').slideDown();
        $('html, body').animate({
            scrollTop: $('#previewCard').offset().top - 100
        }, 500);
    }

    function resetPreview() {
        previewData = null;
        $('#previewCard').slideUp();
        $('#btnApply').hide();
        $('#btnCancel').hide();
        $('#btnPreview').show();
    }

    function formatPrice(value) {
        return Number(value).toFixed(2).replace('.', ',');
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Show success message if present
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
});
</script>
@endsection

@extends('front/layouts/store')
@section('title', 'Lista de Desejos')


@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<main>
    <!-- section-->
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store') }}">Loja</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Minha Lista de Desejos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <section class="mt-8 mb-14">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-8">
                        <!-- heading -->
                        <h1 class="mb-1">Minha Lista de Desejos</h1>
                        <p>Existem {{ count($favorites) }} produto{{ count($favorites) > 1 ? 's' : '' }} nesta lista de
                            desejos.</p>

                    </div>
                    <div>
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table text-nowrap table-with-checkbox">
                                <thead class="table-light">
                                    <tr>
                                        <th>
                                            <!-- form check -->
                                            <div class="form-check">
                                                <!-- input --><input class="form-check-input" type="checkbox" value=""
                                                    id="checkAll">
                                                <!-- label --><label class="form-check-label" for="checkAll">

                                                </label>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>Produtos</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($favorites as $favorite)
                                    <tr>
                                        <td class="align-middle">
                                            <!-- form check -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="chechbox{{ $favorite->id }}">
                                                <label class="form-check-label"
                                                    for="chechbox{{ $favorite->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#">
                                                @if($favorite->productImages->isNotEmpty())
                                                <img src="{{ asset('storage/' . $favorite->productImages->first()->image_path) }}"
                                                    class="icon-shape icon-xxl" alt="{{ $favorite->title }}">
                                                @else
                                                <img src="{{ asset('images/products/default-product.jpg') }}"
                                                    class="icon-shape icon-xxl" alt="{{ $favorite->title }}">
                                                @endif
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <div>
                                                <h5 class="fs-6 mb-0">
                                                    <a href="#" class="text-inherit">{{ $favorite->title }}</a>
                                                </h5>
                                                <small>R${{ number_format($favorite->regular_price, 2, ',', '.')
                                                    }}</small>
                                            </div>
                                        </td>
                                        <td class="align-middle">R${{ number_format($favorite->regular_price, 2, ',',
                                            '.') }}</td>
                                        <td class="align-middle">
                                            <span class="badge {{ $favorite->in_stock ? 'bg-success' : 'bg-danger' }}">
                                                {{ $favorite->in_stock ? 'Em Estoque' : 'Fora de Estoque' }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('cart.add-product-to-cart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $favorite->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-primary btn-sm ">Adicionar ao
                                                    Carrinho </button>
                                            </form>
                                        </td>

                                        <td class="align-middle">
                                            <a href="#" class="text-muted remove-favorite"
                                                data-product-id="{{ $favorite->id }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Remover">
                                                <i class="feather-icon icon-trash-2"></i>
                                            </a>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <p>Você não tem produtos favoritos no momento.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
</main>

@endsection

@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).on('click', '.remove-favorite', function(e) {
    e.preventDefault();

    var productId = $(this).data('product-id');
    var $this = $(this);

    $.ajax({
        url: '/favoritos/remove/' + productId,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                $this.closest('tr').remove();

                toastr.success('Produto removido com sucesso!');

                setTimeout(function() {
                    location.reload();
                }, 1000);


            }
        },
        error: function() {
            toastr.error('Erro ao remover o produto.');
        }
    });
});

</script>
@endsection

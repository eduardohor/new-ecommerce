@extends('admin.layouts.dashboard')
@section('title', 'Novo Pedido')

@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
<style>
    .ts-dropdown {
        background-color: #fff;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        opacity: 1;
    }

    .ts-dropdown .option {
        background-color: #fff;
    }

    .ts-dropdown .active {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div>
                    <h2>Gerar Pedido</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                    class="text-inherit">Painel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}"
                                    class="text-inherit">Clientes</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.edit', $customer->id) }}"
                                    class="text-inherit">{{ $customer->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Novo Pedido</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if ($addresses->isEmpty())
        <div class="alert alert-warning">
            Este cliente ainda nao possui endereco cadastrado.
        </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

            <div class="row g-5">
                <div class="col-lg-8 col-12">
                    <div class="card card-lg border-0">
                        <div class="card-body p-6">
                            <h4 class="mb-4 h6">Itens do Pedido</h4>
                            <div class="table-responsive mb-5">
                                <table class="table table-centered table-borderless mb-0 text-nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Produto</th>
                                            <th style="width: 160px;">Quantidade</th>
                                            <th style="width: 120px;">Acao</th>
                                        </tr>
                                    </thead>
                                    <tbody id="order-items">
                                        <tr class="order-item">
                                            <td>
                                                <select class="form-select product-select" name="items[0][product_id]" data-placeholder="Selecione um produto" required>
                                                    <option value=""></option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->title }} (R$
                                                        {{ number_format($product->getFinalPrice(), 2, ',', '.') }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control quantity-input"
                                                    name="items[0][quantity]" min="1" step="1" inputmode="numeric"
                                                    pattern="[0-9]*" value="1" required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light remove-item" disabled>
                                                    Remover
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-5">
                                <button type="button" class="btn btn-outline-primary" id="add-item">
                                    Adicionar item
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="card card-lg border-0">
                        <div class="card-body p-6 d-flex flex-column gap-4">
                            <div>
                                <h4 class="mb-0 h6">Cliente e Entrega</h4>
                            </div>
                            <div>
                                <label class="form-label">Cliente</label>
                                <div class="form-control-plaintext">{{ $customer->name }}</div>
                            </div>
                            <div>
                                <label class="form-label" for="address_id">Endereco de entrega</label>
                                <select class="form-select address-select" id="address_id" name="address_id" data-placeholder="Selecione um endereco" required>
                                    @foreach ($addresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->street }}, {{ $address->number }} - {{ $address->city }}/{{ $address->state }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="border rounded-3 p-3 bg-light">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-shop"></i>
                                    <div>
                                        <div class="fw-semibold">Retirada na loja</div>
                                        <small class="text-muted">Frete gratis</small>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="form-label" for="payment_type">Forma de pagamento</label>
                                <select class="form-select" id="payment_type" name="payment_type" required>
                                    <option value="credit_card">Cartao de Credito</option>
                                    <option value="bank_transfer">Pix</option>
                                    <option value="manual">Dinheiro</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="payment_status">Status do pagamento</label>
                                <select class="form-select" id="payment_status" name="payment_status" required>
                                    <option value="pending">Pendente</option>
                                    <option value="completed">Pago</option>
                                    <option value="failed">Falhou</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="notes">Observacoes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit" @if ($addresses->isEmpty()) disabled @endif>
                                    Gerar pedido
                                </button>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-secondary mt-2">
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<template id="order-item-template">
    <tr class="order-item">
        <td>
            <select class="form-select product-select" data-placeholder="Selecione um produto" required>
                <option value=""></option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->title }} (R$
                    {{ number_format($product->getFinalPrice(), 2, ',', '.') }})
                </option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="number" class="form-control quantity-input" min="1" step="1" inputmode="numeric"
                pattern="[0-9]*" value="1" required>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-light remove-item">Remover</button>
        </td>
    </tr>
</template>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    $(function() {
        const $addButton = $('#add-item');
        const template = document.getElementById('order-item-template');
        let itemIndex = 1;

        const initProductSelect = (element) => {
            if (!element || element.tomselect) {
                return;
            }

            const instance = new TomSelect(element, {
                create: false,
                allowEmptyOption: true,
                maxItems: 1,
                placeholder: element.dataset.placeholder,
                dropdownParent: 'body',
                render: {
                    no_results: function() {
                        return '<div class="no-results">Nenhum resultado encontrado</div>';
                    }
                },
            });

            if (!element.value) {
                instance.clear(true);
            }
        };

        const initAddressSelect = (element) => {
            if (!element || element.tomselect) {
                return;
            }

            const instance = new TomSelect(element, {
                create: false,
                allowEmptyOption: true,
                maxItems: 1,
                placeholder: element.dataset.placeholder || 'Selecione um endereco',
                dropdownParent: 'body',
                render: {
                    no_results: function() {
                        return '<div class="no-results">Nenhum resultado encontrado</div>';
                    }
                },
            });

            if (!element.value) {
                instance.clear(true);
            }
        };

        const toggleRemoveButtons = () => {
            const $buttons = $('#order-items').find('.remove-item');
            $buttons.each(function(index) {
                $(this).prop('disabled', $buttons.length === 1 && index === 0);
            });
        };

        $('.product-select').each(function() {
            initProductSelect(this);
        });

        $('.address-select').each(function() {
            initAddressSelect(this);
        });

        $(document).on('click', '#add-item', function() {
            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('tr');
            const select = row.querySelector('select');
            const quantity = row.querySelector('input');

            select.name = `items[${itemIndex}][product_id]`;
            quantity.name = `items[${itemIndex}][quantity]`;

            $('#order-items').append(row);
            initProductSelect(select);
            itemIndex += 1;
            toggleRemoveButtons();
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
            toggleRemoveButtons();
        });

        $(document).on('input', '.quantity-input', function() {
            const digitsOnly = $(this).val().toString().replace(/\D+/g, '');
            $(this).val(digitsOnly === '' ? '' : parseInt(digitsOnly, 10));
        });
    });
</script>
@endsection

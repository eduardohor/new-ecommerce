@extends('admin.layouts.dashboard')
@section('title', 'Clientes')



@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection


@section('content')

@php
use Carbon\Carbon;

Carbon::setLocale('pt_BR');
@endphp

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Editar Cliente {{ $customer->name }}</h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                        class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('customers.index') }}"
                                        class="text-inherit">Clientes</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        @include('admin.partials.delete_modal')

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirm-deletion"
                            onclick="showDeleteModal('{{ $customer->name }}', '{{ route('customers.destroy', $customer->id) }}')">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-8 g-5">
            <div class="col-lg-8 col-12">
                <div class="card card-lg border-0">
                    <div class="card-body d-flex flex-column gap-8 p-7">
                        <form action="{{ route('customers.update', $customer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div
                                class="d-flex flex-column flex-md-row align-items-center mb-4 file-input-wrapper gap-2">
                                <div>
                                    <img class="image avatar avatar-lg rounded-3"
                                        src="{{ $customer->profile_image ? asset('storage/' . $customer->profile_image) : asset('images/docs/placeholder-img.jpg') }}"
                                        alt="Image" />
                                </div>

                                <div class="file-upload btn btn-light ms-md-4">
                                    <input type="file" class="file-input opacity-0" name="profile_image"
                                        @error('profile_image') autofocus @enderror />
                                    Carregar Foto
                                </div>

                                <span class="ms-2">JPG, GIF or PNG. 1MB Max.</span>
                            </div>
                            @error('profile_image')
                            <span class="text-danger ms-3">{{ $message }}</span>
                            @enderror
                            <div class="d-flex flex-column gap-4">
                                <h3 class="mb-0 mt-5 h6">Informações do Cliente</h3>
                                <div class="row g-3">
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <!-- input -->
                                            <label for="creatCustomerName" class="form-label">
                                                Nome
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="creatCustomerName" name="name"
                                                placeholder="Nome do Cliente" @error('name') autofocus @enderror
                                                value="{{ old('name', $customer->name) }}" required />
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <!-- input -->
                                            <label for="creatCustomerEmail" class="form-label">
                                                Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="creatCustomerEmail"
                                                name="email" placeholder="E-mail" @error('email') autofocus @enderror
                                                value="{{ old('email', $customer->email) }}" required />
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <!-- input -->
                                            <label for="creatCustomerDocument" class="form-label">Documento<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control document" id="creatCustomerDocument"
                                                placeholder="CPF ou CNPJ" name="document" @error('document') autofocus
                                                @enderror value="{{ old('document', $customer->document) }}" required />
                                            @error('document')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <!-- input -->
                                            <label for="creatCustomerPhone" class="form-label">Número</label>
                                            <input type="text" class="form-control phone" id="creatCustomerPhone"
                                                placeholder="Número do Telefone" name="phone" @error('phone') autofocus
                                                @enderror value="{{ old('phone', $customer->phone) }}" />
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="form-label" for="creatCustomerDate">Data de Nascimento</label>
                                        <input type="text" class="form-control flatpickr" id="creatCustomerDate"
                                            name="birthdate" @error('birthdate') autofocus @enderror
                                            value="{{ old('birthdate', $customer->birthdate) }}"
                                            placeholder="Selecione a Data" data-date-format="d/m/Y" />
                                        @error('birthdate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="col-12 mt-3">
                                            <div class="d-flex flex-column flex-md-row gap-2">
                                                <button class="btn btn-primary" type="submit">Atualizar
                                                    Cliente</button>
                                                <a href="{{ route('customers.index') }}" class="btn btn-secondary"
                                                    type="submit">Cancelar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card card-lg border-0">
                    <div class="card-body p-6 d-flex flex-column gap-6">
                        <div>
                            <h4 class="mb-0 h6">Detalhes do Cliente</h4>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fw-medium text-dark">Criado em</span>
                                <span class="fw-medium">{{ $customer->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fw-medium text-dark">Atualizado em</span>
                                <span class="fw-medium">{{ $customer->updated_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Cadastro de Endereço-->
        @include('admin.partials.modal-address', [
        'modalId' => 'address',
        'modalTitle' => 'Cadastrar Endereço',
        'formAction' => route('customers.store.address', $customer->id),
        'formId' => 'formAddress',
        'submitButtonText' => 'Cadastrar'
        ])

        <!-- Modal de Cadastro de Pagamento-->
        {{-- @include('admin.partials.modal-payment', [
        'modalId' => 'payment',
        'modalTitle' => 'Cadastrar Pagamento',
        'formAction' => route('customers.store.payment', $customer->id),
        'formId' => 'formPayment',
        'submitButtonText' => 'Cadastrar'
        ]) --}}

        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="nav nav-pills justify-content-center mb-6 bg-white border d-inline-flex rounded-3 p-2"
                    id="myTab" role="tablist">
                    <!-- nav item -->
                    <li class="nav-item" role="presentation">
                        <!-- btn -->
                        <button class="nav-link active" id="address-tab" data-bs-toggle="tab"
                            data-bs-target="#address-tab-pane" type="button" role="tab" aria-controls="address-tab-pane"
                            aria-selected="true">
                            Endereço
                        </button>
                    </li>
                    <!-- nav item -->
                    <li class="nav-item" role="presentation">
                        <!-- btn -->
                        <button class="nav-link" id="payment-tab" data-bs-toggle="tab"
                            data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane"
                            aria-selected="false">
                            Pagamento
                        </button>
                    </li>
                </ul>

                <!-- tab content -->
                <div class="tab-content" id="myTabContent">
                    <!-- tab pane -->
                    <div class="tab-pane fade show active" id="address-tab-pane" role="tabpanel"
                        aria-labelledby="address-tab" tabindex="0">
                        <div class="card h-100 card-lg">
                            <div class="p-6">
                                <div class="d-flex justify-content-between flex-row align-items-center">
                                    <div>
                                        <h3 class="mb-0 h6">Endereços</h3>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#address">Novo Endereço</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="addressOne" />
                                                        <label class="form-check-label" for="addressOne"></label>
                                                    </div>
                                                </th>
                                                <th>Rua</th>
                                                <th>Estado</th>
                                                <th>Cidade</th>
                                                <th>CEP</th>

                                                <th>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($addresses as $address)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="addressTwo" />
                                                        <label class="form-check-label" for="addressTwo"></label>
                                                    </div>
                                                </td>

                                                <td>{{ $address->number }}, {{ $address->street }}</td>

                                                <td>{{ $address->state }}</td>
                                                <td>{{ $address->city }}</td>
                                                <td class="cep">{{ $address->zip_code }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#confirm-deletion"
                                                                    onclick="showDeleteModal('{{ $address->name }}', '{{ route('customers.destroy.address', $address->id) }}')">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Excluir
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#addressEdit_{{ $address->id }}">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Editar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6">Nenhum endereço encontrado</td>
                                            </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Mostrando {{ $addresses->firstItem() }} a {{ $addresses->lastItem() }} de {{
                                        $addresses->total() }} resultados</span>
                                    <nav class="mt-2 mt-md-0">
                                        {{ $addresses->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tab pane -->
                    <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab"
                        tabindex="0">
                        <div class="card h-100 card-lg">
                            <div class="p-6">
                                <div class="d-flex justify-content-between flex-row align-items-center">
                                    <div>
                                        <h3 class="mb-0 h6">Pagamentos</h3>
                                    </div>
                                    {{-- <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#payment">Novo Pagamento</button>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentOne" />
                                                        <label class="form-check-label" for="paymentOne"></label>
                                                    </div>
                                                </th>
                                                <th>Nº Pedido</th>
                                                <th>Id da Transação</th>
                                                <th>Data</th>
                                                <th>Valor</th>
                                                <th>Método</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($payments as $payment)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentTwo" />
                                                        <label class="form-check-label" for="paymentTwo"></label>
                                                    </div>
                                                </td>

                                                <td>#{{ $payment->order->order_number }}</td>
                                                <td>{{ $payment->transaction_id }}</td>
                                                <td>{{ $payment->created_at->translatedFormat('d M Y') }}</td>
                                                <td>R${{ number_format($payment->amount, 2, ',', '.') }}</td>
                                                @if ($payment->payment_type == 'credit_card')
                                                <td>Cartão de Crédito</td>
                                                @elseif($payment->payment_type == 'bank_transfer')
                                                <td>Pix</td>
                                                @endif

                                                @if ($payment->status == 'completed')
                                                <td>
                                                    <span
                                                        class="badge bg-light-success text-dark-success">Completo</span>
                                                </td>
                                                @elseif ($payment->status == 'pending')
                                                <td>
                                                    <span
                                                        class="badge bg-light-warning text-dark-warning">Pendente</span>
                                                </td>
                                                @elseif ($payment->status == 'failed')
                                                <td>
                                                    <span class="badge bg-light-danger text-dark-danger">Falhou</span>
                                                </td>
                                                @endif
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8">Nenhum pagamento encontrado</td>
                                            </tr>

                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Mostrando {{ $payments->firstItem() }} a {{ $payments->lastItem() }} de {{
                                        $payments->total() }} resultados</span>
                                    <nav class="mt-2 mt-md-0">
                                        {{ $payments->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal de Edição -->
@foreach($customer->addresses as $address)
@include('admin.partials.modal-address', [
'modalId' => 'addressEdit_' . $address->id,
'modalTitle' => 'Editar Endereço',
'formAction' => route('customers.update.address', $address->id),
'formId' => 'formAddressEdit_' . $address->id,
'submitButtonText' => 'Salvar',
'address' => $address
])
@endforeach


@endsection

@section('scripts')

<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('js/vendors/editor.js') }}"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        let error = "{{ session('error') }}";
        let warning = "{{ session('warning') }}";
        let success = "{{ session('success') }}";

        if (error) {
            toastr.error(error);
        }

        if (warning) {
            toastr.warning(warning);
        }

        if (success) {
            toastr.success(success);
        }

        // Opções do Flatpickr
        flatpickr(".flatpickr", {
            locale: "pt",  // Definir o idioma como "pt" para português
        });

    });
</script>

@endsection

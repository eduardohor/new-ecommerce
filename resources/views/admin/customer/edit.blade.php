@extends('admin.layouts.dashboard')
@section('title', 'Clientes')
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
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete">Delete</button>
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
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#payment">Novo Pagamento</button>
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

                                                <td>
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
                                                </td>
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
<!-- Modal -->
<div class="modal fade" id="address" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addressLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="addressLabel">Create address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form class="row needs-validation g-3" novalidate>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerEditAdd" class="form-label">Street</label>
                        <input type="text" class="form-control" id="customerEditAdd" placeholder="Street Address"
                            required />
                        <div class="invalid-feedback">Please enter address</div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerZip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="customerZip" placeholder="Enter Zip" required />
                        <div class="invalid-feedback">Please enter zip</div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerCity" class="form-label">City</label>
                        <input type="text" class="form-control" id="customerCity" placeholder=" City" required />
                        <div class="invalid-feedback">Please enter city</div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerCity" class="form-label">State</label>
                        <input type="text" class="form-control" id="customerState" placeholder=" State" required />
                        <div class="invalid-feedback">Please enter state</div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <label for="customerCountry" class="form-label">Country</label>
                        <select class="form-select" id="customerCountry" required>
                            <option selected disabled value="">Country</option>
                            <option value="India">India</option>
                            <option value="UK">UK</option>
                            <option value="USA">USA</option>
                        </select>
                        <div class="invalid-feedback">Please select a valid state.</div>
                    </div>
                </form>
            </div>
            <div class="d-flex flex-row gap-3">
                <button type="button" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="paymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="paymentLabel">Create payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form class="row needs-validation g-3" novalidate>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerpayment" class="form-label">Order*</label>
                        <input type="text" class="form-control" id="customerpayment" placeholder="Order Id" required />
                        <div class="invalid-feedback">Please enter order id</div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerTransction" class="form-label">Transaction Id</label>
                        <input type="number" class="form-control" id="customerTransction" placeholder="Transaction Id"
                            required />
                        <div class="invalid-feedback">Please enter transaction id</div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerAmount" class="form-label">Amount*</label>
                        <input type="text" class="form-control" id="customerAmount" placeholder=" Amount" required />
                        <div class="invalid-feedback">Please enter city</div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <label for="customerStatus" class="form-label">Status*</label>
                        <select class="form-select" id="customerStatus" required>
                            <option selected disabled value="">Status</option>
                            <option value="Complete">Complete</option>
                            <option value="Failed">Failed</option>
                            <option value="Pending">Pending</option>
                        </select>
                        <div class="invalid-feedback">Please select a valid status.</div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <span class="fw-medium text-dark mb-0">Method*</span>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                                checked />
                            <label class="btn btn-outline-primary" for="btnradio1">Credit Card</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" />
                            <label class="btn btn-outline-secondary" for="btnradio2">Bank Transfer</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" />
                            <label class="btn btn-outline-secondary" for="btnradio3">PayPal</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-flex flex-row gap-3">
                <button type="button" class="btn btn-primary">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="d-flex flex-column align-items-center d-flex flex-column gap-6">
                    <div class="bg-danger rounded-circle icon-xl bg-light-danger text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-trash3-fill text-danger" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                        </svg>
                    </div>
                    <div class="d-flex flex-column gap-2 text-center">
                        <h3 class="mb-0 h4">Delete Customer name</h3>
                        <p class="mb-0">are you sure you would like to to this?</p>
                    </div>
                    <div class="d-flex flex-row gap-2">
                        <a href="#!" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</a>
                        <a href="#!" class="btn btn-danger">Confim</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('scripts')

<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
<script src="{{ asset('libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('js/vendors/editor.js') }}"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    // Opções do Flatpickr
    flatpickr(".flatpickr", {
      locale: "pt",  // Definir o idioma como "pt" para português

    });
</script>

@endsection

@extends('admin.layouts.dashboard')
@section('title', 'Clientes')
@section('content')

<main class="main-content-wrapper">
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div>
                    <h2>Create Customer</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                    class="text-inherit">Painel</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}"
                                    class="text-inherit">Clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar Novo Cliente</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-body d-flex flex-column gap-8 p-7">
                        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div
                                class="d-flex flex-column flex-md-row align-items-center mb-4 file-input-wrapper gap-2">
                                <div>
                                    <img class="image avatar avatar-lg rounded-3"
                                        src="{{ asset('images/docs/placeholder-img.jpg') }}" alt="Image" />
                                </div>

                                <div class="file-upload btn btn-light ms-md-4">
                                    <input type="file" class="file-input opacity-0" name="profile_image"
                                        @error('profile_image') autofocus @enderror/>
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
                                                value="{{ old('name') }}" required />
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
                                                value="{{ old('email') }}" required />
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
                                                @enderror value="{{ old('document') }}" required />
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
                                                @enderror value="{{ old('phone') }}" />
                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="form-label" for="creatCustomerDate">Data de Nascimento</label>
                                        <input type="text" class="form-control flatpickr" id="creatCustomerDate"
                                            name="birthdate" @error('birthdate') autofocus @enderror
                                            value="{{ old('birthdate') }}" placeholder="Selecione a Data" data-date-format="d/m/Y"/>
                                        @error('birthdate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="col-12 mt-3">
                                            <div class="d-flex flex-column flex-md-row gap-2">
                                                <button class="btn btn-primary" type="submit">Criar Novo
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
        </div>
    </div>
</main>

@endsection

@section('scripts')

<script src="{{ asset('libs/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
<script src="{{ asset('js/theme.min.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    flatpickr(".flatpickr", {
        locale: "pt",

    });
</script>

@endsection

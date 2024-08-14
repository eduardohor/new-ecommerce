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
                        <h2>Configurações da Loja </h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                        class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Configurações da Loja</li>
                            </ol>
                        </nav>
                    </div>
                    {{-- <div>
                        @include('admin.partials.delete_modal')

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirm-deletion"
                            onclick="showDeleteModal('{{ $customer->name }}', '{{ route('customers.destroy', $customer->id) }}')">Excluir</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row mb-8 g-5">
            <div class="col-lg-8 col-12">
                <div class="card card-lg border-0">
                    <div class="card-body d-flex flex-column gap-8 p-7">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div
                                class="d-flex flex-column flex-md-row align-items-center mb-4 file-input-wrapper gap-2">
                                <div>
                                    <img class="image"
                                        src="{{ $storeInfo && $storeInfo->logo ? asset('storage/' . $storeInfo->logo) : asset('images/docs/bg-logo.png') }}"
                                        alt="Image" style="width:170px; height=40px"/>
                                </div>

                                <div class="file-upload btn btn-light ms-md-4">
                                    <input type="file" class="file-input opacity-0" name="logo" @error('logo') autofocus
                                        @enderror />
                                    Carregar Logo
                                </div>
                                <span class="ms-2 text-danger text-center">JPG, GIF ou PNG. 2MB Max. Dimensões(170x40)</span>
                            </div>
                            @error('logo')
                            <span class="text-danger ms-3">{{ $message }}</span>
                            @enderror

                            <div class="d-flex flex-column gap-4">
                                <h3 class="mb-0 mt-5 h6">Informações do Cliente</h3>
                                <div class="row g-3">
                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label for="name" class="form-label">
                                                Nome
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nome da Loja"
                                                value="{{ old('name', $storeInfo->name ?? '') }}" required />
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label for="email" class="form-label">
                                                E-mail
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="E-mail da loja"
                                                value="{{ old('email', $storeInfo->email ?? '') }}" required />
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label for="contactNumber" class="form-label">
                                                Contato
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control phone" id="contactNumber"
                                                name="contact_number" placeholder="Número para Contato"
                                                value="{{ old('contact_number', $storeInfo->contact_number ?? '') }}"
                                                required />
                                            @error('contact_number')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label for="zipCode" class="form-label">
                                                CEP
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control cep" id="zipCode" name="zip_code"
                                                placeholder="CEP"
                                                value="{{ old('zip_code', $storeInfo->zip_code ?? '') }}" required />
                                            @error('zip_code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <div>
                                            <label for="state" class="form-label">Estado</label>
                                            <select class="form-control" name="state" id="state" required>
                                                <option value="" disabled selected>Selecione o Estado</option>
                                                @foreach(['AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' =>
                                                'Amazonas',
                                                'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
                                                'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
                                                'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas
                                                Gerais',
                                                'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' =>
                                                'Pernambuco',
                                                'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do
                                                Norte',
                                                'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
                                                'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe',
                                                'TO' => 'Tocantins'] as $abbr => $state)
                                                <option value="{{ $abbr }}" {{ old('state', $storeInfo->state ?? '') ==
                                                    $abbr ? 'selected' : '' }}>
                                                    {{ $state }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="form-label" for="city">Cidade</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            placeholder="Cidade" value="{{ old('city', $storeInfo->city ?? '') }}" />
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="address">Endereço</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Endereço Completo"
                                            value="{{ old('address', $storeInfo->address ?? '') }}" />
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-3">
                                        <div class="d-flex flex-column flex-md-row gap-2">
                                            <button class="btn btn-primary" type="submit">Atualizar</button>
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
                            <h4 class="mb-0 h6">Detalhes da Loja</h4>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fw-medium text-dark">Criada em</span>
                                <span class="fw-medium">
                                    <i class="ri-calendar-line"></i>
                                    {{ $storeInfo && $storeInfo->created_at ?
                                    $storeInfo->created_at->translatedFormat('d M Y') : 'N/A' }}
                                </span>
                            </div>
                            <div class="d-flex flex-row justify-content-between">
                                <span class="fw-medium text-dark">Atualizada em</span>
                                <span class="fw-medium">
                                    <i class="ri-refresh-line"></i>
                                    {{ $storeInfo && $storeInfo->updated_at ?
                                    $storeInfo->updated_at->translatedFormat('d M Y') : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

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

    //Buscar endereco por cep
    $('#zipCode').blur(function() {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                fetch("https://viacep.com.br/ws/" + cep + "/json/")
                    .then(response => response.json())
                    .then(dados => {
                        if (!dados.erro) {
                            $('#state').val(dados.uf);
                            $('#neighborhood').val(dados.bairro);
                            $('#complement').val(dados.complemento);
                            $('#city').val(dados.localidade);
                            $('#street').val(dados.logradouro);
                        } else {
                            alert("CEP não encontrado.");
                        }
                    })
                    .catch(error => {
                        alert("Erro ao buscar o CEP. Tente novamente mais tarde.");
                        console.error("Erro:", error);
                    });
            } else {
                alert("Formato de CEP inválido.");
            }
        }
    });
</script>

@endsection

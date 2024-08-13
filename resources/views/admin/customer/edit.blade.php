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
                <div>
                    <h2>Create Customer</h2>
                    <!-- breacrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow border-0">
                    <div class="card-body d-flex flex-column gap-8 p-7">
                        <div class="d-flex flex-column flex-md-row align-items-center mb-4 file-input-wrapper gap-2">
                            <div>
                                <img class="image avatar avatar-lg rounded-3" src="{{ asset('images/docs/placeholder-img.jpg') }}" alt="Image" />
                            </div>

                            <div class="file-upload btn btn-light ms-md-4">
                                <input type="file" class="file-input opacity-0" />
                                Upload Photo
                            </div>

                            <span class="ms-2">JPG, GIF or PNG. 1MB Max.</span>
                        </div>
                        <div class="d-flex flex-column gap-4">
                            <h3 class="mb-0 h6">Customer Information</h3>
                            <form class="row g-3 needs-validation" novalidate>
                                <div class="col-lg-6 col-12">
                                    <div>
                                        <!-- input -->
                                        <label for="creatCustomerName" class="form-label">
                                            Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="creatCustomerName" placeholder="Customer Name" required />
                                        <div class="invalid-feedback">Please enter customer name</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div>
                                        <!-- input -->
                                        <label for="creatCustomerEmail" class="form-label">
                                            Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" id="creatCustomerEmail" placeholder="Email Address" required />
                                        <div class="invalid-feedback">Please enter email</div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div>
                                        <!-- input -->
                                        <label for="creatCustomerPhone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="creatCustomerPhone" placeholder="Number" required />
                                        <div class="invalid-feedback">Please enter phone</div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <label class="form-label" for="creatCustomerDate">Birthday</label>
                                    <input type="text" class="form-control flatpickr" id="creatCustomerDate" placeholder="dd/mm/yyyy" required />
                                    <div class="invalid-feedback">Please enter date</div>
                                </div>
                                <div>
                                    <div class="col-12 mt-3">
                                        <div class="d-flex flex-column flex-md-row gap-2">
                                            <button class="btn btn-primary" type="submit">Create New Customer</button>
                                            <button class="btn btn-secondary" type="submit">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
<script>
    // Opções do Flatpickr
    flatpickr(".flatpickr", {
      locale: "pt",  // Definir o idioma como "pt" para português

    });
</script>

@endsection

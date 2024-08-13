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
                <div class="d-md-flex justify-content-between align-items-center">
                    <div>
                        <h2>Clientes</h2>
                        <!-- breacrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                        class="text-inherit">Painel</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ol>
                        </nav>
                    </div>
                    <div>
                        <a href="{{ route('customers.create') }}" class="btn btn-primary">Adicionar Novo Cliente</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">

                    <div class="p-6">
                        <div class="row justify-content-between">
                            <div class="col-md-4 col-12">
                                <form action="{{ route('customers.index') }}" class="d-flex" method="GET">
                                    <input class="form-control" type="search" placeholder="Pesquisar Clientes"
                                        name="search">
                                    <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 ">

                        <div class="table-responsive">
                            <table
                                class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                                <label class="form-check-label" for="checkAll">

                                                </label>
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Data de Compra</th>
                                        <th>Telefone</th>
                                        <th>Gastos</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                    <tr>
                                        <td class="pe-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="customerEleven">
                                                <label class="form-check-label" for="customerEleven">

                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/avatar/avatar.png') }}" alt=""
                                                    class="avatar avatar-xs rounded-circle">
                                                <div class="ms-2">
                                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                                        class="text-inherit">{{ $customer->name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $customer->email }}</td>

                                        <td>{{ $customer->created_at->translatedFormat('d M Y') }}</td>


                                        <td>{{ $customer->phone }}</td>
                                        <td>R${{ number_format($customer->total_spent, 2, ',', '.') }}</td>


                                        <td>
                                            <div class="dropdown ">
                                                <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="feather-icon icon-more-vertical fs-5"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="bi bi-trash me-3"></i>Excluir</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('customers.edit', $customer->id) }}"><i
                                                                class="bi bi-pencil-square me-3 "></i>Editar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhum cliente encontrado</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>

                        </div>

                        <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
                            <span class="mb-2 mb-md-0">Mostrando {{ $customers->firstItem() }} a {{
                                $customers->lastItem() }} de
                                {{
                                $customers->total() }} resultados</span>
                            <nav class="mt-2 mt-md-0">
                                {{ $customers->appends([
                                'search' => request()->get('search', '')
                                ])->links() }}
                            </nav>
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
    let error  = "{{ session('error') }}";
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

  });
</script>

@endsection

@extends('admin.layouts.dashboard')
@section('title', 'Usuários')
@section('content')

<main class="main-content-wrapper">
  <div class="container">
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <div>
            <h2>Usuários</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Painel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuários</li>
              </ol>
            </nav>
          </div>
          <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Novo Usuário</a>
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
                <form action="{{ route('users.index') }}" class="d-flex" method="GET">
                  <input class="form-control" type="search" placeholder="Pesquisar Clientes" name="search">
                  <button class="btn btn-primary ms-3" type="submit">Pesquisar</button>
                </form>
              </div>
            </div>
          </div>
          <div class="card-body p-0 ">

            <div class="table-responsive">
              <table class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
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
                    <th>Data de Cadastro</th>
                    <th>Telefone</th>
                    <th>Tipo de Acesso</th>

                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="customerOne">
                        <label class="form-check-label" for="customerOne">

                        </label>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex align-items-center">
                        <img src="{{ asset('images/avatar/avatar.png') }}" alt=""
                          class="avatar avatar-xs rounded-circle">
                        <div class="ms-2">
                          <a href="{{ route('users.edit', $user->id) }}" class="text-inherit">{{ $user->name }}</a>
                        </div>
                      </div>
                    </td>
                    <td>{{ $user->email }}</td>

                    <td>
                      {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}
                    </td>
                    <td> {{ $user->phone ? $user->phone : '---' }}</td>
                    <td>
                      {{ $user->is_super_admin ? 'Master' : 'Administrativo' }}
                    </td>
                    <td>
                      <div class="dropdown">
                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="feather-icon icon-more-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-3"></i>Excluir</a></li>
                          <li><a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                class="bi bi-pencil-square me-3 "></i>Editar</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>

            <div class="border-top d-md-flex justify-content-between align-items-center p-2 p-md-6">
              <span class="mb-2 mb-md-0">Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{
                $users->total() }} resultados</span>
              <nav class="mt-2 mt-md-0">
                {{ $users->appends([
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
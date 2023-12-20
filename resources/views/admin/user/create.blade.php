@extends('admin.layouts.dashboard')
@section('title', 'Cadastrar Usuário')

@section('content')

<main class="main-content-wrapper">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row mb-8">
      <div class="col-md-12">
        <div class="d-md-flex justify-content-between align-items-center">
          <!-- page header -->
          <div>
            <h2>Perfil</h2>
            <!-- breacrumb -->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="text-inherit">Painel</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-inherit">Usuários</a>
                </li>
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Adicinoar Novo Usuário</a></li>
              </ol>
            </nav>
          </div>
          <!-- button -->
          <div>
            <a href="{{ route('users.index') }}" class="btn btn-light">Voltar para Usuários</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col col-md-8 col-12">
    <div class="py-6 p-md-6 p-lg-10">
      <div class="mb-6">
        <!-- heading -->
        <h2 class="mb-0">Adicionar Novo Usuário</h2>
      </div>
      <div>
        <!-- heading -->
        <h5 class="mb-4">Detalhes da conta</h5>
        <div class="row">
          <div class="col">
            <!-- form -->
            <form method="post" action="{{ route('users.store') }}">
              @csrf
              <div class="row">
                <!-- Nome -->
                <div class="col-md-12 mb-3">
                  <label class="form-label">Nome</label>
                  <input type="text" name="name" class="form-control" placeholder="Digite o nome"
                    value="{{ old('name') }}" required autocomplete="name" @error('name') autofocus @enderror>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- E-mail e Telefone-->
                <div class="col-md-6 mb-3">
                  <label class="form-label">E-mail</label>
                  <input type="email" name="email" class="form-control" placeholder="example@gmail.com"
                    value="{{ old('email') }}" required autocomplete="username" @error('email') autofocus @enderror>
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Telefone</label>
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Número do telefone"
                    value="{{ old('phone') }}" autocomplete="phone" @error('phone') autofocus @enderror>
                  @error('phone')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- Senha e Confirmar Senha -->
                <div class="col-md-6 mb-5">
                  <label class="form-label">Senha</label>
                  <input type="password" name="password" class="form-control" placeholder="********"
                    value="{{ old('password') }}" autocomplete="new_password" @error('password') autofocus @enderror>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-6 mb-5">
                  <label class="form-label">Confirmar Senha</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="********"
                    value="{{ old('password_confirmation') }}" autocomplete="new_password" @error('password') autofocus
                    @enderror>
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Tipo de Acesso -->
                <div class="col-md-12 mb-5">
                  <label class="form-label">Tipo de Acesso</label>
                  <div class="form-check">
                    <input type="checkbox" name="is_super_admin" class="form-check-input" value="1" {{
                      old('is_super_admin') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_super_admin">Marcar como Master</label>
                  </div>

                  <input type="hidden" name="is_admin" value="1">
                </div>
              </div>

              <!-- button and success message -->
              <div class="mb-3 d-flex align-items-center">
                <button class="btn btn-primary me-3">Cadastrar</button>
                @if (session('status') === 'profile-updated')
                <h4 id="success-message-profile" class="m-2">Salvo!</h4>
                @endif
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

<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@endsection
@extends('front/layouts/account')
@section('title', 'Perfil')

@section('content')
<div class="col-lg-9 col-md-8 col-12">
  <div class="py-6 p-md-6 p-lg-10">
    <div class="mb-6">
      <!-- heading -->
      <h2 class="mb-0">Configurações de Perfil</h2>
    </div>
    <div>
      <!-- heading -->
      <h5 class="mb-4">Detalhes da conta</h5>
      <div class="row">
        <div class="col-lg-5">
          <!-- form -->
          <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <input type="text" name="name" class="form-control" placeholder="Seu nome"
                value="{{ old('name', $user->name) }}" required autocomplete="name" @error('name') autofocus @enderror>
              @error('name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">E-mail</label>
              <input type="email" name="email" class="form-control" placeholder="example@gmail.com"
                value="{{ old('email', $user->email) }}" required autocomplete="username" @error('email' ) autofocus
                @enderror>
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">CPF ou CNPJ</label>
              <input type="text" name="document" class="form-control document"
                placeholder="Digite o CPF ou CNPJ" value="{{ old('document', $user->document) }}" required
                autocomplete="off" @error('document') autofocus @enderror>
              @error('document')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <!-- input -->
            <div class="mb-5">
              <label class="form-label">Telefone</label>
              <input type="text" id=phone name="phone" class="form-control" placeholder="Número do telefone"
                value="{{ old('phone', $user->phone) }}" autocomplete="phone" @error('phone') autofocus @enderror>
              @error('phone')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <!-- button and success message -->
            <div class="mb-3 d-flex align-items-center">
              <button class="btn btn-primary me-3">Salvar Detalhes</button>
              @if (session('status') === 'profile-updated')
              <h4 id="success-message-profile" class="m-2">Salvo!</h4>
              @endif
            </div>

          </form>
        </div>
      </div>
    </div>
    <hr class="my-10">
    <div class="pe-lg-14">
      <!-- heading -->
      <h5 class="mb-4">Senha</h5>
      <form method="post" action="{{ route('password.update') }}" class=" col row-cols-1 row-cols-lg-2">
        @csrf
        @method('put')
        <!-- input -->
        <div class="mb-3 col">
          <label class="form-label">Senha Atual</label>
          <input type="password" class="form-control" placeholder="**********" name="current_password"
            autocomplete="current-password" @error('current_password', 'updatePassword' ) autofocus @enderror>
          @error('current_password', 'updatePassword')
          <div class="mt-2">
            <span class="text-danger">{{ $message }}</span>
          </div>
          @enderror
        </div>

        <!-- input -->
        <div class="mb-3 col">
          <label class="form-label">Nova Senha</label>
          <input type="password" class="form-control" placeholder="**********" name="password" autocomplete="password"
            @error('password', 'updatePassword' ) autofocus @enderror>
          @error('password', 'updatePassword')
          <div class="mt-2">
            <span class="text-danger">{{ $message }}</span>
          </div>
          @enderror
        </div>
        <!-- input -->
        <div class="mb-3 col">
          <label class="form-label">Confirmar Senha</label>
          <input type="password" class="form-control" placeholder="**********" name="password_confirmation"
            autocomplete="new-password" @error('password', 'updatePassword' ) autofocus @enderror>
          @error('password', 'updatePassword')
          <div class="mt-2">
            <span class="text-danger">{{ $message }}</span>
          </div>
          @enderror
        </div>
        <!-- button and success message -->
        <div class="mb-3 d-flex align-items-center">
          {{-- <p class="mb-4">Não consegue lembrar sua senha atual?<a href="{{ route('password.request') }}"> Redefina
              sua
              senha.</a></p> --}}
          <button class="btn btn-primary me-3">Salvar Senha</button>
          @if (session('status') === 'password-updated')
          <h4 id="success-message-password" class="m-2">Salvo!</h4>
          @endif
        </div>


      </form>
    </div>
    <hr class="my-10">
    <div>
      <!-- heading -->
      <h5 class="mb-4">Deletar Conta</h5>
      <p class="mb-2">Gostaria de excluir sua conta?</p>
      <p class="mb-5">Esta conta pode conter pedidos. Excluir sua conta removerá todos os detalhes de pedidos associados a ela.</p>
      <!-- btn -->
      <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">Quero
        excluir minha
        conta</a>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <div class="modal-header">
          <h5 class="modal-title" id="confirm-user-deletion-label">
            Tem certeza de que deseja excluir sua conta?
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <p class="mt-1 text-sm text-gray-600">
            Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Digite
            sua senha para confirmar que deseja excluir permanentemente sua conta.
          </p>

          <div class="mt-3">
            <label for="password" class="form-label visually-hidden">Senha</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha"
              @error('password', 'userDeletion' ) autofocus @enderror />
            @error('password','userDeletion')
            <span id="delete-erro" class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="submit" class="btn btn-danger">
            Deletar Conta
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection

@section('scripts')

<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
  $(document).ready(function() {
        var hasError = $('#delete-erro').length > 0;

        if (hasError) {
            $('#confirm-user-deletion').modal('show');
        }

        // Adiciona o foco ao elemento com ID 'success-message-profile'
        $('#success-message-profile').attr('tabindex', -1).focus();
        $('#success-message-password').attr('tabindex', -1).focus();

        setTimeout(function () {
            $('#success-message-profile').fadeOut();
            $('#success-message-password').fadeOut();
        }, 2000);
    });
</script>

@endsection

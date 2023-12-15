@extends('admin.layouts.dashboard')
@section('title', 'Editar Usuário')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
  integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

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
                <li class="breadcrumb-item"><a href="#" class="text-inherit">Editar Usuário</a></li>
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
        <h2 class="mb-0">Editar Usuário</h2>
      </div>
      <div>
        <!-- heading -->
        <h5 class="mb-4">Detalhes da conta</h5>
        <div class="row">
          <div class="col">
            <!-- form -->
            <form method="post" action="{{ route('users.update', $user->id) }}">
              @csrf
              @method('put')
              <div class="row">
                <!-- Nome -->
                <div class="col-md-12 mb-3">
                  <label class="form-label">Nome</label>
                  <input type="text" name="name" class="form-control" placeholder="Digite o nome"
                    value="{{ old('name', $user->name) }}" required autocomplete="name" @error('name') autofocus
                    @enderror>
                  @error('name')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <!-- E-mail e Telefone-->
                <div class="col-md-6 mb-3">
                  <label class="form-label">E-mail</label>
                  <input type="email" name="email" class="form-control" placeholder="example@gmail.com"
                    value="{{ old('email',$user->email) }}" required autocomplete="username" @error('email') autofocus
                    @enderror>
                  @error('email')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Telefone</label>
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Número do telefone"
                    value="{{ old('phone', $user->phone) }}" autocomplete="phone" @error('phone') autofocus @enderror>
                  @error('phone')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Tipo de Acesso -->
                <div class="col-md-12 mb-5">
                  <label class="form-label">Tipo de Acesso</label>
                  <div class="form-check">
                    <input type="checkbox" name="is_super_admin" class="form-check-input" value="1" {{
                      $user->is_super_admin || old('is_super_admin') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_super_admin">Marcar como Master</label>
                  </div>
                  <input type="hidden" name="is_admin" value="1">
                </div>
              </div>

              <!-- button and success message -->
              <div class="mb-3 d-flex align-items-center">
                <button class="btn btn-primary me-3">Atualizar</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
  integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
  $(document).ready(function() {
    // Verifica se a sessão contém o status 'user-created'
    var status = "{{ session('status') }}";
    
    if (status === 'user-updated') {
      // Configuração do Toastr
      toastr.options = {
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "6000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };

      // Exibe a mensagem do Toastr
      toastr.success("Usuário Atualizado com Sucesso!");
    }
  });
</script>

@endsection
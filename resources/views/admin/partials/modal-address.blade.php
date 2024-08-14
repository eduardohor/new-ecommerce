<!-- Modal -->
<div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ $formAction }}" method="POST" class="row needs-validation g-3" id="{{ $formId }}">
                    @csrf
                    @isset($address)
                    @method('PUT')
                    @endisset

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="address_name" class="form-label">Nome do Endereço</label>
                        <input type="text" class="form-control" id="address_name" name="name"
                            placeholder="Nome do endereço" value="{{ old('name', $address->name ?? '') }}" required />
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="cep" class="form-label">Cep</label>
                        <input type="text" class="form-control cep" id="cep" name="zip_code" placeholder="Cep"
                            value="{{ old('zip_code', $address->zip_code ?? '') }}" required />
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="state" class="form-label">Estado</label>
                        <select class="form-control" name="state" id="state" required>
                            <option value="" disabled selected>Selecione o Estado</option>
                            @foreach(['AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                            'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
                            'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
                            'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
                            'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco',
                            'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                            'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
                            'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe',
                            'TO' => 'Tocantins'] as $abbr => $state)
                            <option value="{{ $abbr }}" {{ (old('state', $address->state ?? '') == $abbr) ? 'selected' :
                                '' }}>
                                {{ $state }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="city" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade"
                            value="{{ old('city', $address->city ?? '') }}" required />
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="neighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                            placeholder="Bairro" value="{{ old('neighborhood', $address->neighborhood ?? '') }}"
                            required />
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="street" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Rua"
                            value="{{ old('street', $address->street ?? '') }}" required />
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="number" class="form-label">Número</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Número"
                            value="{{ old('number', $address->number ?? '') }}" required />
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="complement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement"
                            placeholder="Complemento" value="{{ old('complement', $address->complement ?? '') }}" />
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>

<script>
    //Buscar endereco por cep
$('#cep').blur(function() {
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

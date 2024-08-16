<!-- Modal Update Address -->
<div class="modal fade" id="updateAddressModal{{ $address->id }}" tabindex="-1"
    aria-labelledby="updateAddressModalLabel{{ $address->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body p-6">
                <div class="d-flex justify-content-between mb-5">
                    <!-- heading -->
                    <div>
                        <h5 class="h6 mb-1" id="updateAddressModalLabel{{ $address->id }}">Atualizar endereço de entrega
                        </h5>
                    </div>
                    <div>
                        <!-- button -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <!-- row -->
                <form action="{{ route('address.update', $address->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Nome do Endereço" name="name"
                                aria-label="Name" value="{{ $address->name }}" required>
                        </div>
                        <!-- CEP -->
                        <div class="col-12">
                            <input type="text" class="form-control cep" placeholder="CEP" name="zip_code"
                                id="cep{{ $address->id }}" value="{{ $address->zip_code }}" required>
                        </div>
                        <!-- Estado -->
                        <div class="col-12">
                            <select class="form-control" name="state" id="state{{ $address->id }}" required>
                                <option value="" disabled selected>Selecione o Estado</option>
                                @foreach(['AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA'
                                => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO'
                                => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul',
                                'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' =>
                                'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                                'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa
                                Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'] as $abbr =>
                                $state)
                                <option value="{{ $abbr }}" {{ old('state', $address->state ?? '') == $abbr ? 'selected'
                                    : '' }}>
                                    {{ $state }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Cidade -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Cidade" name="city"
                                id="city{{ $address->id }}" value="{{ $address->city }}" required>
                        </div>
                        <!-- Bairro -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Bairro" name="neighborhood"
                                id="neighborhood{{ $address->id }}" value="{{ $address->neighborhood }}" required>
                        </div>
                        <!-- Rua -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Rua" name="street"
                                id="street{{ $address->id }}" value="{{ $address->street }}" required>
                        </div>
                        <!-- Numero -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Número" name="number"
                                id="number{{ $address->id }}" value="{{ $address->number }}" required>
                        </div>
                        <!-- Complemento -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Complemento" aria-label="Complemento"
                                value="{{ $address->complement }}" name="complement" id="complement{{ $address->id }}">
                        </div>
                        <!-- Definir como padrão -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default"
                                    id="flexCheckDefault{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault{{ $address->id }}">
                                    Definir como padrão
                                </label>
                            </div>
                        </div>
                        <!-- Botões -->
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-outline-primary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar Endereço</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>

<script>
    //Buscar endereco por cep
$('.cep').blur(function() {
    var cepField = $(this);
    var cep = cepField.val().replace(/\D/g, '');
    var id = cepField.attr('id').replace('cep', '');

    if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
            fetch("https://viacep.com.br/ws/" + cep + "/json/")
                .then(response => response.json())
                .then(dados => {
                    if (!dados.erro) {
                        $('#state' + id).val(dados.uf);
                        $('#neighborhood' + id).val(dados.bairro);
                        $('#complement' + id).val(dados.complemento);
                        $('#city' + id).val(dados.localidade);
                        $('#street' + id).val(dados.logradouro);
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

// Formatar CEP
$(".cep").inputmask("99999-999");
</script>

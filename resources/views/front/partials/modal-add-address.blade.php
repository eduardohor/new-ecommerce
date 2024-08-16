<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal body -->
            <div class="modal-body p-6">
                <div class="d-flex justify-content-between mb-5">
                    <!-- heading -->
                    <div>
                        <h5 class="h6 mb-1" id="addAddressModalLabel">Novo endereço de entrega</h5>
                        <p class="small mb-0">Adicione um novo endereço de entrega para a entrega do seu pedido.</p>
                    </div>
                    <div>
                        <!-- button -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <!-- row -->
                <form action="{{ route('address.store') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <!-- Nome -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Nome do Endereço" name="name"
                                aria-label="Name" required>
                        </div>
                        <!-- CEP -->
                        <div class="col-12">
                            <input type="text" class="form-control cep" placeholder="CEP" name="zip_code" id="cep"
                                required>
                        </div>
                        <!-- Estado -->
                        <div class="col-12">
                            <select class="form-control" name="state" id="state" required>
                                <option value="" disabled selected>Selecione o Estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                        <!-- Cidade -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Cidade" name="city" id="city" required>
                        </div>
                        <!-- Bairro -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Bairro" name="neighborhood"
                                id="neighborhood" required>
                        </div>
                        <!-- Rua -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Rua" name="street" id="street"
                                required>
                        </div>
                        <!-- Numero -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Número" name="number" id="number"
                                required>
                        </div>
                        <!-- Complemento -->
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="Complemento" aria-label="Complemento"
                                name="complement" id="complement">
                        </div>
                        <!-- Definir como padrão -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
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

// Formatar CEP
$(".cep").inputmask("99999-999");
</script>

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
                        <label for="customerpayment" class="form-label">Nº Pedido<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="orderNumber" name="order_number"
                            placeholder="Nº Pedido"  @error('order_number') autofocus @enderror
                            value="{{ old('order_number') }}" required />
                        @error('order_number')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerTransction" class="form-label">ID da Transação</label>
                        <input type="string" class="form-control" id="transactionId" name="transaction_id"
                            placeholder="ID da transação"  @error('transaction_id') autofocus @enderror
                            value="{{ old('transaction_id') }}" required />
                        @error('transaction_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- input -->
                        <label for="customerAmount" class="form-label">Total<span class="text-danger">*</span></label>
                        <input type="text" class="form-control price" id="amount" name="amount" placeholder="Total"
                            required  @error('amount') autofocus @enderror
                            value="{{ old('amount') }}"/>
                        @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-6 col-12">
                        <label for="customerStatus" class="form-label">Status<span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option selected disabled value="">Selecione</option>
                            <option value="completed">Completo</option>
                            <option value="failed">Falhou</option>
                            <option value="pending">Pendente</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-12">
                        <label for="customerMetodPayment" class="form-label">Método de Pagamento<span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option selected disabled value="">Selecione</option>
                            <option value="pix">Pix</option>
                            <option value="master">Master</option>
                            <option value="visa">Visa</option>
                            <option value="american_express">American Express</option>
                            <option value="elo">Elo</option>
                            <option value="hipercard">Hipercard</option>
                        </select>
                        @error('payment_method')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-12">
                        <label for="customerInstallments" class="form-label">Quantidade de Parcelas<span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="installments" name="installments" required>
                            <option selected disabled value="">Selecione</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }} parcela{{ $i > 1 ? 's' : ''
                                }}</option>
                                @endfor
                        </select>
                        @error('installments')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="d-flex flex-column gap-2">
                        <span class="fw-medium text-dark mb-0">Tipo de Pagamento<span
                                class="text-danger">*</span></span>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <input type="radio" class="btn-check" name="payment_type" id="payment_type_credit"
                                value="credit_card" autocomplete="off" checked />
                            <label class="btn btn-outline-primary" for="payment_type_credit">Cartão de Crédito</label>

                            <input type="radio" class="btn-check" name="payment_type" id="payment_type_bank_transfer"
                                value="bank_transfer" autocomplete="off" />
                            <label class="btn btn-outline-primary" for="payment_type_bank_transfer">Transferência
                                Bancária</label>
                        </div>
                        @error('payment_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex flex-row gap-3 mt-5">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>


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

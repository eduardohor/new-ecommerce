<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <form id="form-checkout" class="mt-5">
        <div class="row g-2">
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Número do Cartão</label>
                    <div id="form-checkout__cardNumber" class="form-control"></div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3 mb-lg-0">
                    <label class="form-label">Nome no Cartão</label>
                    <input type="text" id="form-checkout__cardholderName" class="form-control uppercase-input" placeholder="Nome impresso no cartão" />
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-3 mb-lg-0 position-relative">
                    <label class="form-label">Data de validade</label>
                    <div id="form-checkout__expirationDate" class="form-control"></div>
                    <div class="position-absolute bottom-0 end-0 p-3 lh-1">
                        <i class="bi bi-calendar text-muted"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-12">
                <div class="mb-3 mb-lg-0">
                    <label class="form-label">CVV</label>
                    <div id="form-checkout__securityCode" class="form-control"></div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Banco Emissor</label>
                    <select id="form-checkout__issuer" class="form-select"></select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Parcelas</label>
                    <select id="form-checkout__installments" class="form-select"></select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Tipo de Identificação</label>
                    <select id="form-checkout__identificationType" class="form-select"></select>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Número de Identificação</label>
                    <input type="text" id="form-checkout__identificationNumber" class="form-control" placeholder="123.456.789-00" />
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">Email do Titular do Cartão</label>
                    <input type="email" id="form-checkout__cardholderEmail" class="form-control" placeholder="email@example.com" />
                </div>
            </div>
            <div class="col-12">
                <button type="submit" id="form-checkout__submit" class="btn btn-primary w-100">Pagar</button>
                <progress value="0" class="progress-bar w-100 mt-3">Carregando...</progress>
            </div>
        </div>
    </form>



    <script src="https://sdk.mercadopago.com/js/v2"></script>


    <script>
        const mp = new MercadoPago("TEST-b5d3927e-6d67-4190-886d-2db1cb1a7d2f");


    const cardForm = mp.cardForm({
      amount: "100.5",
      iframe: true,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          fetch("/process_payment", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token,
              issuer_id,
              payment_method_id,
              transaction_amount: Number(amount),
              installments: Number(installments),
              description: "Descrição do produto",
              payer: {
                email,
                identification: {
                  type: identificationType,
                  number: identificationNumber,
                },
              },
            }),
          });
        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          const progressBar = document.querySelector(".progress-bar");
          progressBar.removeAttribute("value");

          return () => {
            progressBar.setAttribute("value", "0");
          };
        }
      },
    });

    </script>


</body>

</html>

$(document).ready(function () {
    // Formatar Telefone
    $("#phone").inputmask("(99) 99999-9999");
    $(".phone").inputmask("(99) 99999-9999");

    // Formatar CPF/CNPJ
    $(".document").inputmask({
        mask: ["999.999.999-99", "99.999.999/9999-99"],
        keepStatic: true
    });

    // Formatar CNPJ
    $(".cnpj").inputmask("99.999.999/9999-99");

    // Formatar CEP
    $(".cep").inputmask("99999-999");

    // Formatar Numero Cartao


    // Formatar Data Cartao
    $(".card_validate").inputmask("99/99");

    // Formatar CVV
    $(".cvv").inputmask("999");

    // Formatar Valor Monetário
    $(".price").inputmask({
        alias: "numeric",
        radixPoint: ",",
        groupSeparator: ".",
        autoGroup: true,
        digits: 2,
        digitsOptional: false,
        placeholder: "0",
        rightAlign: false,
        autoUnmask: true,
        numericInput: true,
        prefix: "R$ ",
    });

    // Formatar Peso em Quilogramas
    $(".weight").inputmask({
        alias: "numeric",
        radixPoint: ".",
        groupSeparator: "",
        autoGroup: true,
        digits: 3,
        digitsOptional: false,
        rightAlign: false,
        autoUnmask: true,
        numericInput: true,
        suffix: " kg",
    });

    // Adiciona a máscara para largura, altura e comprimento
    $(".dimensions").inputmask({
        mask: "999",
        numericInput: true,
        placeholder: "",
    });
});

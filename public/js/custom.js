$(document).ready(function () {
    // Formatar Telefone
    $("#phone").inputmask("(99) 99999-9999");

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
        placeholder: "0",
        rightAlign: false,
        autoUnmask: true,
        numericInput: true,
        suffix: " kg",
    });
});

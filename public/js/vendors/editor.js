var quill;

$(document).ready(function () {
    // Inicializar o Quill
    if ($("#editor").length) {
        quill = new Quill("#editor", {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    [{ font: [] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ size: ["small", false, "large", "huge"] }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ color: [] }, { background: [] }, { align: [] }],
                    ["link", "image", "code-block", "video"],
                ],
            },
            theme: "snow",
            placeholder: "Digite aqui...",
        });

        var $hiddenInput = $("#description");

        if ($hiddenInput.length && $hiddenInput.val()) {
            quill.root.innerHTML = $hiddenInput.val();
        }

        // Adicionar um ouvinte de evento para o envio do formulário
        $("form").submit(function () {
            var descriptionValue = quill.root.innerHTML;
            $hiddenInput.val(descriptionValue);
        });
    }
});

$(".image-delete").on("click", function (e) {
    e.preventDefault();
    if (confirm("Confirma a exclusão desta imagem?") == true) {
        let imageRemove = e.target.dataset.id;
        $.ajax({
            type: "delete",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: e.target.dataset.action,
            success: function (res) {
                if (res.message == "success") {
                    $("div").find(`[data-image='${imageRemove}']`).remove();
                } else {
                    alert("Falha ao remover a imagem");
                }
            },
        });
    }
});

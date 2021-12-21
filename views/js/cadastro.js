$( document ).ready(function() {


    $("#idTabelaClientes").on("click", ".btnExcluir", function() {
        $(this).closest("tr").remove();
     });

    $(".btnEditar").on("click", function() {
        // buscarDadoscliente();
        $("#staticBackdrop").modal('show');
    });

    function buscarDadoscliente() {
        var urlBackEnd = "http://localhost:3000/controllers/CadastroController.php";

        $.get(urlBackEnd)
            .done(function(response) {
                console.log(response);
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                alert( "finished" );
            });

    }

});

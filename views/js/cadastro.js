$( document ).ready(function() {

    var urlBackEnd = "http://localhost:3000/controllers/CadastroController.php";

    $(".btnBuscarDados").on("click", function() {
        buscarDadoscliente();
    });

    function buscarDadoscliente() {

        $.get(urlBackEnd).done(function(response) {
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

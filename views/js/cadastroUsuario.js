$(document).ready(function () {

    listarUsuarios();

    $("#idTabelaUsuarios").on("click", ".btnExcluir", function () {
        $(this).closest("tr").remove();
    });

    $("#idTabelaUsuarios").on("click", ".btnEditar", function () {

        var id = $(this).val();

        console.log("eu sou o id: " + id);

        // $("#staticBackdrop").modal('show');
    });

    function listarUsuarios() {
        var urlBackEnd = "http://localhost/infoCurso/controllers/UsuariosController.php";

        $.get(urlBackEnd)
            .done(function (listaDeUsuarios) {
                console.log(listaDeUsuarios);
                montarTabela(listaDeUsuarios)
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                console.log("finished");
            });

    }

    function montarTabela(listaDeUsuarios) {
        var tabelaHtml = montarCabecalho();
        tabelaHtml += montarCorpoTabela(listaDeUsuarios);
        // tabelaHtml = tabelaHtml + montarCorpoTabela(listaDeUsuarios);

        $("#idTabelaUsuarios").html(tabelaHtml);
    }

    function montarCabecalho() {
        var cabecalho = (
            "<thead>" +
                "<tr>" +
                    "<th>id</th>" +
                    "<th>nome</th>" +
                    "<th>usuário</th>" +
                    "<th>e-mail</th>" +
                    "<th>status</th>" +
                    "<th>email_recuperacao</th>" +
                    "<th>Ações</th>" +
                "</tr>" +
            "</thead>"
        );

        return cabecalho;
    }

    function montarCorpoTabela(listaDeUsuarios) {
        var body = "<body>";

        $.each(listaDeUsuarios, function (indice, usuario) {

            var statusDesc = (usuario.status == 1) ? "Ativo" : "Inativo";

            var tr = "<tr>";
            var td = "<td>" + usuario.id + "</td>";
            td += "<td>" + usuario.nome + "</td>";
            td += "<td>" + usuario.usuario + "</td>";
            td += "<td>" + usuario.email + "</td>";
            td += "<td>" + statusDesc + "</td>";
            td += "<td>" + usuario.email_recuperacao + "</td>";

           var btnEditar = "<button type='button' value=" + usuario.id + " class='btn btn-warning btnEditar'>Editar <i class='far fa-edit'></i></button>";
            var btnExcluir = "<button type='button' value=" + usuario.id + " class='btn btn-danger btnExcluir'>Excluir <i class='far fa-trash-alt'></i></button>";

            td += "<td>" + btnEditar + btnExcluir + "</td>";

            tr = td + "</tr>";
            body += tr;
        });

        body += "</body>";

        return body;
    }

});

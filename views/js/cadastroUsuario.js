$(document).ready(function () {
    // atenção para o "?" depois do .php sem ele não funciona.
    var urlBackEnd = "http://localhost/infoCurso/controllers/UsuariosController.php?";

    listarUsuarios();

    function listarUsuarios() {
        var objetosDaRota = {
            rota: "dadosUsuarios",
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $.get(urlFinal)
            .done(function (listaDeUsuarios) {
                montarTabela(listaDeUsuarios)
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished");
            });
    }

    function montarTabela(listaDeUsuarios) {
        var tabelaHtml = montarCabecalho();
        tabelaHtml += montarCorpoTabela(listaDeUsuarios);

        // Se o backend não retornar nenhum dados exibimos a mensagem abaixo
        if (!listaDeUsuarios || listaDeUsuarios.length <= 0) {
            tabelaHtml = "<p><b>Sem dados para exibir!</b></p>";
        }

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

        $.each(listaDeUsuarios, function (indice, dadosUsuario) {

            var statusDesc = (dadosUsuario.status == 1) ? "Ativo" : "Inativo";

            var td = "";

            td += "<td>" + dadosUsuario.id + "</td>";
            td += "<td>" + dadosUsuario.nome + "</td>";
            td += "<td>" + dadosUsuario.usuario + "</td>";
            td += "<td>" + dadosUsuario.email + "</td>";
            td += "<td>" + statusDesc + "</td>";
            td += "<td>" + dadosUsuario.email_recuperacao + "</td>";

            var btnEditar = "<button type='button' value=" + dadosUsuario.id + " class='btn btn-warning btnEditar'>Editar <i class='far fa-edit'></i></button>&nbsp;&nbsp;";
            var btnExcluir = "<button type='button' value=" + dadosUsuario.id + " class='btn btn-danger btnExcluir'>Excluir <i class='far fa-trash-alt'></i></button>";

            td += "<td>" + btnEditar + btnExcluir + "</td>";

            var tr = "<tr>" + td + "</tr>";
            body += tr;
        });

        body += "</body>";

        return body;
    }

    // remover/excluir usuário
    $("#idTabelaUsuarios").on("click", ".btnExcluir", function () {
        $(this).closest("tr").remove();
    });

    // obter dados de um usuário para editar no modal
    $("#idTabelaUsuarios").on("click", ".btnEditar", function () {

        var idUsuario = $(this).val();

        var objetosDaRota = {
            rota: "obterDadosUsuario",
            id: idUsuario
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $.get(urlFinal)
            .done(function (usuarioEditado) {
                console.log(usuarioEditado)
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished");
            });

        // $("#staticBackdrop").modal('show');
    });
});

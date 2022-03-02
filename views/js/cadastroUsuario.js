$(document).ready(function () {
    // atenção para o "?" depois do .php sem ele não funciona.
    var urlBackEnd = "http://localhost/infoCurso/controllers/UsuariosController.php?";

    listarUsuarios();

    function listarUsuarios() {
        var objetosDaRota = {
            rota: "listarTodosUsuarios",
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
                console.log("finished - listarUsuarios");
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
        var idUsuario = $(this).val();

        var objetosDaRota = {
            rota: "excluirUsuario"
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $.post(urlFinal, { id: idUsuario })
            .done(function (usuarioExcluido) {

                if (usuarioExcluido.success) {
                    $(this).closest("tr").remove();
                    listarUsuarios();
                } else {
                    var msg = usuarioExcluido.error ? usuarioExcluido.mensagem : "Não foi possível excluir o usuário. Contate o administrados!";
                    alert(msg);
                }
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished");
            });
    });

    // obter dados de um usuário para editar no modal
    $("#idTabelaUsuarios").on("click", ".btnEditar", function () {

        var idUsuario = $(this).val();

        var objetosDaRota = {
            rota: "editarUsuario",
            id: idUsuario,
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $("#titleModal").text("Editar usuário");

        $.get(urlFinal)
            .done(function (dadosUsuario) {
                $("#id").val(dadosUsuario[0].id);
                $("#nome").val(dadosUsuario[0].nome);
                $("#usuario").val(dadosUsuario[0].usuario);
                $("#email").val(dadosUsuario[0].email);
                $("#senha").val(dadosUsuario[0].senha);
                $("#status").val(dadosUsuario[0].status);
                $("#email_recuperacao").val(dadosUsuario[0].email_recuperacao);
                $("#staticBackdropModal").modal('show');
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished - editarUsuario");
            });
    });

    // Ao clicar em cadastrar usuario.
    $(".btnCriarUsuario").on("click", function () {
        limparFormularioModal();
    });

    function limparFormularioModal() {
        $("#titleModal").text("Cadastrar usuário");
        $("#id").val("");
        $("#nome").val("");
        $("#usuario").val("");
        $("#email").val("");
        $("#senha").val("");
        $("#status").val("1");
        $("#email_recuperacao").val("");
    }

    // Salvar o usuário seja novo ou um em edição.
    $(".btnSalvarUsuario").on("click", function () {

        var objetosDaRota = {
            rota: "salvarAtualizarUsuario"
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);
        var dadosUsuario = obterDadosDoFormulario();

        $.post(urlFinal, dadosUsuario)
            .done(function (resposta) {
                $("#staticBackdropModal").modal('hide');
                alert(resposta.mensagem);
                listarUsuarios();
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished - salvar");
            });
    });

    function obterDadosDoFormulario() {
        var objetoUsuario = {
            id: $("#id").val(),
            nome: $("#nome").val(),
            usuario: $("#usuario").val(),
            email: $("#email").val(),
            senha: $("#senha").val(),
            status: $("#status").val(),
            email_recuperacao: $("#email_recuperacao").val()
        }

        return objetoUsuario;
    }
});

$(document).ready(function () {
    // atenção para o "?" depois do .php sem ele não funciona.
    var urlBackEnd = "http://localhost/infoCurso/controllers/ProdutosController.php?";

    listarProdutos();

    function listarProdutos() {
        var objetosDaRota = {
            rota: "listarTodosProdutos"
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $.get(urlFinal)
            .done(function (listaDeProdutos) {
                montarTabela(listaDeProdutos)
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished - listarProdutos");
            });
    }

    function montarTabela(listaDeProdutos) {
        var tabelaHtml = montarCabecalho();
        tabelaHtml += montarCorpoTabela(listaDeProdutos);

        // Se o backend não retornar nenhum dados exibimos a mensagem abaixo
        if (!listaDeProdutos || listaDeProdutos.length <= 0) {
            tabelaHtml = "<p><b>Sem dados para exibir!</b></p>";
        }

        $("#idTabelaProdutos").html(tabelaHtml);
    }

    function montarCabecalho() {
        var cabecalho = (
            "<thead>" +
                "<tr>" +
                    "<th>id</th>"+
                    "<th>nome</th>"+
                    "<th>descricao</th>"+
                    "<th>quantidade</th>"+
                    "<th>peso</th>"+
                    "<th>classificacao</th>"+
                    "<th>status</th>"+
                    "<th>largura</th>"+
                    "<th>altura</th>"+
                    "<th>profundidade</th>"+
                    "<th>preco</th>"+
                    "<th>preco_promocional</th>"+
                    "<th>gtin</th>"+
                    "<th>unidade_medida</th>"+
                    "<th>condicao</th>"+
                    "<th>codigo_sku</th>" +
                    "<th>Ações</th>" +
                "</tr>" +
            "</thead>"
        );

        return cabecalho;
    }

    function montarCorpoTabela(listaDeProdutos) {
        var body = "<body>";

        $.each(listaDeProdutos, function (indice, dadosProduto) {

            var statusDesc = (dadosProduto.status == 1) ? "Ativo" : "Inativo";

            var td = "";
            td += "<td>" + dadosProduto.id + "</td>";
            td += "<td>" + dadosProduto.nome + "</td>";
            td += "<td>" + dadosProduto.descricao + "</td>";
            td += "<td>" + dadosProduto.quantidade + "</td>";
            td += "<td>" + dadosProduto.peso + "</td>";
            td += "<td>" + dadosProduto.classificacao + "</td>";
            td += "<td>" + statusDesc + "</td>";
            td += "<td>" + dadosProduto.largura + "</td>";
            td += "<td>" + dadosProduto.altura + "</td>";
            td += "<td>" + dadosProduto.profundidade + "</td>";
            td += "<td>" + dadosProduto.preco + "</td>";
            td += "<td>" + dadosProduto.preco_promocional + "</td>";
            td += "<td>" + dadosProduto.gtin + "</td>";
            td += "<td>" + dadosProduto.unidade_medida + "</td>";
            td += "<td>" + dadosProduto.condicao + "</td>";
            td += "<td>" + dadosProduto.codigo_sku + "</td>";

            var btnEditar = "<button type='button' value=" + dadosProduto.id + " class='btn btn-warning btnEditar'>Editar <i class='far fa-edit'></i></button>&nbsp;&nbsp;";
            var btnExcluir = "<button type='button' value=" + dadosProduto.id + " class='btn btn-danger btnExcluir'>Excluir <i class='far fa-trash-alt'></i></button>";

            td += "<td>" + btnEditar + btnExcluir + "</td>";

            var tr = "<tr>" + td + "</tr>";
            body += tr;
        });

        body += "</body>";

        return body;
    }

    // remover/excluir produto
    $("#idTabelaProdutos").on("click", ".btnExcluir", function () {
        var idProduto = $(this).val();

        var objetosDaRota = {
            rota: "excluirProduto"
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $.post(urlFinal, { id: idProduto })
            .done(function (produtoExcluido) {

                if (produtoExcluido.success) {
                    $(this).closest("tr").remove();
                    listarProdutos();
                } else {
                    var msg = produtoExcluido.error ? produtoExcluido.mensagem : "Não foi possível excluir o produto. Contate o administrados!";
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

    // obter dados de um produto para editar no modal
    $("#idTabelaProdutos").on("click", ".btnEditar", function () {

        var idProduto = $(this).val();

        var objetosDaRota = {
            rota: "editarProduto",
            id: idProduto,
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);

        $("#titleModal").text("Editar produto");

        $.get(urlFinal)
            .done(function (dadosProduto) {
                $("#id").val(dadosProduto[0].id);
                $("#nome").val(dadosProduto[0].nome);
                $("#descricao").val(dadosProduto[0].descricao);
                $("#quantidade").val(dadosProduto[0].quantidade);
                $("#peso").val(dadosProduto[0].peso);
                $("#classificacao").val(dadosProduto[0].classificacao);
                $("#status").val(dadosProduto[0].status);
                $("#largura").val(dadosProduto[0].largura);
                $("#altura").val(dadosProduto[0].altura);
                $("#profundidade").val(dadosProduto[0].profundidade);
                $("#preco").val(dadosProduto[0].preco);
                $("#preco_promocional").val(dadosProduto[0].preco_promocional);
                $("#gtin").val(dadosProduto[0].gtin);
                $("#unidade_medida").val(dadosProduto[0].unidade_medida);
                $("#condicao").val(dadosProduto[0].condicao);
                $("#codigo_sku").val(dadosProduto[0].codigo_sku);

                $("#staticBackdropModal").modal('show');
            })
            .fail(function (error) {
                alert("error");
                console.log("\n error: ", error);
            })
            .always(function () {
                console.log("finished - editarProduto");
            });
    });

    // Ao clicar em cadastrar produto.
    $(".btnCriarProduto").on("click", function () {
        limparFormularioModal();
    });

    function limparFormularioModal() {
        $("#titleModal").text("Cadastrar produto");

        $("#id").val("");
        $("#nome").val("");
        $("#descricao").val("");
        $("#quantidade").val("");
        $("#peso").val("");
        $("#classificacao").val("");
        $("#status").val("");
        $("#largura").val("");
        $("#altura").val("");
        $("#profundidade").val("");
        $("#preco").val("");
        $("#preco_promocional").val("");
        $("#gtin").val("");
        $("#unidade_medida").val("");
        $("#condicao").val("");
        $("#codigo_sku").val("");
    }

    // Salvar o produto seja novo ou um em edição.
    $(".btnSalvarProduto").on("click", function () {

        var objetosDaRota = {
            rota: "salvarAtualizarProduto"
        }

        var urlFinal = urlBackEnd + $.param(objetosDaRota);
        var dadosProduto = obterDadosDoFormulario();

        $.post(urlFinal, dadosProduto)
            .done(function (resposta) {
                $("#staticBackdropModal").modal('hide');
                alert(resposta.mensagem);
                listarProdutos();
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
        var objetoProduto = {
            id: $("#id").val(),
            nome: $("#nome").val(),
            descricao: $("#descricao").val(),
            quantidade: $("#quantidade").val(),
            peso: $("#peso").val(),
            classificacao: $("#classificacao").val(),
            status: $("#status").val(),
            largura: $("#largura").val(),
            altura: $("#altura").val(),
            profundidade: $("#profundidade").val(),
            preco: $("#preco").val(),
            preco_promocional: $("#preco_promocional").val(),
            gtin: $("#gtin").val(),
            unidade_medida: $("#unidade_medida").val(),
            condicao: $("#condicao").val(),
            codigo_sku: $("#codigo_sku").val()
        }

        return objetoProduto;
    }
});

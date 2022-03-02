<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/cadastroProduto.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d9fca6b681.js" crossorigin="anonymous"></script>
    <script src="./js/cadastroProduto.js"></script>
</head>
<body>
    <br />
    <div class="container-fluid">

        <button type="button" class="btn btn-primary btnCriarProduto" data-bs-toggle="modal" data-bs-target="#staticBackdropModal">
            <i class="far fa-plus-square"></i> Cadastrar produto</button>
        <br />
        <br />

        <table id="idTabelaProdutos" class="table table-responsive table-striped table-hover">
        </table>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="titleModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModal">Cadastrar produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- FORM Do Produto -->
                        <form id="formProdutos" class="row g-3 needs-validation" novalidate>

                            <div class="col-lg-6 col-md-2">
                                <label for="id" class="form-label">Id</label>
                                <input type="number" min="0" readonly class="form-control" id="id" name="id" required>
                            </div>

                            <div class="col-lg-6 col-md-10">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                                <div class="invalid-feedback">
                                    Informe o nome completo do produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-10">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                                <div class="invalid-feedback">
                                    Informe um nome de produto, ex.: pedro123
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-2">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="text" class="form-control" id="quantidade" name="quantidade" required>
                                <div class="invalid-feedback">
                                    Informe o e-mail do produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="peso" class="form-label">Peso</label>
                                <input type="text" class="form-control" id="peso" name="peso" required>
                                <div class="invalid-feedback">
                                    Informe uma senha
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" selected>Ativo</option>
                                    <option value="0">Inativo</option>
                                </select>
                                <div class="invalid-feedback">
                                    Selecione um status
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <label for="classificacao" class="form-label">Classificação</label>
                                <input type="text" class="form-control" id="classificacao" name="classificacao" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="largura" class="form-label">Largura</label>
                                <input type="text" class="form-control" id="largura" name="largura" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="altura" class="form-label">Altura</label>
                                <input type="text" class="form-control" id="altura" name="altura" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="profundidade" class="form-label">Profundidade</label>
                                <input type="text" class="form-control" id="profundidade" name="profundidade" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="text" class="form-control" id="preco" name="preco" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="preco_promocional" class="form-label">Preço promocional</label>
                                <input type="text" class="form-control" id="preco_promocional" name="preco_promocional" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="gtin" class="form-label">GTIN</label>
                                <input type="text" class="form-control" id="gtin" name="gtin" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="unidade_medida" class="form-label">Unidade de medida (UN)</label>
                                <input type="text" class="form-control" id="unidade_medida" name="unidade_medida" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-3">
                                <label for="codigo_sku" class="form-label">Código sku</label>
                                <input type="text" class="form-control" id="codigo_sku" name="codigo_sku" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label for="condicao" class="form-label">Condição</label>
                                <input type="text" class="form-control" id="condicao" name="condicao" required>
                                <div class="invalid-feedback">
                                    Informe um e-mail de recuperação para o produto
                                </div>
                            </div>

                            <div class="modal-footer col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Fechar</button>
                                <button type="button" class="btn btn-primary btnSalvarProduto">Salvar <i class="far fa-save"></i></button>
                            </div>
                        </form>
                        <!-- FIM DO FORM -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

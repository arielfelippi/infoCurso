<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/cadastroUsuario.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d9fca6b681.js" crossorigin="anonymous"></script>
    <script src="./js/cadastroUsuario.js"></script>
</head>
<body>
    <br />
    <div class="container">

        <button type="button" class="btn btn-primary btnCriarUsuario" data-bs-toggle="modal" data-bs-target="#staticBackdropModal">
            <i class="far fa-plus-square"></i> Cadastrar usuário</button>
        <br />
        <br />

        <table id="idTabelaUsuarios" class="table table-responsive table-striped table-hover">
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="titleModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Cadastrar usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- FORM Do usuario -->
                    <form id="formUsuarios" class="row g-3 needs-validation" novalidate>

                        <div class="col-md-2">
                            <label for="id" class="form-label">Id</label>
                            <input type="number" min="0" readonly class="form-control" id="id" name="id" required>
                        </div>

                        <div class="col-md-10">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <div class="invalid-feedback">
                                Informe o nome completo do usuário
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                            <div class="invalid-feedback">
                                Informe um nome de usuário, ex.: pedro123
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Informe o e-mail do usuário
                            </div>
                        </div>

                        <div class="col-md-7">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                            <div class="invalid-feedback">
                                Informe uma senha
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1" selected>Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                            <div class="invalid-feedback">
                                Selecione um status
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="email_recuperacao" class="form-label">E-mail de recuperação</label>
                            <input type="text" class="form-control" id="email_recuperacao" name="email_recuperacao" required>
                            <div class="invalid-feedback">
                                Informe um e-mail de recuperação para o usuário
                            </div>
                        </div>

                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Fechar</button>
                            <button type="button" class="btn btn-primary btnSalvarUsuario">Salvar <i class="far fa-save"></i></button>
                        </div>
                    </form>
                    <!-- FIM DO FORM -->

                </div>
            </div>
        </div>
    </div>

</body>
</html>

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

        <button type="button" class="btn btn-primary btnCriarUsuario" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="far fa-plus-square"></i> Cadastrar usuário</button>
        <br />
        <br />

        <table id="idTabelaUsuarios" class="table table-responsive table-striped table-hover">
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastrar usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- FORM Do usuario -->
                    <form id="formUsuarios" class="row g-3 needs-validation" novalidate>

                        <div class="col-md-3">
                            <label for="id" class="form-label">Id da usuario</label>
                            <input type="number" min="1" readonly class="form-control" id="id" name="id" required>
                        </div>

                        <div class="col-md-9">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                            <div class="invalid-feedback">
                                Informe um titulo para a usuario
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="data_inicio" class="form-label">Data de inicio</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                            <div class="invalid-feedback">
                                Informe uma data de inicio para a usuario
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="data_fim" class="form-label">Data fim</label>
                            <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                            <div class="invalid-feedback">
                                Informe uma data fim para a usuario
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="number" min="1" max="5" class="form-control" id="status" name="status" required>
                            <div class="invalid-feedback">
                                Selecione um status para a usuario
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="prioridade" class="form-label">Prioridade</label>
                            <input type="number" min="1" max="5" class="form-control" id="prioridade" name="prioridade" required>
                            <div class="invalid-feedback">
                                Selecione uma prioridade para a usuario
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                            <div class="invalid-feedback">
                                Informe um usuário para a usuario
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                Informe uma descrição para a usuario
                            </div>
                        </div>

                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Fechar</button>
                            <button type="button" class="btn btn-primary btnInserir">Salvar <i class="far fa-save"></i></button>
                        </div>
                    </form>
                    <!-- FIM DO FORM -->

                </div>
            </div>
        </div>
    </div>

</body>
</html>

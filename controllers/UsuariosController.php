<?php

require "../Models/UsuarioModel.php"; // require - importa uma vez | require_once - importa toda vez que o arquivo usuários é acessado/chamado.

class UsuariosController
{
    private $rota = null;
    public $request = null;
    protected $usuarioModel = null;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->request = $_REQUEST;
        $this->rota = $this->request['rota'] ?? ""; // se não tiver a palavra rota nos parâmetros da URL informamos vazio.
    }

    // retorna a rota para sabermos qual função utilizar (dadosUsuarios | obterDadosUsuario | excluirUsuario...).
    public function getRota()
    {
        return $this->rota;
    }

    // desconectamos do banco de dados pelo model.
    public function desconectarModel()
    {
        $this->usuarioModel->desconectar();
    }

    // setamos o retorno para o front no formato JSON (javascript - objeto)
    public function setResponseAPI($dados)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        exit();
    }

    // obtém todos os usuários
    public function listarUsuarios()
    {
        $dados = [];

        $result = $this->usuarioModel->listar();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados[] = $row;
            }
        }

        $this->setResponseAPI($dados);
    }

    // obtém dados de 1 usuário (EDITAR).
    public function obterDadosUsuario()
    {
        $idUsuario = $this->request["id"] ?? 0;

        $dados = [];

        if (!empty($idUsuario) && is_numeric($idUsuario)) {
            $result = $this->usuarioModel->obter($idUsuario);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dados[] = $row;
                }
            }
        }

        $this->setResponseAPI($dados);
    }

    // apenas mudamos o status o usuário para inativo para dizermos que ele está excluído.
    public function excluirUsuario()
    {
        $idUsuario = $this->request["id"] ?? 0;

        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível excluir o usuário. Contate o administrados!"
        ];

        if (!empty($idUsuario) && is_numeric($idUsuario)) {
            $result = $this->usuarioModel->excluir($idUsuario);

            if ($result) {
                $dados = [
                    "success" => 201,
                    "mensagem" => "Usuário excluído."
                ];
            }
        }

        $this->setResponseAPI($dados);
    }

    public function salvarAtualizarUsuario()
    {
        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível salvar o usuário. Contate o administrados!"
        ];

        $idUsuario = $this->request["id"] ?? 0;
        $nome = $this->request["nome"] ?? "";
        $usuario = $this->request["usuario"] ?? "";
        $email = $this->request["email"] ?? "";
        $senha = $this->request["senha"] ?? "";
        $status = $this->request["status"] ?? 0;
        $email_recuperacao = $this->request["email_recuperacao"] ?? "";

        // ATUALIZAR
        if (!empty($idUsuario) && is_numeric($idUsuario)) {
            $mensagem = "Usuário atualizado com sucesso.";

            $result = $this->usuarioModel->atualizar($nome, $usuario, $email, $senha, $status, $email_recuperacao, $idUsuario);
        } else {
            $mensagem = "Usuário cadastrado com sucesso.";

            $result = $this->usuarioModel->cadastrar($nome, $usuario, $email, $senha, $status, $email_recuperacao);
            $idUsuario = $result;
        }

        if ($result) {
            $dados = [
                "success" => 201,
                "mensagem" => $mensagem,
                "idUsuario" => $idUsuario,
            ];
        }

        $this->setResponseAPI($dados);
    }
}

// inicializamos (instanciamos) nossa variável (objeto).
$objUsuariosController = new UsuariosController($conexao);

// aqui obtemos nossa rota informada la no frontend (javascript) e conforme a rota informada redirecionamos a ação.
switch ($objUsuariosController->getRota()) {
    case "listarTodosUsuarios":
            $objUsuariosController->listarUsuarios();
        break;
    case "editarUsuario":
            $objUsuariosController->obterDadosUsuario();
        break;
    case "excluirUsuario":
            $objUsuariosController->excluirUsuario();
        break;
    case "salvarAtualizarUsuario":
            $objUsuariosController->salvarAtualizarUsuario();
        break;
    default:
            $objUsuariosController->setResponseAPI(["erro" => "404", "mensagem" => "Rota inválida ou não encontrada."]);
        break;
}

// após termino execução encerramos a conexão do model com o banco
$objUsuariosController->desconectarModel();

<?php

require "Conexao.php"; // require - importa uma vez | require_once - importa toda vez que o arquivo usuários é acessado/chamado.

class UsuariosController
{
    private $rota = null;
    private $conexao = null;
    public $request = null;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
        $this->request = $_REQUEST;
        $this->rota = $_REQUEST['rota'];
    }

    // retorna a rota para sabermos qual função utilizar (dadosUsuarios | obterDadosUsuario | excluirUsuario...).
    public function getRota()
    {
        return $this->rota;
    }

    // desconectamos do banco de dados.
    public function desconectar()
    {
        $this->conexao->close();
        $this->conexao = null;
    }

    // setamos o retorno para o front no formato JSON (javascript - objeto)
    public function setResponseAPI($dados)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        exit();
    }

    // obtém todos os usuários
    public function dadosUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $result = $this->conexao->query($sql);

        $dados = [];

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
        $idUsuario = $this->request["id"];

        $sql = "SELECT * FROM usuarios WHERE id={$idUsuario} LIMIT 1";
        $result = $this->conexao->query($sql);

        $dados = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados[] = $row;
            }
        }

        $this->setResponseAPI($dados);
    }
}

// inicializamos (instanciamos) nossa variável (objeto).
$objUsuariosController = new UsuariosController($conexao);

switch ($objUsuariosController->getRota()) {
    case "dadosUsuarios":
        $objUsuariosController->dadosUsuarios();
        break;
    case "obterDadosUsuario":
        $objUsuariosController->obterDadosUsuario();
        break;
}

// após termino execução encerramos a conexao com o banco
$objUsuariosController->desconectar();

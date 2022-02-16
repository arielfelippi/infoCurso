<?php

require "Conexao.php"; // importa toda vez

class UsuariosController {

    private $conexao = null;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function dadosCliente() {

        $sql = "SELECT * FROM usuarios";
        $result = $this->conexao->query($sql);

        $dados = [];

        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $dados[] = $row;
        }
        } else {
            echo "0 results";
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        $this->conexao->close();
        exit();
    }
}

$objCadastroController = new UsuariosController($conexao);
$objCadastroController->dadosCliente();


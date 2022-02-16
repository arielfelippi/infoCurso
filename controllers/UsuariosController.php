<?php

require "Conexao.php"; // importa toda vez

class UsuariosController {

    private $conexao = null;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    private function desconectar() {
        $this->conexao->close();
        $this->conexao = null;
    }

    public function setResponseAPI($dados) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        exit();
    }

    public function dadosCliente() {

        $sql = "SELECT * FROM usuarios";
        $result = $this->conexao->query($sql);

        $dados = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dados[] = $row;
            }
        }
        
        $this->setResponseAPI($dados);

    }
}

$objUsuariosController = new UsuariosController($conexao);
$objUsuariosController->dadosCliente();
$objUsuariosController->desconectar();


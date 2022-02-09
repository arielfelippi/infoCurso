<?php

class CadastroController {

    public function dadosCliente(){
        $dados =[ [
            "id" => 1,
            "nome" => "Zé",
            "sobrenome" => "do Caminhão",
            "dataNascimento" => "01/01/1950",
            "email" => "zecaminhao@infoserv.com",
            "endereco" => "rua pernambuco",
            "status" => "1",
            "estado" => "RS",
            "nomeUsuario" => "joao123",
            "email_recuperacao" => "Desenvolvedor",
        ],
        [
            "id" => 2,
            "nome" => "pedrinho",
            "sobrenome" => "do Caminhão",
            "dataNascimento" => "01/01/1950",
            "email" => "zecaminhao@infoserv.com",
            "endereco" => "rua pernambuco",
            "status" => 1,
            "estado" => "RS",
            "nomeUsuario" => "joao123",
            "profissao" => "Desenvolvedor",
        ]
    ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        exit();
    }
}

$objCadastroController = new CadastroController();
$objCadastroController->dadosCliente();

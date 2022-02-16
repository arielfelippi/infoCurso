<?php
// echo "chegueiiii";

// exit;

$conexao = mysqli_connect("localhost", "aluno", "qwe123", "info_curso");
 
if (!$conexao) {
    echo "Error: Falha ao conectar-se com o banco de dados MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "conectei com sucesso!";
 
// mysqli_close($conexao);

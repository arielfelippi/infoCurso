<?php

require "../database/Conexao.php"; // require - importa uma vez | require_once - importa toda vez que o arquivo clientes é acessado/chamado.

class ClientesController
{
    private $rota = null;
    private $conexao = null;
    public $request = null;
    protected $nomeTabela = "clientes";

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
        $this->request = $_REQUEST;
        $this->rota = $this->request['rota'] ?? ""; // se não tiver a palavra rota nos parâmetros da URL informamos vazio.
    }

    // retorna a rota para sabermos qual função utilizar (dadosClientes | obterDadosCliente | excluirCliente...).
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

    // obtém todos os clientes
    public function listarClientes()
    {
        $sql = "SELECT * FROM {$this->nomeTabela}";
        $result = $this->conexao->query($sql);

        $dados = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados[] = $row;
            }
        }

        $this->setResponseAPI($dados);
    }

    // obtém dados de 1 cliente (EDITAR).
    public function obterDadosCliente()
    {
        $idCliente = $this->request["id"] ?? 0;

        $dados = [];

        if (!empty($idCliente) && is_numeric($idCliente)) {
            $sql = "SELECT * FROM {$this->nomeTabela} WHERE id={$idCliente} LIMIT 1";
            $result = $this->conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dados[] = $row;
                }
            }
        }

        $this->setResponseAPI($dados);
    }

    // apenas mudamos o status o cliente para inativo para dizermos que ele está excluído.
    public function excluirCliente()
    {
        $idCliente = $this->request["id"] ?? 0;

        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível excluir o cliente. Contate o administrados!"
        ];

        if (!empty($idCliente) && is_numeric($idCliente)) {
            $sql = "UPDATE {$this->nomeTabela} SET status = 0 WHERE id={$idCliente}";
            // $sql = "DELETE FROM {$this->nomeTabela} WHERE id={$idCliente}";
            $result = $this->conexao->query($sql);

            // verificamos se de fato o cliente foi alterado/excluido
            $sql = "SELECT * FROM {$this->nomeTabela} WHERE id={$idCliente} AND status = 0 LIMIT 1";
            $result = $this->conexao->query($sql);

            if ($result->num_rows > 0) {
                $dados = [
                    "success" => 201,
                    "mensagem" => "Cliente excluído."
                ];
            }
        }

        $this->setResponseAPI($dados);
    }

    public function salvarAtualizarCliente()
    {
        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível salvar o cliente. Contate o administrados!"
        ];

        $idCliente = $this->request["id"] ?? 0;
        $nome = $this->request["nome"] ?? "";
        $sobrenome = $this->request["sobrenome"] ?? "";
        $data_nascimento = $this->request["data_nascimento"] ?? 0;
        $sexo = $this->request["sexo"] ?? 0;
        $rg = $this->request["rg"] ?? "";
        $status = $this->request["status"] ?? 0;
        $cpf = $this->request["cpf"] ?? 0;
        $cnpj = $this->request["cnpj"] ?? 0;
        $tipo = $this->request["tipo"] ?? 0;
        $email = $this->request["email"] ?? 0;
        $telefone = $this->request["telefone"] ?? 0;
        $celular = $this->request["celular"] ?? "";
        $estado = $this->request["estado"] ?? "";
        $sigla_estado = $this->request["sigla_estado"] ?? "";
        $cidade = $this->request["cidade"] ?? "";
        $cep = $this->request["cep"] ?? "";
        $bairro = $this->request["bairro"] ?? "";
        $logradouro = $this->request["logradouro"] ?? "";
        $numero = $this->request["numero"] ?? "";
        $complemento = $this->request["complemento"] ?? "";

        // ATUALIZAR
        if (!empty($idCliente) && is_numeric($idCliente)) {
            $mensagem = "Cliente atualizado com sucesso.";

            $sql = "UPDATE
                        {$this->nomeTabela}
                    SET
                        nome = '{$nome}'
                        sobrenome = '{$sobrenome}'
                        data_nascimento = '{$data_nascimento}'
                        sexo = '{$sexo}'
                        rg = '{$rg}'
                        status = '{$status}',
                        cpf = '{$cpf}'
                        cnpj = '{$cnpj}'
                        tipo = '{$tipo}'
                        email = '{$email}'
                        telefone = '{$telefone}'
                        celular = '{$celular}'
                        estado = '{$estado}'
                        sigla_estado = '{$sigla_estado}'
                        cidade = '{$cidade}'
                        cep = '{$cep}'
                        bairro = '{$bairro}'
                        logradouro = '{$logradouro}'
                        numero = '{$numero}'
                        complemento = '{$complemento}'
                    WHERE
                        id = {$idCliente};";
        } else {
            $mensagem = "Cliente cadastrado com sucesso.";

            $sql = "INSERT
                    INTO
                        {$this->nomeTabela}
                    (
                        nome,
                        sobrenome,
                        data_nascimento,
                        sexo,
                        rg,
                        status,
                        cpf,
                        cnpj,
                        tipo,
                        email,
                        telefone,
                        celular,
                        estado,
                        sigla_estado,
                        cidade,
                        cep,
                        bairro,
                        logradouro,
                        numero,
                        complemento
                    )
                    VALUES(
                        '{$nome}',
                        '{$sobrenome}',
                        '{$data_nascimento}',
                        '{$sexo}',
                        '{$rg}',
                        '{$status}',
                        '{$cpf}',
                        '{$cnpj}',
                        '{$tipo}',
                        '{$email}',
                        '{$telefone}',
                        '{$celular}',
                        '{$estado}',
                        '{$sigla_estado}',
                        '{$cidade}',
                        '{$cep}',
                        '{$bairro}',
                        '{$logradouro}',
                        '{$numero}',
                        '{$complemento}'
                    );";
        }

        $result = $this->conexao->query($sql);

        if ($result) {
            $dados = [
                "success" => 201,
                "mensagem" => $mensagem
            ];
        }

        $this->setResponseAPI($dados);
    }
}

// inicializamos (instanciamos) nossa variável (objeto).
$objClientesController = new ClientesController($conexao);

// aqui obtemos nossa rota informada la no frontend (javascript) e conforme a rota informada redirecionamos a ação.
switch ($objClientesController->getRota()) {
    case "listarTodosClientes":
            $objClientesController->listarClientes();
        break;
    case "editarCliente":
            $objClientesController->obterDadosCliente();
        break;
    case "excluirCliente":
            $objClientesController->excluirCliente();
        break;
    case "salvarAtualizarCliente":
            $objClientesController->salvarAtualizarCliente();
        break;
    default:
            $objClientesController->setResponseAPI(["erro" => "404", "mensagem" => "Rota inválida ou não encontrada."]);
        break;
}

// após termino execução encerramos a conexao com o banco
$objClientesController->desconectar();

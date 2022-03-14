<?php

require "../database/Conexao.php"; // require - importa uma vez | require_once - importa toda vez que o arquivo produtos é acessado/chamado.

class ProdutosController
{
    private $rota = null;
    private $conexao = null;
    public $request = null;
    protected $nomeTabela = "produtos";

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
        $this->request = $_REQUEST;
        $this->rota = $this->request['rota'] ?? ""; // se não tiver a palavra rota nos parâmetros da URL informamos vazio.
    }

    // retorna a rota para sabermos qual função utilizar (dadosProdutos | obterDadosProduto | excluirProduto...).
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

    // obtém todos os produtos
    public function listarProdutos()
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

    // obtém dados de 1 produto (EDITAR).
    public function obterDadosProduto()
    {
        $idProduto = $this->request["id"] ?? 0;

        $dados = [];

        if (!empty($idProduto) && is_numeric($idProduto)) {
            $sql = "SELECT * FROM {$this->nomeTabela} WHERE id={$idProduto} LIMIT 1";
            $result = $this->conexao->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dados[] = $row;
                }
            }
        }

        $this->setResponseAPI($dados);
    }

    // apenas mudamos o status o produto para inativo para dizermos que ele está excluído.
    public function excluirProduto()
    {
        $idProduto = $this->request["id"] ?? 0;

        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível excluir o produto. Contate o administrados!"
        ];

        if (!empty($idProduto) && is_numeric($idProduto)) {
            $sql = "UPDATE {$this->nomeTabela} SET status = 0 WHERE id={$idProduto}";
            // $sql = "DELETE FROM {$this->nomeTabela} WHERE id={$idProduto}";
            $result = $this->conexao->query($sql);

            // verificamos se de fato o produto foi alterado/excluido
            $sql = "SELECT * FROM {$this->nomeTabela} WHERE id={$idProduto} AND status = 0 LIMIT 1";
            $result = $this->conexao->query($sql);

            if ($result->num_rows > 0) {
                $dados = [
                    "success" => 201,
                    "mensagem" => "Produto excluído."
                ];
            }
        }

        $this->setResponseAPI($dados);
    }

    public function salvarAtualizarProduto()
    {
        $dados = [
            "error" => 500,
            "mensagem" => "Não foi possível salvar o produto. Contate o administrados!"
        ];

        $idProduto = $this->request["id"] ?? 0;
        $nome = $this->request["nome"] ?? "";
        $descricao = $this->request["descricao"] ?? "";
        $quantidade = $this->request["quantidade"] ?? 0;
        $peso = $this->request["peso"] ?? 0;
        $classificacao = $this->request["classificacao"] ?? "";
        $status = $this->request["status"] ?? 0;
        $largura = $this->request["largura"] ?? 0;
        $altura = $this->request["altura"] ?? 0;
        $profundidade = $this->request["profundidade"] ?? 0;
        $preco = $this->request["preco"] ?? 0;
        $preco_promocional = $this->request["preco_promocional"] ?? 0;
        $gtin = $this->request["gtin"] ?? "";
        $unidade_medida = $this->request["unidade_medida"] ?? "";
        $condicao = $this->request["condicao"] ?? "";
        $codigo_sku = $this->request["codigo_sku"] ?? "";

        // ATUALIZAR
        if (!empty($idProduto) && is_numeric($idProduto)) {
            $mensagem = "Produto atualizado com sucesso.";

            $sql = "UPDATE
                        {$this->nomeTabela}
                    SET
                        nome = '{$nome}',
                        descricao = '{$descricao}',
                        quantidade = '{$quantidade}',
                        peso = '{$peso}',
                        classificacao = '{$classificacao}',
                        status = '{$status}',
                        largura = '{$largura}',
                        altura = '{$altura}',
                        profundidade = '{$profundidade}',
                        preco = '{$preco}',
                        preco_promocional = '{$preco_promocional}',
                        gtin = '{$gtin}',
                        unidade_medida = '{$unidade_medida}',
                        condicao = '{$condicao}',
                        codigo_sku = '{$codigo_sku}'
                    WHERE
                        id = {$idProduto};";
        } else {
            $mensagem = "Produto cadastrado com sucesso.";

            $sql = "INSERT
                    INTO
                        {$this->nomeTabela}
                    (
                        nome,
                        descricao,
                        quantidade,
                        peso,
                        classificacao,
                        status,
                        largura,
                        altura,
                        profundidade,
                        preco,
                        preco_promocional,
                        gtin,
                        unidade_medida,
                        condicao,
                        codigo_sku
                    )
                    VALUES(
                        '{$nome}',
                        '{$descricao}',
                        '{$quantidade}',
                        '{$peso}',
                        '{$classificacao}',
                        '{$status}',
                        '{$largura}',
                        '{$altura}',
                        '{$profundidade}',
                        '{$preco}',
                        '{$preco_promocional}',
                        '{$gtin}',
                        '{$unidade_medida}',
                        '{$condicao}',
                        '{$codigo_sku}'
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
$objProdutosController = new ProdutosController($conexao);

// aqui obtemos nossa rota informada la no frontend (javascript) e conforme a rota informada redirecionamos a ação.
switch ($objProdutosController->getRota()) {
    case "listarTodosProdutos":
            $objProdutosController->listarProdutos();
        break;
    case "editarProduto":
            $objProdutosController->obterDadosProduto();
        break;
    case "excluirProduto":
            $objProdutosController->excluirProduto();
        break;
    case "salvarAtualizarProduto":
            $objProdutosController->salvarAtualizarProduto();
        break;
    default:
            $objProdutosController->setResponseAPI(["erro" => "404", "mensagem" => "Rota inválida ou não encontrada."]);
        break;
}

// após termino execução encerramos a conexao com o banco
$objProdutosController->desconectar();

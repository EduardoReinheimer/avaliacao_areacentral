<?php
require_once '../Conexao.php';
require_once '../projeto/produto/Produto.php';

class Venda
{
    private $id;
    private $produto_id;
    private $produto_descricao;
    private $total;
    private $quantidade;
    private $valor_unitario;


    function __construct($id = null, $produto_id = null, $quantidade = null, $valor_unitario = null)
    {
        $this->id = $this->setId($id);
        $this->produto_id = $this->setProdutoId($produto_id);
        $this->quantidade = $this->setQuantidade($quantidade);
        $this->valor_unitario = $this->setValorUnitario($valor_unitario);
    }

    public function getId()
    {
        return $this->id;
    }
    private function setId($id)
    {
        $this->id = $id;
    }

    public function getProdutoId()
    {
        return $this->produto_id;
    }

    private function setProdutoId($produto_id)
    {
        $this->produto_id = $produto_id;
    }

    public function getDescricaoProduto()
    {
        return $this->produto_descricao;
    }

    private function setDescricaoProduto($produto_descricao)
    {
        $this->produto_descricao = $produto_descricao;
    }

    public function getValorTotal()
    {
        return $this->total;
    }

    private function setValorTotal($total)
    {
        $this->total = $total;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    private function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getValorUnitario()
    {
        return $this->valor_unitario;
    }

    private function setValorUnitario($valor_unitario)
    {
        $this->valor_unitario = $valor_unitario;
    }



    /**
     * retorna um Produto com base no Id de produto salvo
     */
    public function getProduto()
    {
        $produto = new Produto();
        $produto . getById($this->getProdutoId());
        return $produto;
    }

    /**
     * Retorna a quantidade de vendas
     */
    public function count()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT COUNT(*) as qtd_ativos FROM venda");

        $qtd_ativos = 0;
        if ($conn->getQuery()) {
            $linha = $conn->getArrayResults();
            $qtd_ativos =  $linha[0]['qtd_ativos'];
        }
        $conn->closeConexao();
        return $qtd_ativos;
    }

    /***
     * Retorna uma lista com todas as ocorrências ativas
     */
    public function listAll()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT
                    v.ven_id,
                    p.pro_id,
                    p.pro_desc,
                    v.ven_qtd,
                    p.pro_vlrunt,
                    (v.ven_qtd * p.pro_vlrunt) as total
        FROM venda v
        left join produto p on 
            p.pro_id = v.pro_id
        group by v.ven_id");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $venda = new Venda();
                $venda->setId($linha['ven_id']);
                $venda->setProdutoId($linha['pro_id']);
                $venda->setDescricaoProduto($linha['pro_desc']);
                $venda->setValorUnitario($linha['pro_vlrunt']);
                $venda->setQuantidade($linha['ven_qtd']);
                $venda->setValorTotal($linha['total']);
                $retorno[] = $venda;
            }
        }
        $conn->closeConexao();
        return $retorno;
    }

    /***
     * Retorna uma lista com todas as ocorrências ativas pelo termo de busca
     */
    public function listAllBySearchTerm($searchterm)
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT
                    v.ven_id,
                    p.pro_id,
                    p.pro_desc,
                    v.ven_qtd,
                    p.pro_vlrunt,
                    (v.ven_qtd * p.pro_vlrunt) as total
        FROM venda v
        left join produto p on 
            p.pro_id = v.pro_id
        where 
            p.pro_desc like '%$searchterm%' or
            p.pro_id = '$searchterm'
        group by v.ven_id");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $venda = new Venda();
                $venda->setId($linha['ven_id']);
                $venda->setProdutoId($linha['pro_id']);
                $venda->setDescricaoProduto($linha['pro_desc']);
                $venda->setValorUnitario($linha['pro_vlrunt']);
                $venda->setQuantidade($linha['ven_qtd']);
                $venda->setValorTotal($linha['total']);
                $retorno[] = $venda;
            }
        }
        $conn->closeConexao();
        return $retorno;
    }
}

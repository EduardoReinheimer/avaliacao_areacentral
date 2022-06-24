<?php
require_once '../Conexao.php';

class Produto
{
    private $id;
    private $desc;
    private $vlrunt;
    private $qtdestoque;
    private $codbarras;
    private $ativo;
    private $data_venda;
    private $total_vendas;

    function __construct($id = null, $desc = null, $vlrunt = null, $qtdestoque = null, $codbarras = null, $ativo = 'S')
    {
        $this->id = $this->setId($id);
        $this->desc = $this->setDescricao($desc);
        $this->vlrunt = $this->setValorUnitario($vlrunt);
        $this->qtdestoque = $this->setQuantidadeEstoque($qtdestoque);
        $this->codbarras = $this->setCodigoBarras($codbarras);
        $this->ativo = $this->setProdutoAtivo($ativo);
    }

    public function getId()
    {
        return (int) $this->id;
    }

    private function setId($id)
    {
        $this->id = $id;
    }

    public function getDescricao()
    {
        return $this->desc;
    }

    public function setDescricao($desc)
    {
        $this->desc = $desc;
    }

    public function getValorUnitario()
    {
        return (float)$this->vlrunt;
    }

    public function setValorUnitario($vlrunt)
    {
        $this->vlrunt = $vlrunt;
    }

    public function getQuantidadeEstoque()
    {
        return (int) $this->qtdestoque;
    }

    private function setQuantidadeEstoque($qtdestoque)
    {
        $this->qtdestoque = $qtdestoque;
    }

    public function getCodigoBarras()
    {
        return $this->codbarras;
    }

    private function setCodigoBarras($codbarras)
    {
        $this->codbarras = $codbarras;
    }

    public function getProdutoAtivo()
    {
        return $this->ativo == 'S';
    }

    private function setProdutoAtivo($ativo)
    {
        $this->ativo = $ativo == 'S' ? 'S' : 'N';
    }

    public function getDataVenda()
    {
        return isset($this->data_venda) ? $this->data_venda : "00/00/0000";
    }

    private function setDataVenda($data_venda)
    {
        $this->data_venda = $data_venda;
    }

    public function getTotalVendas()
    {
        return isset($this->total_vendas) ? $this->total_vendas : 0;
    }

    private function setTotalVendas($total_vendas)
    {
        $this->total_vendas = $total_vendas;
    }

    /***
     * Retorna uma lista com todas as ocorrências ativas
     */
    public function listAll()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT 
                    p.pro_id,
                    p.pro_desc,
                    p.pro_vlrunt,
                    p.pro_qtdestoque,
                    p.pro_codbarras,
                    p.pro_ativo,
                    MAX(v.ven_data) as ultima_venda,
                    SUM(v.ven_qtd) as total_vendas
        FROM produto p
        LEFT JOIN venda v on
            p.pro_id = v.pro_id
            where p.pro_ativo = 'S'
         GROUP BY p.pro_id");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $produto = new Produto();
                $produto->setId($linha['pro_id']);
                $produto->setDescricao($linha['pro_desc']);
                $produto->setValorUnitario($linha['pro_vlrunt']);
                $produto->setQuantidadeEstoque($linha['pro_qtdestoque']);
                $produto->setCodigoBarras($linha['pro_codbarras']);
                $produto->setProdutoAtivo($linha['pro_ativo']);
                $produto->setDataVenda($linha['ultima_venda']);
                $produto->setTotalVendas($linha['total_vendas']);
                $retorno[] = $produto;
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
                    p.pro_id,
                    p.pro_desc,
                    p.pro_vlrunt,
                    p.pro_qtdestoque,
                    p.pro_codbarras,
                    p.pro_ativo,
                    MAX(v.ven_data) as ultima_venda,
                    SUM(v.ven_qtd) as total_vendas
        FROM produto p
        LEFT JOIN venda v on
            p.pro_id = v.pro_id
            where p.pro_ativo = 'S' and (
            p.pro_desc like '%$searchterm%' or
            p.pro_id = '$searchterm')
         GROUP BY p.pro_id;");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $produto = new Produto();
                $produto->setId($linha['pro_id']);
                $produto->setDescricao($linha['pro_desc']);
                $produto->setValorUnitario($linha['pro_vlrunt']);
                $produto->setQuantidadeEstoque($linha['pro_qtdestoque']);
                $produto->setCodigoBarras($linha['pro_codbarras']);
                $produto->setProdutoAtivo($linha['pro_ativo']);
                $produto->setDataVenda($linha['ultima_venda']);
                $produto->setTotalVendas($linha['total_vendas']);
                $retorno[] = $produto;
            }
        }
        $conn->closeConexao();
        return $retorno;
    }

    /***
     * Retorna uma lista com todas as ocorrências na lixeira
     */
    public function listAllLixeira()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT 
                    p.pro_id,
                    p.pro_desc,
                    p.pro_vlrunt,
                    p.pro_qtdestoque,
                    p.pro_codbarras,
                    p.pro_ativo
        FROM produto p WHERE p.pro_ativo = 'N'");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $produto = new Produto();
                $produto->setId($linha['pro_id']);
                $produto->setDescricao($linha['pro_desc']);
                $produto->setValorUnitario($linha['pro_vlrunt']);
                $produto->setQuantidadeEstoque($linha['pro_qtdestoque']);
                $produto->setCodigoBarras($linha['pro_codbarras']);
                $produto->setProdutoAtivo($linha['pro_ativo']);
                $retorno[] = $produto;
            }
        }
        $conn->closeConexao();
        return $retorno;
    }

    /***
     * Retorna uma lista com todas as ocorrências na lixeira por termo de busca
     */
    public function listAllLixeiraBySearchTerm($searchterm)
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT 
                    p.pro_id,
                    p.pro_desc,
                    p.pro_vlrunt,
                    p.pro_qtdestoque,
                    p.pro_codbarras,
                    p.pro_ativo
        FROM produto p WHERE p.pro_ativo = 'N' and
            (p.pro_desc like '%$searchterm%' or
            p.pro_id = '$searchterm')");

        $retorno = [];

        if ($conn->getQuery()) {
            foreach ($conn->getArrayResults() as $linha) {
                $produto = new Produto();
                $produto->setId($linha['pro_id']);
                $produto->setDescricao($linha['pro_desc']);
                $produto->setValorUnitario($linha['pro_vlrunt']);
                $produto->setQuantidadeEstoque($linha['pro_qtdestoque']);
                $produto->setCodigoBarras($linha['pro_codbarras']);
                $produto->setProdutoAtivo($linha['pro_ativo']);
                $retorno[] = $produto;
            }
        }
        $conn->closeConexao();
        return $retorno;
    }

    /***
     * Ao passar ID para objeto, popula os demais campos com informações do banco de dados
     */
    public function getById($id)
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT 
                    p.pro_id,
                    p.pro_desc,
                    p.pro_vlrunt,
                    p.pro_qtdestoque,
                    p.pro_codbarras,
                    p.pro_ativo
        FROM produto p WHERE p.pro_id = $id");


        if ($conn->getQuery()) {
            $linha = $conn->getArrayResults();
            if (isset($linha[0]['pro_id'])) {
                $this->setId($linha[0]['pro_id']);
                $this->setDescricao($linha[0]['pro_desc']);
                $this->setValorUnitario($linha[0]['pro_vlrunt']);
                $this->setQuantidadeEstoque($linha[0]['pro_qtdestoque']);
                $this->setCodigoBarras($linha[0]['pro_codbarras']);
                $this->setProdutoAtivo($linha[0]['pro_ativo']);
            }
        }
        $conn->closeConexao();
    }

    /***
     * Retorna a quantidade de produtos ativos
     */
    public function countAtivos()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT COUNT(*) as qtd_ativos FROM produto p WHERE p.pro_ativo = 'S'");

        $qtd_ativos = 0;
        if ($conn->getQuery()) {
            $linha = $conn->getArrayResults();
            $qtd_ativos =  $linha[0]['qtd_ativos'];
        }
        $conn->closeConexao();
        return $qtd_ativos;
    }
}

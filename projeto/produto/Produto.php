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
        return $this->id;
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
        return $this->vlrunt;
    }

    public function setValorUnitario($vlrunt)
    {
        $this->vlrunt = $vlrunt;
    }

    public function getQuantidadeEstoque()
    {
        return $this->qtdestoque;
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
                    p.pro_ativo
        FROM produto p WHERE p.pro_ativo = 'S'");

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
}

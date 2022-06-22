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

    function __construct($id = null, $desc = null, $vlrunt = null, $qtdestoque = null, $codbarras = null, $ativo = 'S'){
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

    private function setDescricao($desc)
    {
        $this->desc = $desc;
    }

    public function getValorUnitario()
    {
        return $this->vlrunt;
    }

    private function setValorUnitario($vlrunt)
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

    public function listAll()
    {
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT * FROM produto");

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

    public function getById($id){
        $conn = new Conexao();
        $conn->setConexao();

        $conn->query("SELECT * FROM produto WHERE pro_id = $this->getId()");

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
}

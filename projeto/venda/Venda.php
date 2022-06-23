<?php 
require_once '../Conexao.php';
require_once '../projeto/produto/Produto.php';

class Venda {
    private $id;
    private $produto_id;
    private $quantidade;
    private $valor_unitario;

    function __construct($id = null, $produto_id = null, $quantidade = null, $valor_unitario = null){
        $this->id = $this->setId($id);
        $this->produto_id = $this->setProdutoId($produto_id);
        $this->quantidade = $this->setQuantidade($quantidade);
        $this->valor_unitario = $this->setValorUnitario($valor_unitario);
    }

    public function getId(){
        return $this->id;
    }
    private function setId($id){
        $this->id = $id;
    }

    public function getProdutoId(){
        return $this->produto_id;
    }

    private function setProdutoId($produto_id){
        $this->produto_id = $produto_id;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    private function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getValorUnitario(){
        return $this->valor_unitario;
    }

    private function setValorUnitario($valor_unitario){
        $this->valor_unitario = $valor_unitario;
    }

    /**
     * retorna um Produto com base no Id de produto salvo
     */
    public function getProduto(){
        $produto = new Produto();
        $produto.getById($this->getProdutoId());
        return $produto;
    }

    /**
     * Retorna a quantidade de vendas
     */
    public function count(){
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

}

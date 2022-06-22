<?php 
require_once '../projeto/produto/Produto.php';
function listAllProdutos(){

    $produtos = [];
    $obj = new Produto();
    $produtos = $obj->listAll();
    if(count($produtos) < 1){
        $produtos = [];
    }
    return $produtos;
}

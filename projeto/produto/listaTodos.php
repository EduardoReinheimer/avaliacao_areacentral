<?php 
require_once '../projeto/produto/Produto.php';

function listAllProdutos($termobusca = null){

    $produtos = [];
    $obj = new Produto();
    $produtos = is_null($termobusca) ? $obj->listAll() : $obj->listAllBySearchTerm($termobusca);
    if(count($produtos) < 1){
        $produtos = [];
    }
    return $produtos;
}

function listAllProdutosExcluidos(){

    $produtos = [];
    $obj = new Produto();
    $produtos = $obj->listAllLixeira();
    if(count($produtos) < 1){
        $produtos = [];
    }
    return $produtos;
}

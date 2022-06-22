<?php
header("Location: ${$_SERVER['SERVER_NAME']}/produtos.php");
require_once '../../Conexao.php';

$descricao = $_POST['descricao'];
$qtdestoque = $_POST["qtdestoque"];
$codbarras = $_POST["codbarras"];
$vlrunt = $_POST["vlrunt"];

$conn = new Conexao();
$conn->setConexao();

$conn->query("INSERT INTO `produto`(
                            `pro_desc`, 
                            `pro_vlrunt`, 
                            `pro_qtdestoque`, 
                            `pro_codbarras`, 
                            `pro_ativo`) VALUES (
                            '$descricao',
                            '$vlrunt',
                            '$qtdestoque',
                            '$codbarras',
                            'S'
                            )");
$conn->closeConexao();

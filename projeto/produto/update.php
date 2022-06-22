<?php
header("Location: ${$_SERVER['SERVER_NAME']}/produtos.php");
require_once '../../Conexao.php';

$id = $_POST['id'];
$descricao = $_POST['descricao'];
$qtdestoque = $_POST["qtdestoque"];
$codbarras = $_POST["codbarras"];
$vlrunt = $_POST["vlrunt"];

$conn = new Conexao();
$conn->setConexao();

$conn->query("UPDATE `produto` SET 
            `pro_desc`='$descricao',
            `pro_vlrunt`=$vlrunt,
            `pro_qtdestoque`=$qtdestoque,
            `pro_codbarras`='$codbarras'
            WHERE `pro_id`=$id");
$conn->closeConexao();

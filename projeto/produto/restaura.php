<?php
header("Location: ${$_SERVER['SERVER_NAME']}/produtos.php");
require_once '../../Conexao.php';

$id = $_GET['id'];

$conn = new Conexao();
$conn->setConexao();

$conn->query("UPDATE `produto` SET 
`pro_ativo`='S'
WHERE `pro_id`=$id");
$conn->closeConexao();

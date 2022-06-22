<?php
header("Location: ${$_SERVER['SERVER_NAME']}/produtos.php");
require_once '../../Conexao.php';

$id = $_GET['id'];

$conn = new Conexao();
$conn->setConexao();

$conn->query("DELETE FROM `produto` WHERE `pro_id`=$id");
$conn->closeConexao();

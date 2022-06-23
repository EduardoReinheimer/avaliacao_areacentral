<?php
header("Location: ${$_SERVER['SERVER_NAME']}/produtos.php");
require_once '../../Conexao.php';

$quantidade = $_POST["quantidade"];
$atualiza = $_POST['atualiza'] == 'on' ? true : false;
$produto_id = $_POST['produto'];
$vlrunt = $_POST["vlrunt"];

$conn = new Conexao();
$conn->setConexao();

$conn->query("INSERT INTO `venda`(`pro_id`, `ven_qtd`) VALUES ('$produto_id',$quantidade)");
if ($atualiza) {
    $conn->query("UPDATE `produto` SET `pro_vlrunt`=$vlrunt WHERE `pro_id`=$produto_id");
}

$conn->closeConexao();

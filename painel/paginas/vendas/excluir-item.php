<?php 
$tabela = 'itens_venda';
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * from $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_produto = $res[0]['produto'];
$quantidade = $res[0]['quantidade'];

$query = $pdo->query("SELECT * from produtos where id = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';

$novo_estoque = $estoque + $quantidade;
//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 
?>
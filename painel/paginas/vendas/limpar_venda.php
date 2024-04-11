<?php 
$tabela = 'itens_venda';
require_once("../../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id'];

$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and id_venda = '0' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id_produto = $res[$i]['produto'];
	$quantidade = $res[$i]['quantidade'];
	$id = $res[$i]['id'];

$query2 = $pdo->query("SELECT * from produtos where id = '$id_produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res2[0]['estoque'];

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");

$novo_estoque = $estoque + $quantidade;
//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 

}

}

?>
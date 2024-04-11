<?php 
$tabela = 'servicos_orc';
require_once("../../../conexao.php");

$id = @$_POST['id'];
$quant = @$_POST['quant'];

if($quant == 0){
	$pdo->query("DELETE FROM $tabela WHERE id = '$id'");
	exit();
}

$query2 = $pdo->query("SELECT * from $tabela where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$valor = $res2[0]['valor'];

$total = $quant * $valor;
$pdo->query("UPDATE $tabela SET quantidade = '$quant', total = '$total' WHERE id = '$id'");


?>
<?php 
require_once("../../../conexao.php");
$pagina = 'servicos_orc';

@session_start();
$id_usuario = @$_SESSION['id'];

$servico = @$_POST['servico'];
$id = @$_POST['id'];
$total_quant = 1;

if($id == ""){
	$id = 0;
}

$query = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor'];
$total = $valor * $total_quant;

$query = $pdo->query("SELECT * FROM $pagina where servico = '$servico' and funcionario = '$id_usuario' and os = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$quantidade = $res[0]['quantidade'];
	$total_quant += $quantidade;
	$total = $valor * $total_quant;

	$pdo->query("UPDATE $pagina SET quantidade = '$total_quant', total = '$total' WHERE servico = '$servico' and funcionario = '$id_usuario' and os = '$id'");

}else{
	$pdo->query("INSERT INTO $pagina SET servico = '$servico', os = '$id', funcionario = '$id_usuario', quantidade = '$total_quant', valor = '$valor', total = '$total'");
}

?>
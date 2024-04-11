<?php 
require_once("../../../conexao.php");
$pagina = 'produtos_orc';

@session_start();
$id_usuario = @$_SESSION['id'];

$produto = @$_POST['produto'];
$id = @$_POST['id'];
$total_quant = 1;

if($id == ""){
	$id = 0;
}

$query = $pdo->query("SELECT * FROM produtos where id = '$produto' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor = $res[0]['valor_venda'];
$total = $valor * $total_quant;

$query = $pdo->query("SELECT * FROM $pagina where produto = '$produto' and funcionario = '$id_usuario' and os = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$quantidade = $res[0]['quantidade'];
	$total_quant += $quantidade;
	$total = $valor * $total_quant;

	$pdo->query("UPDATE $pagina SET quantidade = '$total_quant', total = '$total' WHERE produto = '$produto' and funcionario = '$id_usuario' and os = '$id'");

}else{
	$pdo->query("INSERT INTO $pagina SET produto = '$produto', os = '$id', funcionario = '$id_usuario', quantidade = '$total_quant', valor = '$valor', total = '$total'");
}

?>
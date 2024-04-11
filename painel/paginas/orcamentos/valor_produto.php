<?php 
$tabela = 'produtos_orc';
require_once("../../../conexao.php");

$id = @$_POST['id'];
$valor = @$_POST['valor'];
$valor = str_replace(',', '.', $valor);

$query2 = $pdo->query("SELECT * from $tabela where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$quant = $res2[0]['quantidade'];

$total = $quant * $valor;
$pdo->query("UPDATE $tabela SET valor = '$valor', total = '$total' WHERE id = '$id'");


?>
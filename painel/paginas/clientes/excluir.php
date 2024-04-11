<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM orcamentos where cliente = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Você não pode excluir este cliente, existem orçamentos associados a ele, primeiro exclua esses orçamentos e depois exclua o cliente!';
	exit();
}


$query = $pdo->query("SELECT * FROM os where cliente = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Você não pode excluir este cliente, existem OS associadas a ele, primeiro exclua essas OS e depois exclua o cliente!';
	exit();
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
$pdo->query("DELETE FROM usuarios WHERE id_ref = '$id' and nivel = 'Cliente' ");
echo 'Excluído com Sucesso';
?>
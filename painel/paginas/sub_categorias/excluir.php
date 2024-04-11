<?php 
$tabela = 'sub_categorias';
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM produtos where sub_categoria = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Você não pode excluir essa sub_categoria pois tem produtos relacionados a ela, exclua primeiro os produtos, e depois a sub_categoria!';
	exit();
}


$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>
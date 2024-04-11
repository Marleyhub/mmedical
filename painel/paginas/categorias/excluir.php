<?php 
$tabela = 'categorias';
require_once("../../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM produtos where categoria = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Você não pode excluir essa categoria pois tem produtos relacionados a ela, exclua primeiro os produtos e depois a categoria!';
	exit();
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$foto = $res[0]['foto'];

if($foto != "sem-foto.jpg"){
	@unlink('../../images/categorias/'.$foto);
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");
echo 'Excluído com Sucesso';
?>
<?php 
$tabela = 'modelos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, ativo = 'Sim' ");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome where id = '$id'");
}

// recuperar
$query->bindValue(":nome", "$nome");

$query->execute();

echo 'Salvo com Sucesso';

 ?>
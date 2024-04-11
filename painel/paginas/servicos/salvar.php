<?php 
$tabela = 'servicos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$dias = $_POST['dias'];
$comissao = $_POST['comissao'];
$id = $_POST['id'];

$valor = str_replace(',', '.', $valor);

//validacao email
$query = $pdo->query("SELECT * from $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Serviço já Cadastrado!';
	exit();
}


//validacao nome
$query = $pdo->query("SELECT * from $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Serviço já Existe!';
	exit();
}


if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, valor = :valor, dias = :dias, comissao = :comissao, ativo = 'Sim' ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, valor = :valor, dias = :dias, comissao = :comissao where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":valor", "$valor");
$query->bindValue(":dias", "$dias");
$query->bindValue(":comissao", "$comissao");
$query->execute();

echo 'Salvo com Sucesso';


 ?>

<?php 
$tabela = 'entradas';
require_once("../../../conexao.php");

@session_start();
$id_usuario = @$_SESSION['id'];

$quantidade_entrada = $_POST['quantidade_entrada'];
$motivo_entrada = $_POST['motivo_entrada'];
$id_produto = $_POST['id'];
$estoque = $_POST['estoque'];

$total_produtos = $estoque + $quantidade_entrada;

$query = $pdo->prepare("INSERT INTO $tabela SET produto = '$id_produto', quantidade = '$quantidade_entrada', motivo = :motivo, usuario = '$id_usuario', data = curDate() ");

$query->bindValue(":motivo", "$motivo_entrada");
$query->execute();

$pdo->query("UPDATE produtos SET estoque = '$total_produtos' where id = '$id_produto' ");

echo 'Salvo com Sucesso';

?>
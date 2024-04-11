<?php 
$tabela = 'servicos_orc';
require_once("../../../conexao.php");

$id = @$_POST['id'];
$pdo->query("DELETE FROM $tabela WHERE id = '$id'");

?>
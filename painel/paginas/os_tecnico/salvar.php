<?php 
$tabela = 'os';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');


$id = $_POST['id'];

$equipamento = $_POST['equipamento'];
$modelo = @$_POST['modelo'];
$marca = $_POST['marca'];

$defeito = $_POST['defeito'];
$acessorios = $_POST['acessorios'];
$condicoes = $_POST['condicoes'];
$laudo = $_POST['laudo'];
$obs = $_POST['obs'];
$senha = $_POST['senha'];
$dias_garantia = @$_POST['dias_garantia'];


$query = $pdo->prepare("UPDATE $tabela SET equipamento = :equipamento, marca = :marca, modelo = :modelo, defeito = :defeito, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, obs = :obs, senha = :senha, dias_garantia = :dias_garantia  where id = '$id'");



$query->bindValue(":equipamento", "$equipamento");
$query->bindValue(":marca", "$marca");
$query->bindValue(":modelo", "$modelo");
$query->bindValue(":defeito", "$defeito");
$query->bindValue(":acessorios", "$acessorios");
$query->bindValue(":condicoes", "$condicoes");
$query->bindValue(":laudo", "$laudo");
$query->bindValue(":obs", "$obs");
$query->bindValue(":senha", "$senha");
$query->bindValue(":dias_garantia", "$dias_garantia");
$query->execute();


echo 'Salvo com Sucesso'; 


?>
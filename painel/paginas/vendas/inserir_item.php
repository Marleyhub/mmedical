<?php 
$tabela = 'itens_venda';
require_once("../../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id'];

$quantidade = $_POST['quantidade'];
$id_produto = $_POST['id_produto'];

$query = $pdo->query("SELECT * from produtos where id = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res[0]['estoque'];
$valor = $res[0]['valor_venda'];

if($valor <= 0){
	echo 'O valor do produto tem que ser maior que zero';
	exit();
}

if($quantidade > $estoque){
	echo 'A quantidade de produtos não pode ser maior que a quantidade em estoque, por enquanto você tem '.$estoque.' itens deste produto no estoque!';
	exit();
}

$total = $quantidade * $valor;

$pdo->query("INSERT INTO itens_venda SET produto = '$id_produto', valor = '$valor', quantidade = '$quantidade', total = '$total', id_venda = '0', funcionario = '$id_usuario'");

echo 'Inserido com Sucesso';


$novo_estoque = $estoque - $quantidade;
//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 

?>
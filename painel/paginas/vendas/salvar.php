<?php 
$tabela = 'receber';
require_once("../../../conexao.php");

$data_atual = date('Y-m-d');

@session_start();
$id_usuario = $_SESSION['id'];

$troco = $_POST['troco'];
$desconto = $_POST['desconto'];
$cliente = $_POST['cliente'];
$saida = $_POST['saida'];
$data = $_POST['data2'];

$dataF = implode('/', array_reverse(explode('-', $data)));

if($desconto == ""){
	$desconto = 0;
}

$total_final = -$desconto;
$query = $pdo->query("SELECT * from itens_venda where funcionario = '$id_usuario' and id_venda = '0' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$produto = $res[$i]['produto'];
	$valor = $res[$i]['valor'];
	$quantidade = $res[$i]['quantidade'];
	$total = $res[$i]['total'];

	$total_final += $total;
	$total_finalF = number_format($total_final, 2, ',', '.');
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');
	
	if($troco > 0){
		$total_troco = $troco - $total_final;
		$total_trocoF = number_format($total_troco, 2, ',', '.');
	}

}

}

if($total_final <= 0){
	echo 'O valor da Venda tem que ser maior que zero';
	exit();
}

if($troco < $total_final and $troco != ""){
	echo 'O total a pagar não pode ser menor que o total da venda!';
	exit();
}

if(strtotime($data) > strtotime($data_atual)){
	$pago = 'Não';
	$data_pgto = '';
	$usuario_pgto = '';
}else{
	$pago = 'Sim';
	$data_pgto = $data;
	$usuario_pgto = $id_usuario;
}

$pdo->query("INSERT INTO receber SET descricao = 'Nova Venda', valor = '$total_final', data_venc = '$data', data_lanc = curDate(), data_pgto = '$data_pgto', usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = '$pago', usuario_pgto = '$usuario_pgto', cliente = '$cliente', referencia = 'Venda', hora = curTime(), saida = '$saida', desconto = '$desconto', troco = '$troco'");
$id_venda = $pdo->lastInsertId();

$pdo->query("UPDATE itens_venda SET id_venda = '$id_venda' WHERE id_venda = 0 and funcionario = '$id_usuario'");

echo 'Salvo com Sucesso-'.$id_venda;

//enviar para o whatsapp
if(strtotime($data) > strtotime($data_atual) and $api_whatsapp == 'Sim'){
$query = $pdo->query("SELECT * from clientes where id = '$cliente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res[0]['telefone'];
$nome = $res[0]['nome'];

$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	$mensagem = '_Nova Compra '.$nome_sistema.'_ %0A';
		$mensagem .= 'Nome: *'.$nome.'* %0A';
		$mensagem .= 'Valor Compra: *'.$total_finalF.'* %0A';
		$mensagem .= 'Data de Pagamento: *'.$dataF.'*';
		
	require('../../../apis/api_texto.php');
}

 ?>
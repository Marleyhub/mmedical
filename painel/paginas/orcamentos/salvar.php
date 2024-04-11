<?php 
$tabela = 'orcamentos';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];


$data_atual = date('Y-m-d');

$equipamento = @$_POST['equipamento'];
$marca = @$_POST['marca'];
$modelo = @$_POST['modelo'];
$data_entrega = @$_POST['data_entrega'];
$cliente = @$_POST['cliente'];
$valor = @$_POST['valor'];
$dias_validade = @$_POST['dias_validade'];
$desconto = @$_POST['desconto'];
$tipo_desconto = $_POST['tipo_desconto'];
$defeito = @$_POST['defeito'];
$obs = $_POST['obs'];
$frete = $_POST['frete'];
$frete = str_replace(',', '.', $frete);
$id = $_POST['id'];
$vall = @$_POST['vall'];
$vall = str_replace(',', '.', $vall);
$acessorios = @$_POST['acessorios'];
$condicoes = @$_POST['condicoes'];
$laudo = $_POST['laudo'];
$senha = @$_POST['senha'];
$enviar_pdf = @$_POST['enviar_pdf'];

$data_entregaF = implode('/', array_reverse(explode('-', $data_entrega)));


if($cliente == ""){
	echo 'Escolha um Cliente';
	exit();
}



if($id == ""){
	$id_orc = 0;
}else{
	$id_orc = $id;
}


$total_produtos = 0;
if($id == ""){
	$query = $pdo->query("SELECT * from produtos_orc where funcionario = '$id_usuario' and orcamento = '$id_orc'");
}else{
	$query = $pdo->query("SELECT * from produtos_orc where orcamento = '$id_orc'");
}

//Total de produtosS
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res);
	if($produtos > 0){
		for($i=0; $i<$produtos; $i++){
		$total = $res[$i]['total'];
		$total_produtos += $total;
	}
}
 
//Total de serviçps
$total_servicos = 0;
if($id == ""){
	$query = $pdo->query("SELECT * from servicos_orc where funcionario = '$id_usuario' and orcamento = '$id_orc'");
}else{
	$query = $pdo->query("SELECT * from servicos_orc where orcamento = '$id_orc'");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$servicos = @count($res);
	if($servicos > 0){
		for($i=0; $i<$servicos; $i++){
		$total = $res[$i]['total'];
		$total_servicos += $total;
	}
}



$total_final = $total_produtos + $total_servicos;



if($valor == ""){
	$valor = 0;
}


if($vall == ""){
	$vall = 0;
}

if($desconto == ""){
	$desconto = 0;
}

if($frete == ""){
	$frete = 0;
}

if($tipo_desconto == "%"){
	$total_com_desconto = $total_final + $vall - ($total_final * $desconto / 100) + $frete;
}else{
	$total_com_desconto = $total_final + $vall - $desconto + $frete;
}




if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), cliente = '$cliente', equipamento = '$equipamento', marca = '$marca', modelo = '$modelo', data_entrega = '$data_entrega', defeito = '$defeito', dias_validade = '$dias_validade', valor = '$total_final', vall = '$vall', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Pendente', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, senha = '$senha'");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET cliente = '$cliente', equipamento = '$equipamento', marca = '$marca', modelo = '$modelo', data_entrega = '$data_entrega', dias_validade = '$dias_validade', defeito = '$defeito', valor = '$total_final', vall = '$vall', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, senha = '$senha' where id = '$id'");

	
}

$query->bindValue(":obs", "$obs");
$query->bindValue(":frete", "$frete");
$query->bindValue(":acessorios", "$acessorios");
$query->bindValue(":condicoes", "$condicoes");
$query->bindValue(":laudo", "$laudo");
$query->execute();

if($id == ""){
$id_orcamento = $pdo->lastInsertId();
	$pdo->query("UPDATE produtos_orc SET orcamento = '$id_orcamento' WHERE orcamento = 0 and funcionario = '$id_usuario'");
	$pdo->query("UPDATE servicos_orc SET orcamento = '$id_orcamento' WHERE orcamento = 0 and funcionario = '$id_usuario'");
}else{
	$id_orcamento = $id;
}

echo 'Salvo com Sucesso-'.$id_orcamento; 

$mensagem = '';
//api whats
if($api_whatsapp == 'Sim'){
	$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$telefone = $res[0]['telefone'];
	$nome_cliente = $res[0]['nome'];

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
	if($id == ""){
		$mensagem .= '*Novo Orçamento* %0A';
	}else{
		$mensagem .= '*Orçamento Atualizado* %0A';
	}

		$mensagem .= 'Empresa: *'.$nome_sistema.'* %0A';
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão do Orçamento: *'.$data_entregaF.'* %0A';

		

	require('../../../apis/api_texto.php');
}	

?>
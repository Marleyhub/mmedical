<?php 
$tabela = 'os';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');

$data_entrega = $_POST['data_entrega'];
$cliente = @$_POST['cliente'];
//$dias_validade = $_POST['dias_validade'];
$desconto = $_POST['desconto'];
$tipo_desconto = $_POST['tipo_desconto'];
$obs = $_POST['obs'];
$frete = $_POST['frete'];
$frete = str_replace(',', '.', $frete);
$id = $_POST['id'];

$tecnico = @$_POST['tecnico'];
$equipamento = @$_POST['equipamento'];
$marca = @$_POST['marca'];
$modelo = @$_POST['modelo'];
$acessorios = $_POST['acessorios'];
$condicoes = $_POST['condicoes'];
$laudo = $_POST['laudo'];
$defeito = @$_POST['defeito'];
$dias_garantia = @$_POST['dias_garantia'];
$senha = @$_POST['senha'];

$mao_obra = $_POST['mao_obra'];
$mao_obra = str_replace(',', '.', $mao_obra);

$val_entrada = @$_POST['val_entrada'];
$val_entrada = str_replace(',', '.', $val_entrada);

$vall = @$_POST['vall'];
$vall = str_replace(',', '.', $vall);
$enviar_pdf = @$_POST['enviar_pdf'];


$data_entregaF = implode('/', array_reverse(explode('-', $data_entrega)));



if($id == ""){
	$id_orc = 0;
}else{
	$id_orc = $id;
}


$query = $pdo->query("SELECT * from os where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$status = @$res[0]['status'];

if($status == 'Aberta' and $tecnico > 0){
	$status = 'Iniciada';
}

$total_produtos = 0;
$query = $pdo->query("SELECT * from produtos_orc where funcionario = '$id_usuario' and os = '$id_orc'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res);
	if($produtos > 0){
		for($i=0; $i<$produtos; $i++){
		$total = $res[$i]['total'];
		$total_produtos += $total;
	}
}


$total_servicos = 0;
$query = $pdo->query("SELECT * from servicos_orc where funcionario = '$id_usuario' and os = '$id_orc'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$servicos = @count($res);
	if($servicos > 0){
		for($i=0; $i<$servicos; $i++){
		$total = $res[$i]['total'];
		$total_servicos += $total;
	}
}

if($mao_obra == ""){
	$mao_obra = 0;
}

if($val_entrada == ""){
	$val_entrada = 0;
}

if($vall == ""){
	$vall = 0;
}

$total_final = $total_produtos + $total_servicos + $mao_obra + $vall;


if($desconto == ""){
	$desconto = 0;

}

if($frete == ""){
	$frete = 0;
}



if($tipo_desconto == "%"){
	$total_com_desconto = $total_final - ($total_final * $desconto / 100) + $frete - $val_entrada;
}else{
	$total_com_desconto = $total_final - $desconto + $frete - $val_entrada;
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Aberta', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, mao_obra = '$mao_obra', tecnico = '$tecnico', equipamento = '$equipamento', marca = '$marca', modelo = '$modelo', acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, val_entrada = '$val_entrada',vall = '$vall',defeito = '$defeito', dias_garantia = '$dias_garantia',senha = '$senha'");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, mao_obra = '$mao_obra', tecnico = '$tecnico', equipamento = '$equipamento',  marca = '$marca', modelo = '$modelo', acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, status = '$status', val_entrada = '$val_entrada',vall = '$vall',defeito = '$defeito', dias_garantia = '$dias_garantia', senha = '$senha' where id = '$id'");
}

// converter paramentros para variável
$query->bindValue(":obs", "$obs");
$query->bindValue(":frete", "$frete");
$query->bindValue(":acessorios", "$acessorios");
$query->bindValue(":condicoes", "$condicoes");
$query->bindValue(":laudo", "$laudo");
$query->execute();

if($id == ""){
$id_orcamento = $pdo->lastInsertId();
	$pdo->query("UPDATE produtos_orc SET os = '$id_orcamento' WHERE os = 0 and funcionario = '$id_usuario'");
	$pdo->query("UPDATE servicos_orc SET os = '$id_orcamento', cliente = '$cliente', data = curDate(), equipamento = '$equipamento', modelo = '$modelo', subtotal = '$total_com_desconto' WHERE os = 0 and funcionario = '$id_usuario'");
}else{
	$id_orcamento = $id;
	$pdo->query("UPDATE servicos_orc SET cliente = '$cliente', equipamento = '$equipamento', modelo = '$modelo', subtotal = '$total_com_desconto' WHERE os = '$id'");
}



echo 'Salvo com Sucesso-'.$id_orcamento; 



//api whats
if($api_whatsapp == 'Sim'){
	$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$telefone = $res[0]['telefone'];
	$nome_cliente = $res[0]['nome'];

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);



	if($id == ""){
		$mensagem = '*Nova Ordem de Serviço* %0A';
	}else{
		$mensagem = '*Ordem de Serviço Atualizada* %0A';
	}
	
		$mensagem .= 'Empresa: *'.$nome_sistema.'* %0A';
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão de Entrega: *'.$data_entregaF.'* %0A%0A';		
	

	require('../../../apis/api_texto.php');
}	

//enviar ao técnico a notificação de nova OS
if($api_whatsapp == 'Sim' and $tecnico > 0){

		$query = $pdo->query("SELECT * from usuarios where id = '$tecnico' ");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$telefone_tec = $res[0]['telefone'];
		$nome_tecnico = $res[0]['nome'];

		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_tec);

		$mensagem = '*'.mb_strtoupper($nome_sistema).'* %0A';
		$mensagem .= '*Nova Ordem de Serviço Nº '.$id_orcamento.'* %0A%0A';
		$mensagem .= 'Técnico: *'.$nome_tecnico.'* %0A';
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão de Entrega: *'.$data_entregaF.'* %0A';
		$mensagem .= 'Equipamento: *'.$equipamento.'* %0A';
		$mensagem .= 'Modelo: *'.$modelo.'* %0A';
		$mensagem .= 'Defeito: *'.$defeito.'* %0A';

		require('../../../apis/api_texto.php');
}

?>
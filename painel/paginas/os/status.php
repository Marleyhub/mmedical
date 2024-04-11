<?php 
$tabela = 'os';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$data_hoje = date('Y-m-d');

$id = $_POST['id_da_os'];
$status = @$_POST['status'];

$pdo->query("UPDATE $tabela SET status = '$status', funcionario = '$id_usuario' WHERE id = '$id'");

echo 'Alterado com Sucesso';

$query = $pdo->query("SELECT * from os where id = '$id' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$cliente = $res[0]['cliente'];
	$frete = $res[0]['frete'];
	$subtotal = $res[0]['subtotal'];
	$subtotalF = number_format($subtotal, 2, ',', '.');
	$total_servicos = $res[0]['total_servicos'];
	$mao_obra = $res[0]['mao_obra'];
	$tecnico = $res[0]['tecnico'];
	$val_entrada = $res[0]['val_entrada'];


	if($val_entrada == ""){
		$val_entrada = "0";
	}

	if($total_servicos == ""){
		$total_servicos = "0";
	}

	if($mao_obra == ""){
		$mao_obra = "0";
	}
	$total_servicos_geral = $total_servicos + $mao_obra;
	$equipamento = $res[0]['equipamento'];

if($status == 'Finalizada'){
	//api whats
if($api_whatsapp == 'Sim'){
	
	$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$telefone = $res[0]['telefone'];
	$nome_cliente = $res[0]['nome'];

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
	
		$mensagem = '*Serviço Finalizado '.$nome_sistema.'* %0A';
		
		if($frete > 0){
			$mensagem .= 'Olá '.$nome_cliente.', seu Serviço foi Concluído, seguem abaixo os detalhes! %0A';
		}else{
			$mensagem .= 'Olá '.$nome_cliente.', seu Serviço foi Concluído, pode vir retirar seu aparelho traga a Notinha que recebeu quando deixou seu aparelho! %0A';
		}
		
		$mensagem .= 'Total: *R$ '.$subtotalF.'* %0A';
		

	require('../../../apis/api_texto.php');
}	
}

$data_hoje = date('Y-m-d');
$data_mes = date('Y/m/d', strtotime("+30 days",strtotime($data_hoje)));

if($status == 'Entregue'){
	$descrição = 'Serviço '.$equipamento;
	//inserção da venda

	if($val_entrada > 0){

		$pdo->query("INSERT INTO receber SET descricao = 'Novo Serviço', valor = '$subtotal', data_venc = '$data_mes', data_lanc = curDate(), data_pgto = '0000-00-00',  usuario_lanc = '$id_usuario', usuario_pgto = '', arquivo = 'sem-foto.png', pago = 'Não', cliente = '$cliente', referencia = 'Serviço', hora = curTime(),  id_ref = '$id'");
		$id_venda = $pdo->lastInsertId();

		$pdo->query("INSERT INTO receber SET descricao = 'Novo Serviço', valor = '$subtotal', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(),  usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Sim', cliente = '$cliente', referencia = 'Serviço', hora = curTime(),  id_ref = '$id'");
		$id_venda = $pdo->lastInsertId();


	}else{
		$pdo->query("INSERT INTO receber SET descricao = 'Novo Serviço', valor = '$subtotal', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(),  usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Sim', cliente = '$cliente', referencia = 'Serviço', hora = curTime(),  id_ref = '$id'");
		$id_venda = $pdo->lastInsertId();
}

		//abater os produtos no estoque
		$query2 = $pdo->query("SELECT * from produtos_orc where os = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$linhas2 = @count($res2);
		if($linhas2 > 0){
			for($i=0; $i<$linhas2; $i++){
			$id_pro_orc = $res2[$i]['id'];
			$id_produto = $res2[$i]['produto'];
			$quantidade = $res2[$i]['quantidade'];
			$valor_prod = $res2[$i]['valor'];
			$total_prod = $res2[$i]['total'];
		

			$query7 = $pdo->query("SELECT * from produtos where id = '$id_produto'");
			$res7 = $query7->fetchAll(PDO::FETCH_ASSOC);
			$estoque = $res7[0]['estoque'];

			$novo_estoque = $estoque - $quantidade;
			//remove o produto do estoque
			$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 
		}
	}


	//gerar a comissão do técnico
	if($comissao_geral > 0){
		if($total_servicos_geral > 0){
			$query = $pdo->query("SELECT * from usuarios where id = '$tecnico' ");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			$comissao_tec = $res[0]['comissao'];
			
			if($comissao_tec > 0){
				$comissao = $comissao_tec;
			}else{
				$comissao = $comissao_geral;
			}

			$total_comissao = ($total_servicos_geral * $comissao) / 100;
			$data_venc = date('Y/m/d', strtotime("+$dias_comissao days",strtotime($data_hoje)));

			$pdo->query("INSERT INTO pagar SET descricao = 'Comissão', funcionario = '$tecnico', valor = '$total_comissao', data_venc = '$data_venc', frequencia = '0', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref='$id'");
		}
	}



}


?>


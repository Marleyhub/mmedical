<?php 
require_once("../../../conexao.php");
$pagina = 'orcamentos';
$data_atual = date('Y-m-d');

@session_start();
$id_usuario = @$_SESSION['id_ref'];


$total_valor = 0;
$total_valorF = 0;


$query = $pdo->query("SELECT * from $pagina WHERE cliente = '$id_usuario' order by id desc ");

echo <<<HTML
<small>
HTML;
$total_pago = 0;
$total_pendentes = 0;
$total_pagoF = 0;
$total_pendentesF = 0;
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
			<tr> 				
				
				<th class="">Data</th> 
				<th class="esc">Entrega</th> 
				<th class="esc">Prod e Servic</th>
				<th class="esc">Valor</th> 
				<th class="esc">Desconto</th>
				<th class="esc">Frete</th>
				<th class="">Subtotal</th>
				<th class="esc">Efetuado Por</th>				
				<th class="esc" width="12%">Status</th>		
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$data = $res[$i]['data'];
$cliente = $res[$i]['cliente'];
$equipamento = $res[$i]['equipamento'];
$marca = $res[$i]['marca'];
$modelo = $res[$i]['modelo'];
$data_entrega = $res[$i]['data_entrega'];
$dias_validade = $res[$i]['dias_validade'];
$valor = $res[$i]['valor'];
$desconto = $res[$i]['desconto'];
$tipo_desconto = $res[$i]['tipo_desconto'];
$subtotal = $res[$i]['subtotal'];
$obs = $res[$i]['obs'];
$defeito = $res[$i]['defeito'];
$status = $res[$i]['status'];
$total_produtos = $res[$i]['total_produtos'];
$total_servicos = $res[$i]['total_servicos'];
$funcionario = $res[$i]['funcionario'];
$frete = $res[$i]['frete'];
$vall = $res[$i]['vall'];





$dataF = implode('/', array_reverse(explode('-', $data)));
$data_entregaF = implode('/', array_reverse(explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$total_produtosF = number_format($total_produtos, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');
$vallF = number_format($vall, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$endereco_cliente = $res2[0]['endereco'];
}


if($status == 'Aprovado'){
	$classe_pago = 'green';
	$ocultar = 'ocultar';
	$total_pago += $subtotal;
}else{
	$classe_pago = 'red';
	$ocultar = '';
	$total_pendentes += $subtotal;
}


$total_pagoF = number_format($total_pago, 2, ',', '.');
$total_pendentesF = number_format($total_pendentes, 2, ',', '.');

if($tel_cliente == "Sem Registro"){
	$ocultar_whats = 'ocultar';
}else{
	$ocultar_whats = '';
}

$tel_pessoaF = '55'.preg_replace('/[ ()-]+/' , '' , $tel_cliente);

if($tipo_desconto == "%"){
	$valor_porcent = '%';
	$valor_reais = '';
	$descontoF = $desconto;
}else{
	$valor_porcent = '';
	$valor_reais = 'R$';
	$descontoF = number_format($desconto, 2, ',', '.');
}

$ocultar_obs = '';
$classe_obs = 'text-warning';
if($obs == ""){
	$ocultar_obs = 'ocultar';
	$classe_obs = 'text-primary';
}


if($equipamento == ""){
	$equipamento = "Nenhum";
}

if($marca == ""){
	$marca = "Nenhum";
}

if($modelo == ""){
	$modelo = "Nenhum";
}
echo <<<HTML
			<tr> 
				
				<td class=""><i class="fa fa-square  mr-1" style="color:{$classe_pago}"></i> {$dataF}</td>	
				<td class="esc">{$data_entregaF}</td>
				<td class="esc">R$ {$valorF}</td>
				<td class="esc">R$ {$vallF}</td>
				<td class="esc">{$valor_reais} {$descontoF}{$valor_porcent}</td>
				<td class="esc">R$ {$freteF}</td>
				<td class=" text-danger">R$ {$subtotalF}</td>
				<td class="esc">{$nome_usu_lanc}</td>
				<td class="esc"><div style="color:#FFF; background:{$classe_pago}; padding:0px; width:100%; text-align: center; font-size: 12px; ">{$status}</div></td>
				
				<td>


				<!-- modal info -->
<big><a href="#" onclick="mostrar('{$data_entregaF}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}','{$obs}','{$frete}','{$equipamento}','{$marca}','{$modelo}','{$defeito}','{$vall}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>
						
				
					<big><a href="#" onclick="arquivo('{$id}', '{$nome_cliente}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>


					<form method="POST" action="../painel/rel/orcamento_class.php?id={$id}" target="_blank" style="display:inline-block">
						<input type="hidden" name="id" value="{$id}">
						<big><button title="PDF do Orçamento" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-file-pdf-o " style="color:blue"></i></button></big>
					</form>

					
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
		<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	<br>
	<div align="right"><span>Total Pendentes: <span class="text-danger">{$total_pendentesF}</span></span> <span style="margin-left: 25px">Total Aprovados: <span class="verde">{$total_pagoF}</span></span></div>
</small>
 

HTML;
}else{
	echo 'Não possui nenhum Orçamento!';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	   
	} );



	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}

function mostrar(data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, equipamento, marca, modelo, defeito, vall){
		    	
    	$('#data_entrega_dados').text(data_entrega);
    	$('#dias_validade_dados').text(dias_validade);
    	$('#valor_dados').text(valor);
    	$('#desconto_dados').text(desconto);
    	$('#tipo_desconto_dados').text(tipo_desconto);
    	$('#subtotal_dados').text(subtotal);
    	$('#obs_dados').text(obs);
    	$('#frete_dados').text(frete);
    	$('#equipamento_dados').text(equipamento);
    	$('#marca_dados').text(marca);
    	$('#modelo_dados').text(modelo);
    	$('#defeito_dados').text(defeito);
    	$('#vall_dados').text(vall);
    	

    	    	

    	$('#modalDados').modal('show');
    	//listarDebitos(id);
    	listarServicos(id);
	}


</script>




<?php 
require_once("../../../conexao.php");


// recuperar ID do Usuário
@session_start();
$id_usuario = @$_SESSION['id'];

$pagina = 'os';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;
 
$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];
$status = @$_POST['p3'];
$filtro = @$_POST['p4'];

if($dataFinal == ""){
	$dataFinal = $data_atual;
}

if($dataInicial == ""){
	$dataInicial = $data_atual;
}



$query = $pdo->query("SELECT * from $pagina WHERE status LIKE '%$status%' and tecnico = '$id_usuario' order by data_entrega asc ");

if($status == "Hoje"){
	$query = $pdo->query("SELECT * from $pagina WHERE data_entrega = curDate() and tecnico = '$id_usuario' order by id desc ");
}


echo <<<HTML
<small>
HTML;
$total_abertas = 0;
$total_iniciadas = 0;
$total_aguardando_peca = 0;
$total_aguardando_aprovacao = 0;
$total_sem_reparo = 0;
$total_nao_aprovada = 0;
$total_finalizadas = 0;
$total_entregues = 0;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
			<tr> 	
				<th>OS</th>			
				<th>Cliente</th>	
				<th class="esc">Data Geração</th>	
				<th class="esc">Data Entrega</th>
				<th class="esc">Equipamento</th> 
				<th class="esc" width="14%">Status</th>					
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
$data_entrega = $res[$i]['data_entrega'];
$dias_validade = $res[$i]['dias_validade'];
$valor = $res[$i]['valor'];
$desconto = $res[$i]['desconto'];
$tipo_desconto = $res[$i]['tipo_desconto'];
$subtotal = $res[$i]['subtotal'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$total_produtos = $res[$i]['total_produtos'];
$total_servicos = $res[$i]['total_servicos'];
$funcionario = $res[$i]['funcionario'];
$frete = $res[$i]['frete'];
$tecnico = $res[$i]['tecnico'];
$condicoes = $res[$i]['condicoes'];
$acessorios = $res[$i]['acessorios'];
$equipamento = $res[$i]['equipamento'];
$marca = $res[$i]['marca'];
$modelo = $res[$i]['modelo'];
$orcamento = $res[$i]['orcamento'];
$mao_obra = $res[$i]['mao_obra'];
$laudo = $res[$i]['laudo'];
$val_entrada = $res[$i]['val_entrada'];
$vall = $res[$i]['vall'];
$defeito = $res[$i]['defeito'];
$senha = $res[$i]['senha'];
$dias_garantia = $res[$i]['dias_garantia'];

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = @number_format($valor, 2, ',', '.');
$subtotalF = @number_format($subtotal, 2, ',', '.');
$freteF = @number_format($frete, 2, ',', '.');
$total_produtosF = @number_format($total_produtos, 2, ',', '.');
$total_servicosF = @number_format($total_servicos, 2, ',', '.');
$val_entradaF = @number_format($val_entrada, 2, ',', '.');
$vallF = @number_format($vall, 2, ',', '.');


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$tecnico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_tecnico = $res2[0]['nome'];
}else{
	$nome_tecnico = 'Não Lançando';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$endereco_cliente = $res2[0]['endereco'];
}


if($status == 'Aberta'){
	$classe_pago = 'red';	
	$total_abertas += 1;
}else if($status == 'Iniciada'){
	$classe_pago = 'blue';	
	$total_iniciadas += 1;
}else if($status == 'Aguardando Peça'){
	$classe_pago = '#ffbb54';	
	$total_aguardando_peca += 1;
}else if($status == 'Aguardando Aprovação'){
	$classe_pago = '#f58c00';	
	$total_aguardando_aprovacao += 1;
}else if($status == 'Sem Reparo'){
	$classe_pago = '#3d3d3d';	
	$total_sem_reparo += 1;
}else if($status == 'Não Aprovada'){
	$classe_pago = '#141414';	
	$total_nao_aprovada += 1;
}else if($status == 'Finalizada'){
	$classe_pago = 'green';	
	$total_finalizadas += 1;
}else if($status == 'Entregue'){
	$classe_pago = '#06858a';	
	$total_entregues += 1;
}


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


$ocultar_status = '';
if($status == "Entregue"){
	$ocultar_status = 'ocultar';	
}

echo <<<HTML
	<tr> 
	<td class="esc">{$id}</td>
	<td><i class="fa fa-square mr-1" style="color:{$classe_pago}"></i> {$nome_cliente}</td> 
	<td class="esc">{$dataF}</td>
	<td class="esc">{$data_entregaF}</td>
	<td class="esc">{$equipamento}</td>
	<td class="esc"><div style="color:#FFF; background:{$classe_pago}; padding:0px; width:160px; text-align: center; font-size: 12px; ">{$status}</div></td>
				<td>


				<big><a class="icones_mobile" href="#" onclick="mostrar('{$id}','{$nome_cliente}','{$data_entrega}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}','{$obs}','{$frete}','{$tecnico}','{$laudo}','{$condicoes}','{$acessorios}','{$equipamento}','{$marca}','{$modelo}','{$orcamento}','{$mao_obra}','{$val_entrada}','{$vall}','{$defeito}','{$senha}','{$dias_garantia}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>



					<big><a class="icones_mobile" class="{$ocultar_status}" href="#" onclick="editar('{$id}', '{$cliente}', '{$data_entrega}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}', '{$obs}','{$frete}','{$tecnico}','{$laudo}','{$condicoes}','{$acessorios}','{$defeito}','{$equipamento}','{$modelo}','{$marca}','{$orcamento}','{$mao_obra}','{$senha}','{$dias_garantia}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

				
	
					

						<big><a class="icones_mobile" class="{$ocultar_status}" href="#" onclick="status('{$id}', '{$status}')" title="Mudar Status"><i class="fa fa-pencil " style="color:blue"></i></a></big>



					<big><a class="icones_mobile" href="#" onclick="arquivo('{$id}', '{$nome_cliente}')" title="Inserir / Ver Arquivos"><i class="fa  fa-file-lines " style="color:#22146e"></i></a></big>


					

				<big><a class="icones_mobile" class="{$ocultar_whats}" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_pessoaF}" title="Whatsapp" target="_blank"><i class="bi bi-whatsapp " style="color:green"></i></a></big>
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
		<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	<br>
	<div align="right">

		<span>Abertas: <span style="color:red">{$total_abertas}</span></span> 
		<span style="margin-left: 25px">Iniciadas: <span style="color:blue">{$total_iniciadas}</span></span>
		<span style="margin-left: 25px">Aguardando Peça: <span style="color:#f07800">{$total_aguardando_peca}</span></span>
		<span style="margin-left: 25px">Aguardando Aprovação: <span style="color:#b09800">{$total_aguardando_aprovacao}</span></span>
		<span style="margin-left: 25px">Sem Reparo: <span style="color:#000000">{$total_sem_reparo}</span></span>
		<span style="margin-left: 25px">Não Aprovada: <span style="color:#525252">{$total_nao_aprovada}</span></span>
		<span style="margin-left: 25px">Finalizadas: <span style="color:green">{$total_finalizadas}</span></span>
		<span style="margin-left: 25px">Entregues: <span style="color:#06858a">{$total_entregues}</span></span>
		

	</div>
	
</small>
HTML;
}else{
	echo 'Não possui nenhum cadastro!';
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



	function editar(id, cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, tecnico, laudo, condicoes, acessorios, defeito, equipamento, modelo, marca, orcamento, mao_obra, senha, dias_garantia){	
	    
		
		if(tecnico > 0){
			orcamento = "";
		}

		if(cliente == 0){
			cliente = "";
		}		

		
		$('#id').val(id);
		$('#cliente').val(cliente).change();
		$('#data_entrega').val(data_entrega);
		//$('#dias_validade').val(dias_validade);
		$('#valor').val(valor);
		$('#desconto').val(desconto);
		$('#tipo_desconto').val(tipo_desconto).change();
		$('#subtotal').val(subtotal);
		$('#obs').val(obs);	
		$('#frete').val(frete);

		$('#tecnico').val(tecnico).change();
		$('#laudo').val(laudo);
		$('#condicoes').val(condicoes);
		$('#acessorios').val(acessorios);
		$('#defeito').val(defeito);
		$('#equipamento').val(equipamento).change();
		$('#modelo').val(modelo).change();
		$('#marca').val(marca).change();
		$('#orcamento').val(marca);
		$('#mao_obra').val(mao_obra);
		$('#senha').val(senha);
		$('#dias_garantia').val(dias_garantia);
		
					

		listarProdutos(orcamento);
		listarServicos(orcamento);
		
		
		$('#modalForm').modal('show');
		$('#mensagem').text('');
		
	}


	
		function mostrar(id, cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, tecnico, laudo, condicoes, acessorios, equipamento, marca, modelo, orcamento, mao_obra, val_entrada, vall, defeito, senha, dias_garantia){
		    	
		$('#id_dados').text(id);
		$('#nome_cliente_dados').text(cliente);
		$('#data_entrega_dados').text(data_entrega);
		$('#dias_validade_dados').text(dias_validade);
		$('#valor_dados').text(valor);
		$('#desconto_dados').text(desconto);
		$('#tipo_desconto_dados').text(tipo_desconto);
		$('#subtotal_dados').text(subtotal);
		$('#obs_dados').text(obs);	
		$('#frete_dados').text(frete);
		$('#tecnico_dados').text(tecnico);
		$('#laudo_dados').text(laudo);	
		$('#condicoes_dados').text(condicoes);
		$('#acessorios_dados').text(acessorios);
		$('#equipamento_dados').text(equipamento);
		$('#marca_dados').text(marca);	
		$('#modelo_dados').text(modelo);
		$('#orcamento_dados').text(orcamento);
		$('#mao_obra_dados').text(mao_obra);
		$('#val_entrada_dados').text(val_entrada);
		$('#vall_dados').text(vall);
		$('#defeito_dados').text(defeito);
		$('#senha_dados').text(senha);
    	$('#dias_garantia_dados').text(dias_garantia);

    	    	

    	$('#modalDados').modal('show');
    	//listarDebitos(id);
    	listarServicos(id);
	}



	
	function limparCampos(){
		$('#id').val('');
		$('#cliente').val('').change();	
		$('#produto').val('').change();	
		$('#servico').val('').change();		
		$('#valor').val('');
		$('#subtotal').val('');		
		$('#data_entrega').val('<?=$data_atual?>');			
		$('#desconto').val('');
		$('#frete').val('');
		$('#obs').val('');
		$('#dias_validade').val('');
		$('#tecnico').val('').change();	
		$('#equipamento').val('');
		$('#modelo').val('');
		$('#marca').val('');
		$('#defeito').val('');
		$('#mao_obra').val('');
		$('#acessorios').val('');
		$('#condicoes').val('');
		$('#laudo').val('');
		$('#senha').val('');
		$('#dias_garantia').val('');
		listarServicos()
		listarProdutos()
		
		
	}


	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


	function status(id, status){

    $('#id_da_os').val(id);   
    $('#id_status').val(status);   
    $('#modalStatus').modal('show');
    $('#mensagem-status').text(''); 
     
}


</script>




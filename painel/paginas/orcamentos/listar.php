<?php 
require_once("../../../conexao.php");
$pagina = 'orcamentos';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;

$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];
$status = '%'.@$_POST['p3'].'%';

if($dataFinal == ""){
	$dataFinal = $data_atual;
}

if($dataInicial == ""){
	$dataInicial = $data_atual;
}
 

//PEGAR O TOTAL ORÇAMENTOS PENDENTES
$query = $pdo->query("SELECT * from $pagina where status = 'Pendente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_orcamentos = @count($res);


$query = $pdo->query("SELECT * from $pagina WHERE data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status' order by id desc ");

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
				<th>OS</th>
				<th>Cliente</th>
				<th class="esc">Modelo</th>
				<th class="esc">Data</th> 
				<th class="esc">Entrega</th> 
				<th class="esc">Subtotal</th>
				<th class="esc">Efetuado Por</th>					
				<th>Ações</th>
			</tr> 
		</thead> 

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
$condicoes = $res[$i]['condicoes'];
$acessorios = $res[$i]['acessorios'];
$laudo = $res[$i]['laudo'];
$senha = $res[$i]['senha'];


$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

//formatar os valores
$valorF = @number_format($valor, 2, ',', '.');
$subtotalF = @number_format($subtotal, 2, ',', '.');
$freteF = @number_format($frete, 2, ',', '.');
$total_produtosF = @number_format($total_produtos, 2, ',', '.');
$total_servicosF = @number_format($total_servicos, 2, ',', '.');
$vallF = @number_format($vall, 2, ',', '.');

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

$query3 = $pdo->query("SELECT * FROM equipamentos where id = '$equipamento'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_equipamento = $res2[0]['nome'];	
	
}


if($status == 'Aprovado'){
	$classe_pago = 'verde';
	$ocultar = 'ocultar';
	$total_pago += $subtotal;
}else{
	$classe_pago = 'text-danger';
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


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_reg2 = @count($res2);
	if($total_reg2 > 0){
		$nome_cliente = $res2[0]['nome'];
	}	


echo <<<HTML

			<tr> 
				<td class="esc">{$id}</td>
				<td><i class="fa fa-square {$classe_pago} mr-1"></i> {$nome_cliente}</td> 
				<td class="esc">{$modelo}</td>
				<td class="esc">{$dataF}</td>	
				<td class="esc">{$data_entregaF}</td>
				<td class="esc text-danger">R$ {$subtotalF}</td>
				<td class="esc">{$nome_usu_lanc}</td>
				
			<td>


			<big><a class="icones_mobile" href="#" onclick="mostrar('{$nome_cliente}','{$data_entregaF}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}','{$obs}','{$frete}','{$equipamento}','{$marca}','{$modelo}','{$defeito}','{$vall}','{$condicoes}','{$acessorios}','{$laudo}','{$senha}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>

	



					<big><a class="icones_mobile" class="{$ocultar}" href="#" onclick="editar('{$id}','{$cliente}','{$data_entrega}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}','{$obs}','{$frete}','{$equipamento}','{$marca}','{$modelo}','{$defeito}','{$vall}','{$condicoes}','{$acessorios}','{$laudo}','{$senha}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

				
				
	<div class="dropdown" style="display: inline-block;">                      
            <a class="icones_mobile" class="icones_mobile" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                 </div>
              </div>
        </div>




        <div class="dropdown head-dpdn2" style="display: inline-block;"  id="baixar_orc">                      
            <a class="icones_mobile {$ocultar}" title="Aprovar Orçamento" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><big><i class="fa fa-check-square text-verde "></i></big></a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Aprovação? <a href="#" onclick="baixar('{$id}', '{$nome_cliente}')"><span class="text-verde">Sim</span></a></p>
                 </div>
              </div>
        </div>
				
					

					<big><a class="icones_mobile" href="#" onclick="arquivo('{$id}', '{$nome_cliente}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-lines " style="color:#22146e"></i></a></big>


					<form class="icones_mobile" method="POST" action="rel/orcamento_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button title="PDF do Orçamento" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-file-pdf-o " style="color:blue"></i></button></big>
					</form>


					<form class="icones_mobile" method="POST" action="rel/imp_orcamento.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button title="Impressão do Orçamento 80mm" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-print " style="color:#545352"></i></button></big>
					</form>

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
	<div align="right"><span>Total Pendentes: <span class="text-danger">{$total_pendentesF}</span></span> <span style="margin-left: 25px">Total Aprovados: <span class="verde">{$total_pagoF}</span></span></div>
</small>
HTML;
}else{
	echo 'Não possui nenhuma Orçamento!';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	    $('#total_itens').text('<?=$total_orcamentos?>');
	} );



	function editar(id, cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, equipamento, marca, modelo, defeito, vall, condicoes, acessorios, laudo, senha){

		if(cliente == 0){
			cliente = "";
		}

		
		$('#id').val(id);
		$('#cliente').val(cliente).change();
		$('#data_entrega').val(data_entrega);
		
		$('#dias_validade').val(dias_validade);
		$('#valor').val(valor);
		$('#desconto').val(desconto);
		$('#tipo_desconto').val(tipo_desconto).change();
		$('#subtotal').val(subtotal);
		$('#obs').val(obs);	
		$('#frete').val(frete);
		$('#equipamento').val(equipamento).change();
		$('#marca').val(marca).change();
		$('#modelo').val(modelo).change();
		$('#defeito').val(defeito);
		$('#vall').val(vall);
		$('#condicoes').val(condicoes);
		$('#acessorios').val(acessorios);
		$('#laudo').val(laudo);	
		$('#senha').val(senha);
						

		listarProdutos();
		listarServicos();
		totalizar();
		
		$('#modalForm').modal('show');
		$('#mensagem').text('');
		
	}


		function mostrar(cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, equipamento, marca, modelo, defeito, vall, condicoes, acessorios, laudo, senha){
		    	
    	$('#nome_cliente_dados').text(cliente);
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
    	$('#condicoes_dados').text(condicoes);
		$('#acessorios_dados').text(acessorios);
		$('#laudo_dados').text(laudo);
    	$('#senha_dados').text(senha);

    	    	

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
		$('#obs').val('');
		$('#frete').val('');
		$('#equipamento').val('').change();
		$('#marca').val('').change();
		$('#modelo').val('').change();	
		$('#defeito').val('');
		$('#vall').val('');
		$('#dias_validade').val('');
		$('#acessorios').val('');
		$('#condicoes').val('');
		$('#laudo').val('');
		$('#senha').val('');
		listarServicos()
		listarProdutos()
		totalizar()
		
	}


	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


	function baixar(id, nome){
    $.ajax({
					url: 'paginas/' + pag + "/baixar.php",
					method: 'POST',
					data: {id},
					dataType: "html",
					success:function(result){
					setTimeout(() => {
					listar();

						}, 700);
	
						
					}
				});
}






</script>




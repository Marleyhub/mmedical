<?php 
include('../../conexao.php');

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$status = $_GET['status'];

include('data_formatada.php');

$dataInicialF = implode('/', array_reverse(@explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(@explode('-', $dataFinal)));	
$datas = "";
if($dataInicial == $dataFinal){
	$datas = $dataInicialF;
}else{
	$datas = $dataInicialF.' à '.$dataFinalF;
}

$texto_filtro = 'Apurado em: '.$datas;
$texto_titulo = '';

if($status == 'Aberta'){
	$texto_titulo = ' ABERTAS';
}

if($status == 'Iniciada'){
	$texto_titulo = ' INICIADAS';
}


if($status == 'Aguardando Peça'){
	$texto_titulo = ' AGUARDANDO PEÇA';
}

if($status == 'Aguardando Aprovação'){
	$texto_titulo = ' AGUARDANDO APROVAÇÃO';
}

if($status == 'Sem Reapro'){
	$texto_titulo = ' SEM REPARO';
}

if($status == 'Não Aprovada'){
	$texto_titulo = ' NÃO APROVADAS';
}

if($status == 'Finalizada'){
	$texto_titulo = ' FINALIZADAS';
}


if($status == 'Entregue'){
	$texto_titulo = ' ENTREGUES';
}

?>
<!DOCTYPE html>
<html>
<head>

<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 25px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

.marca{
	position:fixed;
	left:50;
	top:100;
	width:80%;
	opacity:10%;
	transform: rotate(-30deg);
}

</style>

</head>
<body>
<?php 
if($marca_dagua == 'Sim'){ ?>
<img class="marca" src="<?php echo $url_sistema ?>img/logo.jpg">	
<?php } ?>


<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 55px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 7%; text-align: left;">
					<img style="margin-top: 0px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="180px"> 
				</td>
				<td style="text-align: center; font-size: 10px; width: 40%;">
				
                   <b><?php echo mb_strtoupper($nome_sistema) ?></b><br>
                   	<?php echo mb_strtoupper($cnpj_sistema) ?><br>
                   	INSTAGRAM: <b><?php echo mb_strtoupper($instagram_sistema) ?></b><br>
                   	<?php echo mb_strtoupper($endereco_sistema) ?>

				</td>
				<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE OS <?php echo $texto_titulo ?></big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:25%">CLIENTE</td>
					<td style="width:10%">DATA</td>
					<td style="width:10%">ENTREGA</td>
					<td style="width:10%">SUBTOTAL</td>
					<td style="width:17%">TÉCNICO</td>
					<td style="width:15%">STATUS</td>
					
				</tr>
			</thead>
		</table>
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:9px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
$total_abertas = 0;
$total_iniciadas = 0;
$total_aguardando_peca = 0;
$total_aguardando_aprovacao = 0;
$total_sem_reparo = 0;
$total_nao_aprovada = 0;
$total_finalizadas = 0;
$total_entregues = 0;
$query = $pdo->query("SELECT * from os WHERE data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '%$status%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
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



$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$total_produtosF = number_format($total_produtos, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');
$val_entradaF = number_format($val_entrada, 2, ',', '.');
$vallF = number_format($vall, 2, ',', '.');
$laudo = $res[$i]['laudo'];

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
	$classe_pago = '#f07800';	
	$total_aguardando_peca += 1;
}else if($status == 'Aguardando Aprovação'){
	$classe_pago = '#ffa733';	
	$total_aguardando_aprovacao += 1;
}else if($status == 'Sem Reparo'){
	$classe_pago = '#3d3d3d';	
	$total_sem_reparo += 1;
}else if($status == 'Não Aprovada'){
	$classe_pago = '#525252';	
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
	
  	 ?>

  	 
      <tr>
<td style="width:30%">	
	<?php echo $nome_cliente ?></td>
<td style="width:12%"><?php echo $dataF ?></td>
<td style="width:12%"><?php echo $data_entregaF ?></td>
<td style="width:11%">R$ <?php echo $subtotalF ?></td>
<td style="width:20%"><?php echo $nome_tecnico ?></td>
<td style="width:16%; font-size: 8px"><span style="color:#FFF; background:<?php echo $classe_pago ?>; padding:1px"><?php echo $status ?></span></td>



    </tr>

<?php } } ?>
				</tbody>
	
			</thead>
		</table>
	


</div>
<hr>
		<table>
			<thead>
				<tbody>
					<tr>
						<td style="font-size: 9px; width:60px; text-align: right;">ABERTAS <span style="color:red"><?php echo $total_abertas ?></span></td>

						<td style="font-size: 9px; width:60px; text-align: right;">INICIADAS <span style="color:blue"><?php echo $total_iniciadas ?></span></td>

						<td style="font-size: 9px; width:110px; text-align: right;">AGUARDANDO PEÇA <span style="color:#a34807"><?php echo $total_aguardando_peca ?></span></td>

						<td style="font-size: 9px; width:140px; text-align: right;">AGUARDANDO APROVAÇÃO <span style="color:#a34807"><?php echo $total_aguardando_aprovacao ?></span></td>

						<td style="font-size: 9px; width:80px; text-align: right;">SEM REPARO <span style="color:#a34807"><?php echo $total_sem_reparo ?></span></td>

						<td style="font-size: 9px; width:90px; text-align: right;">NÃO APROVADAS <span style="color:#a34807"><?php echo $total_nao_aprovada ?></span></td>


						<td style="font-size: 9px; width:70px; text-align: right;">FINALIZADAS <span style="color:green"><?php echo $total_finalizadas ?></span></td>

						<td style="font-size: 9px; width:70px; text-align: right;">ENTREGUES <span style="color:#06858a"><?php echo $total_entregues ?></span></td>
						

						
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>

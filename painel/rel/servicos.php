<?php 
include('../../conexao.php');
include('data_formatada.php');


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
				<td style="border: 1px; solid #000; width: 25%; text-align: left;">
					<img style="margin-top: 0px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="180px">
				</td>
				
				<td style="text-align: center; font-size: 10px; width: 40%;">
				
                   <b><?php echo mb_strtoupper($nome_sistema) ?></b><br>
                   	<?php echo mb_strtoupper($cnpj_sistema) ?><br>
                   	INSTAGRAM: <b><?php echo mb_strtoupper($instagram_sistema) ?></b><br>
                   	<?php echo mb_strtoupper($endereco_sistema) ?>
 
				</td>
				<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE SERVIÇOS</big></b><br>  <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:40%">SERVIÇO</td>
					<td style="width:15%">VALOR</td>
					<td style="width:15%">COMISSÃO</td>
					<td style="width:15%">DIAS</td>
					<td style="width:15%">ATIVO</td>
					
					
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



		<table style="width: 100%; table-layout: fixed; font-size:10px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
$produtos_ativos = 0;
$produtos_inativos = 0;
$query = $pdo->query("SELECT * from servicos order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$valor = $res[$i]['valor'];
	$comissao = $res[$i]['comissao'];
	$dias = $res[$i]['dias'];	
	$ativo = $res[$i]['ativo'];	

	if($ativo == 'Sim'){	
	$classe_ativo = '';
	$produtos_ativos += 1;
	}else{		
		$classe_ativo = '#b5671f';
		$produtos_inativos += 1;
	}

$valorF = number_format($valor, 2, ',', '.'); 


	
	
  	 ?>

  	 
      <tr style="color:<?php echo $classe_ativo ?>">
<td style="width:40%"><?php echo $nome ?></td>
<td style="width:15%">R$ <?php echo $valorF ?></td>
<td style="width:15%"><?php echo $comissao ?>%</td>
<td style="width:15%"><?php echo $dias ?></td>
<td style="width:15%;"><?php echo $ativo ?></td>


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

						<td style="font-size: 10px; width:180px; text-align: right;"></td>

							<td style="font-size: 10px; width:180px; text-align: right;"><b>Serviços Ativos: <span style="color:green"><?php echo $produtos_ativos ?></span></td>

						<td style="font-size: 10px; width:180px; text-align: right;"><b>Serviços Inativos:<span style="color:red"> <?php echo $produtos_inativos ?></span></td>

							<td style="font-size: 10px; width:180px; text-align: right;"><b>Total de Serviços: <?php echo $linhas ?></td>

						
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>



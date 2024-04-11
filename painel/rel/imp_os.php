<?php 
include('../../conexao.php');
 
$id = $_POST['id'];

$query = $pdo->query("SELECT * from os where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$data = $res[0]['data'];
$cliente = $res[0]['cliente'];
$data_entrega = $res[0]['data_entrega'];
$dias_validade = $res[0]['dias_validade'];
$valor = $res[0]['valor'];
$desconto = $res[0]['desconto'];
$tipo_desconto = $res[0]['tipo_desconto'];
$subtotal = $res[0]['subtotal'];
$obs = $res[0]['obs'];
$status = $res[0]['status'];
$total_produtos = $res[0]['total_produtos'];
$total_servicos = $res[0]['total_servicos'];
$funcionario = $res[0]['funcionario'];
$frete = $res[0]['frete'];
$tecnico = $res[0]['tecnico'];
$condicoes = $res[0]['condicoes'];
$acessorios = $res[0]['acessorios'];
$equipamento = $res[0]['equipamento'];
$marca = $res[0]['marca'];
$modelo = $res[0]['modelo'];
$orcamento = $res[0]['orcamento'];
$mao_obra = $res[0]['mao_obra'];
$laudo = $res[0]['laudo'];
$vall = $res[0]['vall'];
$defeito = $res[0]['defeito'];
$val_entrada = $res[0]['val_entrada'];
$dias_garantia = $res[0]['dias_garantia'];
$senha = $res[0]['senha'];



$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$total_produtosF = number_format($total_produtos, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');
$mao_obraF = number_format($mao_obra, 2, ',', '.');
$total_vallF = number_format($vall, 2, ',', '.');
$val_entradaF = number_format($val_entrada, 2, ',', '.');


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
	$nome_tecnico = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$endereco_cliente = $res2[0]['endereco'];
	$nome_sec2 = $res2[0]['nome2'];
}


if($tipo_desconto == "%"){
	$valor_porcent = '%';
	$valor_reais = '';
	$descontoF = $desconto;
}else{
	$valor_porcent = '';
	$valor_reais = 'R$';
	$descontoF = number_format($desconto, 2, ',', '.');
}
?>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php if(@$impressao_automatica == 'Sim'){ ?>
	<script type="text/javascript">
		$(document).ready(function() {  
			var duas_vias_os = "<?=$duas_vias_os?>"; 
			if(duas_vias_os.trim() === "Sim"){
				window.print();
			}	

			setTimeout(() => {
			window.print();
			window.close(); 

		}, 500);
			
		} );
	</script>
<?php } ?>


<style type="text/css">
	*{
		margin:0px;

		/*Espaçamento da margem da esquerda e da Direita*/
		padding:0px;
		background-color:#ffffff;

		font-color:#000;	
		font-family: TimesNewRoman, Geneva, sans-serif; 

	}
	.text {
		&-center { text-align: center; }
	}
	.ttu { text-transform: uppercase;
		font-weight: bold;
		font-size: 1.2em;
	}

	.printer-ticket {
		display: table !important;
		width: 100%;

		/*largura do Campos que vai os textos*/
		max-width: 400px;
		font-weight: light;
		line-height: 1.3em;

		/*Espaçamento da margem da esquerda e da Direita*/
		padding: 0px;
		font-family: TimesNewRoman, Geneva, sans-serif; 

		/*tamanho da Fonte do Texto*/
		font-size: <?php echo $fonte_comprovante ?>;
		font-color:#000;


	}
	
	th { 
		font-weight: inherit;

		/*Espaçamento entre as uma linha para outra*/
		padding:5px;
		text-align: center;

		/*largura dos tracinhos entre as linhas*/
		border-bottom: 1px dashed #000000;
	}


	

	
	

	.cor{
		color:#000000;
	}
	
	
	

	/*margem Superior entre as Linhas*/
	.margem-superior{
		padding-top:5px;
	}
	
	
}
</style>



<table class="printer-ticket">

	<tr>
		<th class="ttu" class="title" colspan="3"><?php echo $nome_sistema ?></th>

	</tr>
	<tr style="font-size: 10px">
		<th colspan="3">
		<b>	<?php echo $endereco_sistema ?></b> <br />
			<b>CONTATO: <?php echo $telefone_sistema ?>  <?php if($cnpj_sistema != ""){ ?> / CNPJ: <?php echo  $cnpj_sistema  ?><?php } ?></b><br>

		</th>
	</tr>

	<tr style="font-size: 10px">
	<th colspan="3"><b>CLIENTE:</b> <?php echo $nome_cliente ?> - Tel: <?php echo $tel_cliente ?>	<br/>
	<?php if($nome_sec2 > 0){ ?>
		<b>NOME SEC:</b> <?php echo $nome_sec2 ?> - Tel: <?php echo $tel_cliente2 ?>	
	<?php } ?>
	</th>



<tr >
	<th class="ttu margem-superior" colspan="3">
		ORDEM DE SERVIÇO Nº <?php echo $id ?> 

	</th>
</tr>




<?php if($equipamento != ""){ ?>

	
	<tr style="font-size: 11px">
		<td><b>EQUIPAMENTO:</b> <?php echo $equipamento ?></td>			
	</tr>
<?php } ?>


<?php if($modelo != ""){ ?>

	<tr style="font-size: 11px">
		<td><b>MODELO:</b> <?php echo $modelo ?></td>			
	</tr>
<?php } ?>


<?php if($marca != ""){ ?>


	<tr style="font-size: 11px">
		<td><b>MARCA:</b> <?php echo $marca ?></td>	

	</tr>


<?php } ?>

<tr>
	<th class="ttu"  colspan="3" class="cor">
		<!-- _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
	</th>
</tr>



<tbody>

	<?php 
	$total_servicos = 0;
	$total_servicosF = 0;
	$query = $pdo->query("SELECT * from servicos_orc where os = '$id'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$linhas = @count($res);
	if($linhas > 0){

		for($i=0; $i<$linhas; $i++){

			$servico = $res[$i]['servico'];
			$quantidade = $res[$i]['quantidade'];
			$valor = $res[$i]['valor'];
			$total = $res[$i]['total'];

			$valorF = number_format($valor, 2, ',', '.');
			$totalF = number_format($total, 2, ',', '.');

			$total_servicos += $total;
			$total_servicosF = number_format($total_servicos, 2, ',', '.');

			$query2 = $pdo->query("SELECT * from servicos where id = '$servico'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			$nome_servico = $res2[0]['nome'];

			?>




<tr style="font-size: 11px">
				
					<td colspan="2" width="70%"> <?php echo $quantidade ?> - <?php echo $nome_servico ?>
					</td>				

					<td align="right">R$ <?php echo $totalF ;?></td>

			</tr>

<?php } } ?>






<?php 
$total_produtos = 0;
$total_produtosF = 0;
$query = $pdo->query("SELECT * from produtos_orc where os = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){


	for($i=0; $i<$linhas; $i++){

		$produto = $res[$i]['produto'];
		$quantidade = $res[$i]['quantidade'];
		$valor = $res[$i]['valor'];
		$total = $res[$i]['total'];

		$valorF = number_format($valor, 2, ',', '.');
		$totalF = number_format($total, 2, ',', '.');

		$total_produtos += $total;
		$total_produtosF = number_format($total_produtos, 2, ',', '.');

		$query2 = $pdo->query("SELECT * from produtos where id = '$produto'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome_produto = $res2[0]['nome'];
		?>


		<tr style="font-size: 11px">
				
			<td colspan="2" width="70%"> <?php echo $quantidade ?> - <?php echo $nome_produto ?></td>				

			<td align="right">R$ <?php echo $totalF ;?></td>
		</tr>


		<tr>
			<th class="ttu"  colspan="3" class="cor">
				<!-- _ _	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
			</th>
		</tr>


	<?php } } ?>



<tr></tr>

</tbody>
<tfoot>

	<tfoot>


		
		<?php if($total_servicos > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Total Serviços</td>
				<td align="right">R$ <?php echo $total_servicosF ?></td>
			</tr>
		<?php } ?>

		<?php if($total_produtos > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Total Produtos</td>
				<td align="right">R$ <?php echo $total_produtosF ?></td>
			</tr>
		<?php } ?>

		


		<?php if($mao_obra > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Total Mão Obra</td>
				<td align="right">R$ <?php echo $mao_obraF ?></td>
			</tr>
		<?php } ?>


		<?php if($desconto > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Total Desconto</td>
				<td align="right"><?php echo $valor_reais ?> -<?php echo $descontoF ?><?php echo $valor_porcent ?></td>
			</tr>
		<?php } ?>

		<?php if($frete > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Total Frete</td>
				<td align="right">R$ <?php echo $freteF ?></td>
			</tr>
		<?php } ?>

		<?php if($val_entrada > 0){ ?>
			<tr style="font-size: 11px">
				<td colspan="2">Entrada</td>
				<td align="right"><?php echo $val_entradaF ?></td>
			</tr>
		<?php } ?>


		
	</tr>

	<tr style="font-size: 12px">
		<td colspan="2"><b>SubTotal</b></td>
		<td align="right"><b>R$ <?php echo $subtotalF ?></b></td>
	</tr>




	<?php if($defeito != ""){ ?>

		<tr>
			<th colspan="3">
			</th>
		</tr>

		<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><b>DEFEITO:</b> <?php echo $defeito ?></td>			
		</tr>
	<?php } ?>


	<?php if($acessorios != ""){ ?>

		<tr >
			<th colspan="3">
			</th>
		</tr>

		<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><b>ACESSÓRIOS:</b> <?php echo $acessorios ?></td>			
		</tr>
	<?php } ?>

	<?php if($condicoes != ""){ ?>

		<tr >
			<th colspan="3">
			</th>
		</tr>

		<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><b>CONDIÇÕES:</b> <?php echo $condicoes ?></td>			
		</tr>
	<?php } ?>

	<?php if($laudo != ""){ ?>

		<tr >
			<th colspan="3">
			</th>
		</tr>

		<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><b>LAUDO TÉCNICO:</b> <?php echo $laudo ?></td>			
		</tr>
	<?php } ?>



	<?php if($obs != ""){ ?>

		<tr >
			<th colspan="3">
			</th>
		</tr>

		<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><b>OBS:</b> <?php echo $obs ?></td>
			
		</tr>
	<?php } ?>





	<tr >
		<th colspan="3">
		</th>
	</tr>
	
	<tr >
		<th style="font-size: 12px" colspan="3">DATA <?php echo $dataF ?> / Previsão de Entrega <b><?php echo $data_entregaF ?></b>
		</th>
	</tr>



<!-- Campo senha -->
	<tr style="margin-top:2px; font-size: 12px; text-align:center">
			<td colspan="3"><small><b>SENHA:</b>


			<?php if($senha != ""){ ?>
				<?php echo $senha ?> </small></td>
		<?php 	}else{ ?>
			______________
		<?php } ?>
			 
			
		</tr>

	<tr >																
		<th colspan="3">
			<pre><b>.         .         .</b></pre><br>
			<pre><b>.         .         .</b></pre><br>
			<pre><b>.         .         .</b></pre>
															
		</th>
	</tr>





</tfoot>


</table>





<?php 
$dias_garantia == 0;
	if($dias_garantia > 0){ ?>

		<div style="margin-top: 5px; font-size:9px">
			<center><label><b>GARANTIA</b></label> </center> 
			<div style="text-align: left;" >
				<span style="margin-top: 3px"><?php echo $garantia ?></span>
			</div>

		</div>
	<?php } ?>



	<?php 
$dias_garantia == 0;
	if($dias_garantia > 0){ ?>

		<div style="margin-top: 5px; font-size:9px">
			<center> <label style="margin-top: 5px"><b>TERMOS</b></label> </center> 
			<div style="" >
				<span style="margin-top: 3px"><?php echo $termos ?></span>
			</div>
		</div>
	<?php } ?>




<div align="right" style="margin-top: 20px; font-size:9px; text-align: center;" >
	<span><?php echo $msg_rodape ?></span>
</div>


<br><br>
<div align="center">__________________________</div>
<div align="center"><small>ASSINATURA DO CLIENTE</small></div>
	
<?php 
$tabela = 'produtos_orc';
require_once("../../../conexao.php");

$data_atual = date('Y-m-d');

@session_start();
$id_usuario = @$_SESSION['id'];

$id = @$_POST['id'];
$orc = @$_POST['orc'];
$id_orcam = @$_POST['id'];

if($orc != ""){
	$pdo->query("UPDATE $tabela SET os = '$id' where orcamento = '$orc'");	
}


$total_produtos = 0;
$total_produtosF = 0;

if($id == ""){
	$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and os = '0'");
}else{
	$query = $pdo->query("SELECT * from $tabela where os = '$id'");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered" id="tabela2">
	<thead> 
	<tr style="background: #e0e0e0"> 
	<th width="40%">Produto</th>
	<th width="15%">Quantidade</th>	
	<th width="15%">Valor</th>
	<th width="15%">Total</th>
	<th width="15%">Remover</th>				
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
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
	@$nome_produto = $res2[0]['nome'];

echo <<<HTML
<tr>
<td >{$nome_produto}</td>
<td ><input type="number" id="quant_produtos_{$id}" value="{$quantidade}" style="border:none; width:45px" onchange="quantidadeProdutos({$id})"></td>
<td >R$ <input style="outline: none!important; border:none; width:60px; border-bottom: 1px solid #616060" type="text" name="valor_produto" id="vlr_prod_{$id}" value="{$valor}" onblur="atualizarValor('{$id}', '{$id_orcam}')"></td>
<td >R$ {$totalF}</td>
<td><a href="#" onclick="excluirProduto({$id})" title="Excluir Item"><i class="fa fa-trash-o text-danger"></i></a></td>
</tr>
HTML;

}



echo <<<HTML
</tbody>
</table>
</small>
HTML;

}
?>

<script type="text/javascript">
	$("#tot_produtos").text("<?=$total_produtosF?>");
</script>

<script type="text/javascript">
	function atualizarValor(id, id_orc){
		var valor = $("#vlr_prod_"+id).val();
		
		$.ajax({
	        url: 'paginas/' + pag + "/valor_produto.php",
	        method: 'POST',
	        data: {id, valor},
	        dataType: "html",

	        success:function(result){
	            listarProdutos(id_orc);
	        }
	    });
	}
</script>
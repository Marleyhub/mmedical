<?php 
$tabela = 'itens_venda';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];
$desconto = @$_POST['desconto'];
$troco = @$_POST['troco'];

if($desconto == ""){
	$desconto = 0;
}

$total_troco = 0;
$total_trocoF = 0;

$total_final = -$desconto;
$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and id_venda = '0' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
echo '<div style="overflow:auto; height:270px; width:100%; scrollbar-width: thin;">';
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$produto = $res[$i]['produto'];
	$valor = $res[$i]['valor'];
	$quantidade = $res[$i]['quantidade'];
	$total = $res[$i]['total'];

	$total_final += $total;
	$total_finalF = number_format($total_final, 2, ',', '.');
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');
	
	if($troco > 0){
		$total_troco = $troco - $total_final;
		$total_trocoF = number_format($total_troco, 2, ',', '.');
	}
	

	$query2 = $pdo->query("SELECT * from produtos where id = '$produto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_produto = $res2[0]['nome'];
	$foto_produto = $res2[0]['foto'];

	$nome_produtoF = mb_strimwidth($nome_produto, 0, 20, "..."); 

	echo '<div class="row">';
	echo '<div class="col-md-3">';
	echo '<img src="images/produtos/'.$foto_produto.'" width="40px">';
	echo '</div>';
	echo '<div class="col-md-9" style="margin-left:-15px">';
	echo '<span style="font-size:12px; margin-left: -15px">';
	echo $quantidade.' '.$nome_produtoF.' <span style="font-size:10px; color:#02571b;">('.$valorF.')</span>';
	echo '</span><br>';
	echo '<div style="font-size:11px; color:#570a03; margin-top:0px">Total Item: R$ '.$totalF.' ';





	echo '<div class="dropdown head-dpdn2" style="display: inline-block; margin-left:10px">
		<a title="Remover Item" href="#" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-times" style="color:#7d1107"></i></big></a>
		
	<div class="dropdown-menu" style="margin-left:-100px;margin-top:-35px;">
		<div>
		<div class="notification_desc2">
		<p>Remover Item? <a href="#" onclick="excluirItem('.$id.')"><span class="text-danger">Sim</span></a></p>
		</div>
		</div>										
		</div>
	</div>';









	echo '</div>';
	echo '</div>';
	echo '</div>';
	
	}
}
echo '</div>';

$total_finalF = number_format($total_final, 2, ',', '.');
echo '<div align="right" style="margin-top:20px; font-size:14px; border-top:1px solid #8f8f8f;" >';
echo '<br>';
echo '<span style="margin-right:40px">Itens: <b>('.$linhas.')</b></span>';
echo '<span>Subtotal: </span>';
echo '<span style="font-weight:bold"> R$ ';
echo $total_finalF;
echo '</span>';
if($troco > 0){
echo '<br><span>Troco: </span>';
echo '<span style="font-weight:bold"> R$ ';
echo $total_trocoF;
echo '</span>';
}
echo '</div>';


?>

<script type="text/javascript">
	var itens = "<?=$linhas?>";
	if(itens > 0){
		$("#btn_limpar").show();
		$("#btn_venda").show();
	}else{
		$("#btn_limpar").hide();
		$("#btn_venda").hide();
	}
	function excluirItem(id){
		 $.ajax({
        url: 'paginas/' + pag + "/excluir-item.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Excluído com Sucesso") {           	
                listarVendas();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
	}
</script>
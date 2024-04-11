<?php 
$tabela = 'entradas';
require_once("../../../conexao.php");

$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];

if($dataInicial != "" and $dataFinal != ""){
	$query = $pdo->query("SELECT * from $tabela where data >= '$dataInicial' and data <= '$dataFinal' order by id asc");
}else{
	$query = $pdo->query("SELECT * from $tabela order by id desc limit 50");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th>Produto</th>	
	<th>Quantidade</th>		
	<th class="esc">Motivo</th>
	<th class="esc">Usuário</th>
	<th class="esc">Data</th>	
	<th>Excluir</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$produto = $res[$i]['produto'];	
	$quantidade = $res[$i]['quantidade'];	
	$motivo = $res[$i]['motivo'];
	$usuario = $res[$i]['usuario'];
	$data = $res[$i]['data'];
	
	
	$dataF = implode('/', array_reverse(@explode('-', $data)));

	$query2 = $pdo->query("SELECT * from produtos where id = '$produto'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_produto = @$res2[0]['nome'];
	$estoque = @$res2[0]['estoque'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$usuario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_usuario = @$res2[0]['nome'];
	

echo <<<HTML
<tr>
<td>{$nome_produto}</td>
<td>{$quantidade}</td>
<td class="esc">{$motivo}</td>
<td class="esc">{$nome_usuario}</td>
<td class="esc">{$dataF}</td>
<td>	

<div class="dropdown" style="display: inline-block;">                      
            <a class="icones_mobile" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                 </div>
              </div>
        </div>



</td>
</tr>
HTML;

}

}else{
	echo 'Não possui nenhuma conta para esta data!';
}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
?>



<script type="text/javascript">
	$(document).ready( function () {		
    $('#tabela').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );
</script>


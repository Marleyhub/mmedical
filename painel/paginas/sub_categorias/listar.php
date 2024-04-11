<?php 
$tabela = 'sub_categorias';

require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by nome asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr>
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th width="70%">Nome</th>	
	<th>Produtos</th>			
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];		
	$ativo = $res[$i]['ativo'];
	
	
	if($ativo == 'Sim'){
	$icone = 'bi bi-check-square-fill';
	$titulo_link = 'Desativar Usuário';
	$acao = 'Não';
	$classe_ativo = '';
	}else{
		$icone = 'bi bi-square';
		$titulo_link = 'Ativar Usuário';
		$acao = 'Sim';
		$classe_ativo = '#c4c4c4';
	}

	$query2 = $pdo->query("SELECT * from produtos where sub_categoria = '$id'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$produtos = @count($res2);


echo <<<HTML
<tr style="color:{$classe_ativo}">
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
<td> {$nome}</td>
<td>{$produtos}</td>

<td>
	<big><a class="icones_mobile" href="#" onclick="editar('{$id}','{$nome}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

<div class="dropdown" style="display: inline-block;">                      
            <a class="icones_mobile" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                 </div>
              </div>
        </div>

<big><a class="icones_mobile" href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>

</td>

</tr>
HTML;

}

}else{
	echo 'Não possui nenhum Sub-Categoria!';
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

<script type="text/javascript">
	function editar(id, nome){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	
    	$('#modalForm').modal('show');
	}


	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');   	

    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}

	function selecionar(id){

		var ids = $('#ids').val();

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if(ids_final == ""){
			$('#btn-deletar').hide();
		}else{
			$('#btn-deletar').show();
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluirMultiplos(id[i]);			
		}


		setTimeout(() => {
			listar();

		}, 1000);

		limparCampos();
	}
</script>
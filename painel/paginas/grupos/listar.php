<?php 
require_once("../../../conexao.php");
$tabela = 'grupo_acessos';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){

echo <<<HTML
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr> 
	<th width="80%">Nome</th>	
	<th>Acessos</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];


	$query2 = $pdo->query("SELECT * FROM acessos where grupo = '$id'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_servicos = @count($res2);
		
	
echo <<<HTML
<tr>
<td> {$nome}</td>
<td>{$total_servicos}</td>
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


		</td>
</tr>
HTML;

}

echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
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
			"stateSave": true
    	});
    $('#tabela_filter label input').focus();
} );
</script>


<script type="text/javascript">
	function editar(id, nome){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
	}

	function limparCampos(){
		$('#nome').val('');
		$('#id').val('');
	}
</script>
<?php 
$tabela = 'produtos';
require_once("../../../conexao.php");

$categoria = @$_POST['p1'];

if($categoria != ""){
	$query = $pdo->query("SELECT * from $tabela where categoria = '$categoria' order by id desc");
}else{
	$query = $pdo->query("SELECT * from $tabela order by id desc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela2">
	<thead> 
	<tr>
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th>Código</th>
	<th>Nome</th>	
	<th class="esc">Categoria</th>
	<th class="esc">Sub Categoria</th>
	<th class="esc">Valor Venda</th>
	<th class="esc">Estoque</th>			
	<th class="esc">Foto</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$codigo = $res[$i]['codigo'];
	$nome = $res[$i]['nome'];
	$categoria = $res[$i]['categoria'];
	$sub_categoria = $res[$i]['sub_categoria'];
	$valor_venda = $res[$i]['valor_venda'];
	$valor_compra = $res[$i]['valor_compra'];
	$estoque = $res[$i]['estoque'];
	$nivel_estoque = $res[$i]['nivel_estoque'];	
	$foto = $res[$i]['foto'];	
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

	$valor_vendaF = number_format($valor_venda, 2, ',', '.'); 
	$valor_compraF = number_format($valor_compra, 2, ',', '.');

	$query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_reg2 = @count($res2);
	if($total_reg2 > 0){
		$nome_categoria = $res2[0]['nome'];
	}else{
		$nome_categoria = "Nenhuma";
	}	


	$query2 = $pdo->query("SELECT * FROM sub_categorias where id = '$sub_categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_reg2 = @count($res2);
	if($total_reg2 > 0){
		$nome_sub_categoria = $res2[0]['nome'];
	}else{
		$nome_sub_categoria = "Nenhuma";
	}


	$classe_estoque = '';
	if($estoque <= $nivel_estoque){
		$classe_estoque = 'text-danger';
	}


echo <<<HTML
<tr style="color:{$classe_ativo}">
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
<td> {$codigo}</td>
<td>{$nome}</td>
<td class="esc">{$nome_categoria}</td>
<td class="esc">{$nome_sub_categoria}</td>
<td class="esc text-verde">R$ {$valor_vendaF}</td>
<td class="esc {$classe_estoque}">{$estoque}</td>
<td class="esc"><img src="images/produtos/{$foto}" width="25px"></td>
<td>

<big><a class="icones_mobile" href="#" onclick="editar('{$id}','{$codigo}','{$nome}','{$categoria}','{$sub_categoria}','{$valor_compra}','{$valor_venda}','{$estoque}','{$nivel_estoque}','{$foto}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>


<div class="dropdown" style="display: inline-block;">                      
            <a class="icones_mobile" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                 </div>
              </div>
        </div>


	<big><a class="icones_mobile" href="#" onclick="mostrar('{$codigo}','{$nome}','{$nome_categoria}','{$nome_sub_categoria}','{$valor_compraF}','{$valor_vendaF}','{$estoque}','{$ativo}', '{$foto}' )" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a class="icones_mobile" href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>




<big><a class="icones_mobile" href="#" onclick="saida('{$id}','{$nome}', '{$estoque}')" title="Saída de Produto"><i class="fa fa-sign-out text-danger"></i></a></big>

	<big><a class="icones_mobile" href="#" onclick="entrada('{$id}','{$nome}', '{$estoque}')" title="Entrada de Produto"><i class="fa fa-sign-in verde"></i></a></big>

	<big><a class="icones_mobile" href="#" onclick="gerarEtiquetas('{$id}', '{$codigo}', '{$valor_vendaF}', '{$nome}')" title="Gerar Etiquetas"><i class="fa fa-barcode" style="color:#000"></i></a></big>

</td>
</tr>
HTML;

}

}else{
	echo 'Não possui nenhum produto Cadastrado!';
}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
?>



<script type="text/javascript">
	$(document).ready( function () {		
    $('#tabela2').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );

</script>

<script type="text/javascript">
	function editar(id, codigo, nome, categoria, sub_categoria, compra, venda, estoque, nivel, foto){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
		$('#codigo').val(codigo);
    	$('#categoria').val(categoria).change();
		$('#sub_categoria').val(sub_categoria).change();
    	$('#valor_compra').val(compra);
    	$('#valor_venda').val(venda);
    	$('#estoque').val(estoque);
    	$('#nivel_estoque').val(nivel);
    	$('#foto').val(''); 
    	$('#foto_dados').attr("src", "images/perfil/" + foto);
    	
    	$('#target').attr('src', 'images/produtos/'+foto);
    	
    	$('#modalForm').modal('show');

    	gerarCodigo()
	}

	function mostrar(codigo, nome, categoria, sub_categoria, compra, venda, estoque, ativo, foto){
		

		$('#titulo_dados').text(nome);
		$('#codigo_dados').text(codigo);    	
  		$('#categoria_dados').text(categoria);
  		$('#sub_categoria_dados').text(sub_categoria);
    	$('#compra_dados').text(compra);
    	$('#venda_dados').text(venda);
    	$('#estoque_dados').text(estoque);
		$('#ativo_dados').text(ativo);

		$('#foto_dados').attr("src", "images/produtos/" + foto);
    	    	

    	$('#modalDados').modal('show');
    	
	}


	function limparCampos(){
		$('#id').val('');
		$('#codigo').val(''); 
    	$('#nome').val(''); 
    	$('#estoque').val('');
    	$('#nivel_estoque').val('');
    	$('#valor_venda').val('');
    	$('#valor_compra').val('');
    	
    	$('#target').attr('src', 'images/produtos/sem-foto.jpg'); 
    	$('#foto').val('');   	

    	$('#ids').val('');
    	$('#btn-deletar').hide();
    	$('#categoria').val('').change();
    	$('#sub_categoria').val('').change();
	}


	function gerarEtiquetas(id, codigo, valor, nome){
		$('#id-etiqueta').val(id);
		$('#codigo-etiqueta').val(codigo);
		$('#valor-etiqueta').val(valor);
		$('#nome-etiqueta').val(nome);

		$('#titulo-etiquetas').text(nome);

		$('#modalEtiquetas').modal('show');
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



<script type="text/javascript">
	function saida(id, nome, estoque){

		$('#nome_saida').text(nome);
		$('#estoque_saida').val(estoque);
		$('#id_saida').val(id);		

		$('#quantidade_saida').val('');
		$('#motivo_saida').val('');

		$('#modalSaida').modal('show');
	}
</script>


<script type="text/javascript">
	function entrada(id, nome, estoque){

		$('#nome_entrada').text(nome);
		$('#estoque_entrada').val(estoque);
		$('#id_entrada').val(id);

		$('#quantidade_entrada').val('');
		$('#motivo_entrada').val('');		

		$('#modalEntrada').modal('show');
	}
</script>
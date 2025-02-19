<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered text-nowrap border-bottom dt-responsive" id="tabela">
	<thead> 
	<tr>
	<th align="center" width="5%" class="text-center">Selecionar</th>
	<th>Nome</th>
	<th class="esc">Email</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Telefone Sec</th>
	<th class="esc">Pessoa</th>	
	<th class="esc">Cadastrado Em</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$telefone2 = $res[$i]['telefone2'];	
	$endereco = $res[$i]['endereco'];
	$cpf = $res[$i]['cpf'];
	$pessoa = $res[$i]['pessoa'];
	$data = $res[$i]['data'];
	$email = $res[$i]['email'];
	$nome2 = $res[$i]['nome2'];
	$apelido = $res[$i]['apelido'];

	$dataF = implode('/', array_reverse(@explode('-', $data)));

	$tel_whatsF = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

//verificar débitos cliente
$query2 = $pdo->query("SELECT * from receber where cliente = '$id' and data_venc < curDate() and pago != 'Sim'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$linhas2 = @count($res2);
if($linhas2 > 0){
	$debito = 'text-danger';
}else{
	$debito = '';
}

echo <<<HTML
<tr>
<td align="center">
<div class="custom-checkbox custom-control">
<input type="checkbox" class="custom-control-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
<label for="seletor-{$id}" class="custom-control-label mt-1 text-dark"></label>
</div>
</td>
<td class="{$debito}"> {$nome}</td>
<td>{$email}</td>
<td>{$telefone}</td>
<td>{$telefone2}</td>
<td><span class="badge bg-primary me-1 my-2 p-1"><big>{$pessoa}</big></span></td>
<td>{$dataF}</td>
<td>
	<big><a class="icones_mobile" href="#" onclick="editar('{$id}','{$nome}','{$telefone}','{$telefone2}','{$pessoa}','{$cpf}','{$endereco}','{$email}','{$apelido}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<div class="dropdown" style="display: inline-block;">                      
            <a class="icones_mobile" href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="dropdown"><i class="fe fe-trash-2 text-danger"></i> </a>
             <div  class="dropdown-menu tx-13">
                 <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                     <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
                 </div>
              </div>
        </div>

<big><a class="icones_mobile" href="#" onclick="mostrar('{$nome}','{$telefone}','{$telefone2}','{$endereco}', '{$pessoa}',' {$dataF}', '{$cpf}', '{$id}', '{$email}', '{$nome2}', '{$apelido}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>

<big><a class="icones_mobile" href="#" onclick="mostrarContas('{$nome}','{$id}')" title="Mostrar Contas"><i class="bi bi-cash-coin" style="color:green"></i></a></big>

<big><a class="icones_mobile" href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>


<big><a class="icones_mobile" class="" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_whatsF}" title="Whatsapp" target="_blank"><i class="bi bi-whatsapp" style="color:green"></i></i></a></big>





</td>
</tr>
HTML;

}

}else{
	echo 'Não possui nenhum cadastro!';
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
	function editar(id, nome, telefone, telefone2, pessoa, cpf, endereco, email, nome2, apelido){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#telefone').val(telefone);
    	$('#telefone2').val(telefone2);
    	$('#endereco').val(endereco);
    	$('#pessoa').val(pessoa).change();
    	$('#cpf').val(cpf);
    	$('#email').val(email);
    	$('#nome2').val(nome2);
    	$('#apelido').val(apelido);

    	$('#modalForm').modal('show');
	}


	function mostrar(nome, telefone, telefone2, endereco, pessoa, data, cpf, id, email, nome2, apelido){
		    	
    	$('#titulo_dados').text(nome);
    	$('#telefone_dados').text(telefone);
    	$('#telefone2_dados').text(telefone2);
    	$('#endereco_dados').text(endereco);
    	$('#pessoa_dados').text(pessoa);
    	$('#data_dados').text(data);
    	$('#cpf_dados').text(cpf);
    	$('#email').text(email);
    	$('#nome2_dados').text(nome2);
    	$('#apelido_dados').text(apelido);
    	    	

    	$('#modalDados').modal('show');
    	//listarDebitos(id);
    	listarServicos(id);
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#cpf').val('');
    	$('#telefone').val('');
    	$('#telefone2').val('');
    	$('#endereco').val('');
    	$('#email').val('');
    	$('#nome2').val('');
    	$('#apelido').val('');

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


	function listarDebitos(id){


		 $.ajax({
        url: 'paginas/' + pag + "/listar_debitos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_debitos").html(result);           
        }
    });
	}


	function mostrarContas(nome, id){
		    	
    	$('#titulo_contas').text(nome); 
    	$('#id_contas').val(id); 	
    	    	
    	$('#modalContas').modal('show');
    	listarDebitos(id);
    	
	}


		function listarServicos(id){
		 $.ajax({
        url: 'paginas/' + pag + "/listar_servicos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_servicos").html(result);           
        }
    });
	}



	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}



</script>

<?php 
$pag = 'os_tecnico';

//verificar se ele tem a permissão de estar nessa página
if(@$os_tecnico == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
?>
<div class="justify-content-between" style="margin-top: 50px">
	<div class="left-content mt-2 mb-3">
	<form action="rel/lista_os_class.php" target="_blank" method="POST">
 	<div class="left-content mt-2">
		 
	
<div class="row">

	<div class="col-md-12" align="center">
	<style>
		.btn-b{
			background-color: #008c15;
			color:white;
			border-color: white;
		}
        .btn-b:hover {
            background-color: #016610;
            color:white;
        }
        .btn-bb{
			background-color: #f58c00;
			color:white;
			border-color: white;
		}
        .btn-bb:hover {
            background-color: #db7d00;
            color:white;
        }
    </style>
					
				
				<a style="width: 100px; background-color: green; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-success" title="Todas" onclick="buscar_status('')">TODAS</a>	
				<a style="width: 100px; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-danger" title="Abertas" onclick="buscar_status('Aberta')">ABERTAS</a>
				<a style="width: 100px; background-color: blue; border-color: blue; font-size:10px; margin-bottom: 3px; " href="#" title="Iniciadas" class="btn btn-primary" onclick="buscar_status('Iniciada')">INICIADAS</a>
				<a style="width: 100px; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-warning" title="Aguardando" onclick="buscar_status('Aguardando')">AGUARDANDO</a>
				<a style="width: 100px; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-success" title="Finalizadas" onclick="buscar_status('Finalizada')">FINALIZADAS</a>
				<a style="width: 100px; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-info" title="Entregues" onclick="buscar_status('Entregue')">ENTREGUES</a>
				<a style="width: 100px; font-size:10px; margin-bottom: 3px; " href="#" class="btn btn-dark" title="Sem Reparo" onclick="buscar_status('Sem Reparo')">S/ REPARO</a>
				<a style="width: 105px; font-size:10px; margin-bottom: 3px;  background-color: #141414;" href="#" title="Não Aprovadas" class="btn btn-dark" onclick="buscar_status('Não Aprovada')">N/ APROVADAS</a>
				<a style="width: 110px; font-size:10px; margin-bottom: 3px;  background-color: #ba3b14;" href="#" title="Não Aprovadas" class="btn btn-dark" onclick="buscar_status('Hoje')">ENTREGUES HOJE</a>
					
						
			
			
				<input type="hidden" id="status_busca" name="status">
		
		</form>
	</div>
	
</div>



<div class="row row-sm">
<div class="col-lg-12">
<div class="card custom-card">
<div class="card-body" id="listar">

</div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Editar OS</h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form_orcamento">
			<div class="modal-body">
							

					
					<div id="div_listar" class="row" style="margin-top: 0px; margin-bottom: 10px; ">
						<div class="col-md-12" id="listar_produtos">	
						</div>

						<div class="col-md-12" id="listar_servicos">	
						</div>
					</div>


					<div class="row" style="margin-top: 0px">
					

						<div class="col-md-6">		
							<div class="form-group"> 
								<label>Equipamento</label> 
								<input maxlength="255" class="form-control" type="text" name="equipamento" id="equipamento"  placeholder="Celular, Notebook" readonly>
							</div>	
						</div>



						<div class="col-md-6">		
							<div class="form-group"> 
								<label>Modelo</label> 
								<input maxlength="255" class="form-control" type="text" name="modelo" id="modelo"  placeholder="A10, A20, A30" readonly>
							</div>	
						</div>

						<div class="col-md-6">		
							<div class="form-group"> 
								<label>Marca</label> 
								<input maxlength="255" class="form-control" type="text" name="marca" id="marca"  placeholder="SAMSUNG, APPLE, XIAOMI" readonly>
							</div>	
						</div>

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Senha do Aparelho</label> 
								<input class="form-control" type="text" name="senha" id="senha" placeholder="123456" >
							</div>						
						</div>

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Garantia</label> 
								<input class="form-control" type="text" name="dias_garantia" id="dias_garantia" placeholder="90 Dias" >
							</div>						
						</div>

				</div>

				<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Defeito (Relatado pelo Cliente)</label> 
								<input maxlength="1000" class="form-control" type="text" name="defeito" id="defeito" placeholder="Não liga, Não carrega, etc">
							</div>						
						</div>								
				</div>


				<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
						<div class="form-group"> 
							<label>Acessórios</label> 
							<input maxlength="1000" class="form-control" type="text" name="acessorios" id="acessorios" placeholder="Capa, pelicula, chip, etc">
						</div>						
					</div>	
				</div>
	


					<div class="row" style="margin-top: 0px">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Condições ou Avarias</label> 
								<input maxlength="1000" class="form-control" type="text" name="condicoes" id="condicoes" placeholder="Tela Quebrada, arranhado, etc">
							</div>						
						</div>								
					</div>



				<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Laudo Técnico</label> 
								<input maxlength="1000" class="form-control" type="text" name="laudo" id="laudo" placeholder="Laudo Técnico Caso Exista">
							</div>						
					</div>								
				</div>
					
					
					
					<div class="row" style="margin-top: 0px">					

						<div class="col-md-10">					
							<div class="form-group"> 
								<label>OBS</label> 
								<input maxlength="1000" class="form-control" type="text" name="obs" id="obs" placeholder="Capa, pelicula, chip...">
							</div>						
						</div>


						<div class="col-md-2" style="margin-top: 22px">						
							<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>					
						</div>	
	
					</div>
					


					
					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


			</form>

		</div>
	</div>
</div>




	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					 <button id="btn-fechar-arquivos" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input class="form-control" type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div>

						<div class="row">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


					</div>
				</form>
			</div>
		</div>
	</div>




<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar-dados" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<small>


				<div class="row" style="margin-top: 0px">
					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>OS: </b></span><span id="id_dados"></span>
					</div>

					
					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Cliente: </b></span><span id="nome_cliente_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Data Entrega: </b></span><span id="data_entrega_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Dias Validade: </b></span><span id="dias_validade_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Equipamento: </b></span><span id="equipamento_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Marca: </b></span><span id="marca_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Modelo: </b></span><span id="modelo_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Garantia: </b></span><span id="dias_garantia_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Senha: </b></span><span id="senha_dados"></span>
					</div>


					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Defeito: </b></span><span id="defeito_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Laudo: </b></span><span id="laudo_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Condições: </b></span><span id="condicoes_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Acessóriso: </b></span><span id="acessorios_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>OBS: </b></span><span id="obs_dados"></span>
					</div>

					
				</div>
			</small>

			</div>
					
		</div>
	</div>
</div>



	<!-- Modal Status -->
	<div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:400px">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h4 class="modal-title" id="tituloModal">Mudar Status da OS</h4>
					<button id="btn-fechar-status" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
				</div>
				<form id="form-status" method="post">
					<div class="modal-body">					
						

						<div class="row" style="">
							<div class="col-md-8">
								<select class="form-select" aria-label="Default select example" name="status" id="id_status" onchange="buscar()">	
									<option value="Aberta">Aberta</option>
									<option value="Iniciada">Iniciada</option>								
									<option value="Aguardando Peça">Aguardando Peça</option>
									<option value="Aguardando Aprovação">Aguardando Aprovação</option>
									<option value="Sem Reparo">Sem Reparo</option>
									<option value="Não Aprovada">Não Aprovada</option>
									<option value="Finalizada">Finalizada</option>
									<option value="Entregue">Entregue</option>
								</select>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Editar</button>
							</div>
						</div>

						
						
						<br>
						<small><div align="center" id="mensagem-status"></div></small>

						<input type="hidden" class="form-control" name="id_da_os"  id="id_da_os">


					</div>
				</form>
			</div>
		</div>
</div>



					


		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {

				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});
				
				setTimeout(() => {
					listarClientes();
				listarProdutos();
				listarServicos();

				buscar();
				}, 1000);

			});
		</script>


				
		
		


		<script type="text/javascript">

			function listarBusca(dataInicial, dataFinal, status, alterou_data){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {dataInicial, dataFinal, status, alterou_data},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}
		

		</script>




		


		<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}



				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>




		<script type="text/javascript">
			$("#form-arquivos").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/arquivos.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo').text('');
						$('#mensagem-arquivo').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>

		<script type="text/javascript">
			function listarArquivos(){
				var id = $('#id-arquivo').val();	
				$.ajax({
					url: 'paginas/' + pag + "/listar-arquivos.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos").html(result);
					}
				});
			}

		</script>




<script type="text/javascript">
	

$("#form-cliente").submit(function () {

    $('#mensagem_cliente').text('Carregando!!');
    $('#btn_salvar_cliente').hide();

    event.preventDefault();
    var formData = new FormData(this);
    var nova_pag = 'clientes';

    $.ajax({
        url: 'paginas/' + nova_pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem_cliente').text('');
            $('#mensagem_cliente').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-cliente').click();
                listar();
                listarClientes('1');          

            } else {

                $('#mensagem_cliente').addClass('text-danger')
                $('#mensagem_cliente').text(mensagem)
            }

             $('#btn_salvar_cliente').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});




function listarProdutos(orc){

	
	var id = $("#id").val();
	$.ajax({
        url: 'paginas/' + pag + "/listar_produtos.php",
        method: 'POST',
        data: {id, orc},
        dataType: "html",

        success:function(result){        	
           $("#listar_produtos").html(result);      
        }
    });
}



function listarServicos(orc){
	
	var id = $("#id").val();
	$.ajax({
        url: 'paginas/' + pag + "/listar_servicos.php",
        method: 'POST',
        data: {id, orc},
        dataType: "html",

        success:function(result){        	
           $("#listar_servicos").html(result);      
        }
    });
}




$("#form_orcamento").submit(function () {

    $('#mensagem').text('Carregando!!');
    $('#btn_salvar').hide();

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {         	 	 
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();
                listar();
                listarServicos();
                listarProdutos();

            } else {
               alert(mensagem)
            }

             $('#btn_salvar').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



function buscar(){
	var dataInicial = "";
	var dataFinal = "";
	var status = $('#status_busca').val();
	var filtro = 'filtro';

	listar(dataInicial, dataFinal, status, filtro);

}


</script>



		<script type="text/javascript">
			$("#form-status").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/status.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {

						$('#mensagem-status').text('');
						$('#mensagem-status').removeClass()
						if (mensagem.trim() == "Alterado com Sucesso") {                    
						$('#btn-fechar-status').click();
						listar();
					} else {
						$('#mensagem-status').addClass('text-danger')
						$('#mensagem-status').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
	</script>

		<script type="text/javascript">
			function buscar_status(status){
				$('#status_busca').val(status);
				buscar();
			}
		</script>


		<script type="text/javascript">
			$('#modalCliente').on('hidden.bs.modal', function (e) {
		      $('body').addClass('modal-open');
			});
		</script>
<?php 
$pag = 'orcamentos';
?>



<div class="row row-sm" style="margin-top: 20px">
<div class="col-lg-12">
<div class="card custom-card">
<div class="card-body" id="listar">

</div>
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
						<span><b>Data Entrega: </b></span><span id="data_entrega_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Dias Validade: </b></span><span id="dias_validade_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Desconto: </b></span><span id="desconto_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Tipo de Desconto: </b></span><span id="tipo_desconto_dados"></span>
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
						<span><b>Prod e Serv: </b></span><span id="valor_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Valor: </b></span><span id="vall_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Frete: </b></span><span id="frete_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Subtotal: </b></span><span id="subtotal_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Defeito: </b></span><span id="defeito_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>OBS: </b></span><span id="obs_dados"></span>
					</div>

				


					
				</div>
			</small>

			</div>
					
		</div>
	</div>
</div>

		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		



		<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "../painel/images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "../painel/images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "../painel/images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "../painel/images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "../painel/images/xml.png");
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
						$('#target-arquivos').attr('src','../painel/images/arquivos/sem-foto.png');
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




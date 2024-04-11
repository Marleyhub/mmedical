<?php 
$pag = 'clientes';

//verificar se ele tem a permissão de estar nessa página
if(@$clientes == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
} 
 ?>
<div class="breadcrumb-header justify-content-between">
 	<div class="left-content mt-2">
<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i> Adicionar <?php echo ucfirst($pag); ?></a>


<!-- BOTÃO EXCLUIR SELEÇÃO -->
			<div class="dropdown" style="display: inline-block;">                      
                        <a href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="btn btn-danger dropdown" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>
                  <div  class="dropdown-menu tx-13">
                      <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                        <p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
                      </div>
                  </div>
             </div>

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

<input type="hidden" id="ids">



<!-- Modal Cliente -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-8 mb-2 col-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>							
						</div>

							<div class="col-md-4 mb-2 col-6">							
								<label>Apelido</label>
								<input type="text" class="form-control" id="apelido" name="apelido" placeholder="Apelido">							
						</div>
							

					</div>

					<div class="row">

						<div class="col-md-3 mb-2 col-6">						
								<label>Pessoa</label>
								<select class="form-select" name="pessoa" id="pessoa" onchange="mudarPessoa()">
									<option value="Física">Física</option>
									<option value="Jurídica">Jurídica</option>
								</select>						
						</div>

						<div class="col-md-3 mb-2 col-6">							
								<label id="label_pessoa">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" >							
						</div>

							<div class="col-md-6">							
								<label>E-mail</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="Seu E-mail" >							
						</div>

					</div>

					<div class="row">


						<div class="col-md-4 col-6">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>							
						</div>

						<div class="col-md-4 mb-2 col-6">							
								<label>Telefone Secundário</label>
								<input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="Outro Telefone para Contato">							
						</div>

							<div class="col-md-4">							
								<label>Nome Secundário</label>
								<input type="text" class="form-control" id="nome2" name="nome2" placeholder="Falar com">							
						</div>


						
					</div>

					<div class="row">

						<div class="col-md-12">							
									<label>Endereço</label>
									<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu Endereço" >							
							</div>
					</div>





					<input type="hidden" class="form-control" id="id" name="id">					

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" id="btn_salvar" class="btn btn-primary">Salvar</button>
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
						<span><b>Apelido: </b></span><span id="apelido_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					
					<div class="col-md-7" style="margin-bottom: 5px">
						<span><b>Telefone Sec: </b></span><span id="telefone2_dados"></span>
					</div>

					<div class="col-md-7" style="margin-bottom: 5px">
						<span><b>Nome Sec: </b></span><span id="nome2_dados"></span>
					</div>


						<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Pessoa: </b></span><span id="pessoa_dados"></span>
					</div>

					<div class="col-md-7" style="margin-bottom: 5px">
						<span><b>CPF / CNPJ: </b></span><span id="cpf_dados"></span>
					</div>

				

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-7" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
					</div>

					
				</div>
			</small>
				<div id="listar_servicos" style="margin-top: 15px">

				</div>
			</div>
					
		</div>
	</div>
</div>




<!-- Modal Contas -->
<div class="modal fade" id="modalContas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_contas"></span></h4>
				<button id="btn-fechar-contas" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">				
				<div id="listar_debitos" style="margin-top: 15px">

				</div>
				<input type="hidden" id="id_contas">
			</div>
					
		</div>
	</div>
</div>




	<!-- Modal baixar -->
	<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content ">
				<div class="modal-header bg-primary text-white">
					<h4 class="modal-title" id="tituloModal">Baixar Conta: <span id="descricao-baixar"> </span></h4>
					 <button id="btn-fechar-baixar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
				</div>
				<form id="form-baixar" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label>Valor <small class="text-muted">(Total ou Parcial)</small></label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar"  id="valor-baixar" required>
								</div>
							</div>


							<div class="col-md-6">
								<div class="form-group"> 
									<label>Local Saída</label> 
									<select class="form-select sel4" name="saida-baixar" id="saida-baixar" required style="width:100%;">	
									<?php 
									$query = $pdo->query("SELECT * FROM formas_pgto order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
								</div>
							</div>

						</div>	


						<div class="row">


							<div class="col-md-4">
								<div class="mb-3">
									<label>Multa em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa"  id="valor-multa" placeholder="Ex 15.00" value="0">
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label>Júros em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros"  id="valor-juros" placeholder="Ex 0.15" value="0">
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label>Desconto em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto"  id="valor-desconto" placeholder="Ex 15.00" value="0" >
								</div>
							</div>

						</div>


						<div class="row">

							<div class="col-md-6">
								<div class="mb-3">
									<label>Data da Baixa</label>
									<input type="date" class="form-control" name="data-baixar"  id="data-baixar" value="<?php echo date('Y-m-d') ?>" >
								</div>
							</div>


							<div class="col-md-6">
								<div class="mb-3">
									<label>SubTotal</label>
									<input type="text" class="form-control" name="subtotal"  id="subtotal" readonly>
								</div>	
							</div>
						</div>




						<small><div id="mensagem-baixar" align="center"></div></small>

						<input type="hidden" class="form-control" name="id-baixar"  id="id-baixar">


					</div>
					<div class="modal-footer">
						
						<button type="submit" class="btn btn-success">Baixar</button>
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




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function mudarPessoa(){
		var pessoa = $('#pessoa').val();
		
		if(pessoa == 'Física'){
			$('#label_pessoa').text('CPF');
			$('#cpf').mask('000.000.000-00');
			$('#cpf').attr('placeholder', 'CPF');
		}else{
			$('#label_pessoa').text('CNPJ');
			$('#cpf').mask('00.000.000/0000-00');
			$('#cpf').attr('placeholder', 'CNPJ');
		}
	}
</script>




		<script type="text/javascript">
			$("#form-baixar").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/receber/baixar.php',
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-baixar').text('');
						$('#mensagem-baixar').removeClass()
						if (mensagem.trim() == "Baixado com Sucesso") {                    
							$('#btn-fechar-baixar').click();
							listar();
							var id = $('#id_contas').val();
							listarDebitos(id);
						} else {
							$('#mensagem-baixar').addClass('text-danger')
							$('#mensagem-baixar').text(mensagem)
						}

					},

					cache: false,
					contentType: false,
					processData: false,

				});

			});
		</script>




		<script type="text/javascript">

			function totalizar(){
				valor = $('#valor-baixar').val();
				desconto = $('#valor-desconto').val();
				juros = $('#valor-juros').val();
				multa = $('#valor-multa').val();

				valor = valor.replace(",", ".");
				desconto = desconto.replace(",", ".");
				juros = juros.replace(",", ".");
				multa = multa.replace(",", ".");

				if(valor == ""){
				valor = 0;
			}

			if(desconto == ""){
				desconto = 0;
			}

			if(juros == ""){
				juros = 0;
			}

			if(multa == ""){
				multa = 0;
			}

				subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);


				console.log(subtotal)

				$('#subtotal').val(subtotal);

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
			
						const modalForm = document.getElementById('modalForm')
const nome = document.getElementById('nome')

modalForm.addEventListener('shown.bs.modal', () => {
  nome.focus()
})
			
		</script>


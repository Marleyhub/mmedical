<?php 
$pag = 'receber';

//verificar se ele tem a permissão de estar nessa página
if(@$receber == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
?>

<div class="justify-content-between">
	<form action="rel/receber_class.php" target="_blank" method="POST">
 	<div class="left-content mt-2">

 <a style="margin-bottom: 20px; margin-top: 20px" class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i>Adicionar Recebimentos</a>

<small class="ocultar_mobile" style="display: inline-block; position: absolute; right: 20px; margin-top: 30px"><i class="fa fa-usd verde"></i> <span class="text-dark">Total: <span class="verde" id="total_itens"></span></span></small>

	  <div style="display: inline-block; margin-bottom: 10px; margin: 10px 10px;">
			<input type="date" name="data-inicial" class="form-control2" id="data-inicial" style="height:35px; width:49%; font-size: 13px;" value="<?php echo date('Y-m-d') ?>" required>

			<input type="date" name="data-final" class="form-control2" id="data-final" style="height:35px; width:49%; font-size: 13px;" value="<?php echo date('Y-m-d') ?>" required>	
		</div>	





		<div style="display: inline-block;">
			<select class="form-select" aria-label="Default select example" name="status-busca" id="status-busca">
				<option value="">Todas</option>
				<option value="Não">Pendentes</option>
				<option value="Sim">Pagas</option>
				
			</select>
		</div>

			<div style="display: inline-block;">
				<span class="ocultar_mobile" style="font-size: 14px; border:1px solid #6092a8; padding:5px; ">
				<a title="Contas à Pagar Vencidas" class="text-muted" href="#" onclick="listarContasVencidas('Vencidas')"><span>Vencidas</span></a> / 
				<a title="Contas à Pagar Hoje" class="text-muted" href="#" onclick="listarContasVencidas('Hoje')"><span>Hoje</span></a> / 
				<a title="Contas à Pagar Amanhã" class="text-muted" href="#" onclick="listarContasVencidas('Amanha')"><span>Amanhã</span></a>
			</span>
			</div>

	
		



	</div>

	<input type="hidden" name="tipo_data" id="tipo_data">

	</form>
		
</div>	


<div class="row row-sm">
<div class="col-lg-12">
<div class="card custom-card">
<div class="card-body" id="listar">

</div>
</div>
</div>
</div>



<!-- Modal Principal-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="titulo_inserir"></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form-contas">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4 col-8">						
							<div class="form-group"> 
								<label>Descrição</label> 
								<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição"> 
							</div>						
						</div>

						<div class="col-md-2 col-4">						
							<div class="form-group"> 
								<label>Valor</label> 
								<input type="text" class="form-control" name="valor" id="valor" placeholder="Valor" required> 
							</div>						
						</div>

						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Cliente</label> 
								<select class="form-select sel2" name="cliente" id="cliente" style="width:100%;"> 

									<option value="">Selecionar Cliente</option>

									<?php 
									$query = $pdo->query("SELECT * FROM clientes order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> - <?php echo $res[$i]['cpf'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div>



					</div>

				

					<div class="row">
						
						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Vencimento</label> 
								<input type="date" class="form-control" name="data_venc" id="data_venc" required> 
							</div>						
						</div>

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Data Pagamento</label> 
								<input type="date" class="form-control" name="data_pgto" id="data_pgto"> 
							</div>						
						</div>

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Frequência</label> 
								<select class="form-select sel2" name="frequencia" id="frequencia"  style="width:100%;"> 
									<option value="0">Uma Vez</option>
									<?php 
									$query = $pdo->query("SELECT * FROM frequencias order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['dias'] ?>"><?php echo $res[$i]['frequencia'] ?></option>

									<?php } ?>

								</select>
							</div>						
						</div>


						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Forma de Pagamento</label> 
								<select class="form-select sel2" name="saida" id="saida" style="width:100%;"> 
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


					<div class="col-md-6 mb-3">

							<label>Observações</label>
							<input type="text" class="form-control" id="obs" name="obs" placeholder="Observações" >							
						</div>					

						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Foto</label> 
								<input type="file" name="arquivo" onChange="carregarImg();" id="arquivo">
							</div>						
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="images/contas/sem-foto.png"  width="100px" id="target">									
							</div>
						</div>


					</div>				
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>



			</form>

		</div>
	</div>
</div>


<input type="hidden" id="ids">


<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span></h4>
				 <button id="btn-fechar-dados" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">			



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b><span id="tipo_pessoa_mostrar"></span> </b></span>
						<span id="pessoa_mostrar"></span>							
					</div>

					<div class="col-md-6">							
						<span><b>Tel: </b></span>
						<span id="tel_mostrar"></span>			
					</div>
					
				</div>



					<div class="row" style="border-bottom: 1px solid #cac7c7;">

						<div class="col-md-6">							
						<span><b>Valor: </b></span>
						<span id="valor_mostrar"></span>
					</div>

						<div class="col-md-6">							
							<span><b>Entrada: </b></span>
							<span id="val_entrada_mostrar"></span>							
						</div>
					
					</div>		


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data Lançamento: </b></span>
						<span id="lanc_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Data Vencimento: </b></span>
						<span id="venc_mostrar"></span>
					</div>
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Data PGTO: </b></span>
						<span id="pgto_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Usuário Cadastro: </b></span>
						<span id="usu_lanc_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Usuário Baixa: </b></span>
						<span id="usu_pgto_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Frequência: </b></span>
						<span id="freq_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Saída: </b></span>
						<span id="saida_mostrar"></span>							
					</div>
					<div class="col-md-6">							
						<span><b>Pago: </b></span>
						<span id="pago_mostrar"></span>
					</div>
				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
				<div class="col-md-6">							
							<span><b>Chave Pix: </b></span>
							<span id="pix_mostrar"></span>							
						</div>

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-12">							
						<span><b>OBS: </b></span>
						<span id="obs_mostrar"></span>
					</div>
				</div>



				<div class="row">
					<div class="col-md-12" align="center">		
						<a id="link_arquivo" target="_blank"><img  width="200px" id="target_mostrar"></a>	
					</div>
				</div>



			</div>


		</div>
	</div>
</div>







<!-- Modal Parcelar -->
<div class="modal fade" id="modalParcelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="tituloModal">Parcelar Conta: <span id="nome-parcelar"> </span></h4>
				<button id="btn-fechar-parcelar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form-parcelar">
				<div class="modal-body">


					<div class="row">
						<div class="col-md-3">
							<div class="mb-3">
								<label>Valor</label>
								<input type="text" class="form-control" name="valor-parcelar"  id="valor-parcelar"  readonly>
							</div>
						</div>

						<div class="col-md-2">
							<div class="mb-3">
								<label>Parcelas</label>
								<input type="number" class="form-control" name="qtd-parcelar"  id="qtd-parcelar"  required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group"> 
								<label>Frequência Parcelas</label> 
								<select class="form-select sel3" name="frequencia" id="frequencia-parcelar" required style="width:100%;">
									<option value="0">Uma Vez</option>
									<?php 
									$query = $pdo->query("SELECT * FROM frequencias order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){	}
											$id_item = $res[$i]['id'];
										$nome_item = $res[$i]['frequencia'];
										$dias = $res[$i]['dias'];

										if($nome_item != 'Uma Vez' and $nome_item != 'Única'){

											?>
											<option <?php if($nome_item == 'Mensal'){ ?> selected <?php } ?> value="<?php echo $dias ?>"><?php echo $nome_item ?></option>

										<?php } } ?>


									</select>
								</div>
							</div>

							<div class="col-md-3" style="margin-top:25px">						 
								<button type="submit" class="btn btn-primary">Parcelar</button>
							</div>

						</div>	


						<input type="hidden" name="id-parcelar" id="id-parcelar"> 
						<input type="hidden" name="nome-parcelar" id="nome-input-parcelar"> 
						<small><div id="mensagem-parcelar" align="center" class="mt-3"></div></small>					

					</div>

					<div class="modal-footer">

					</div>

				</form>

			</div>
		</div>
	</div>






	<!-- Modal Baixar-->
	<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
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


							<div class="col-md-6 style=">
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





	<!-- Modal -->
	<div class="modal fade" id="modalResiduos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary text-white">
					<h4 class="modal-title" id="tituloModal">Residuos da Conta</h4>
					 <button id="btn-fechar-dados" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">

					<small><div id="listar-residuos"></div></small>

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

						<div class="row" >
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





		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});



				$('#data-inicial').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);
				});

				$('#data-final').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);
				});

				$('#status-busca').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					listarBusca(dataInicial, dataFinal, status);
				});


			});
		</script>


		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel3').select2({
					dropdownParent: $('#modalParcelar')
				});
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel4').select2({
					dropdownParent: $('#modalBaixar')
				});
			});
		</script>



		<script type="text/javascript">
			function carregarImg() {
				var target = document.getElementById('target');
				var file = document.querySelector("#arquivo").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx'){
					$('#target').attr('src', "images/word.png");
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
			$("#form-parcelar").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/parcelar.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-parcelar').text('');
						$('#mensagem-parcelar').removeClass()
						if (mensagem.trim() == "Parcelado com Sucesso") {                    
							$('#btn-fechar-parcelar').click();
							listar();
						} else {
							$('#mensagem-parcelar').addClass('text-danger')
							$('#mensagem-parcelar').text(mensagem)
						}

					},

					cache: false,
					contentType: false,
					processData: false,

				});

			});
		</script>



		<script type="text/javascript">
			$("#form-baixar").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/baixar.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-baixar').text('');
						$('#mensagem-baixar').removeClass()
						if (mensagem.trim() == "Baixado com Sucesso") {                    
							$('#btn-fechar-baixar').click();
							listar();
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



			function listarContasVencidas(vencidas){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {vencidas},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasHoje(hoje){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {hoje},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasAmanha(amanha){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {amanha},
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
	
$("#form-contas").submit(function () {
	event.preventDefault();
	var formData = new FormData(this);

	$.ajax({
		url: 'paginas/' + pag + "/inserir.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                    
                    $('#btn-fechar').click();
                   var dataInicial = $('#data-inicial').val();
				var dataFinal = $('#data-final').val();
				var status = $('#status-busca').val();
				var alterou_data = 'Sim';
				listarBusca(dataInicial, dataFinal, status, alterou_data);
                } else {
                	$('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});

</script>

<script type="text/javascript">
			
		const modalForm = document.getElementById('modalForm')
		const descricao = document.getElementById('descricao')

		modalForm.addEventListener('shown.bs.modal', () => {
  	descricao.focus()
	})
		</script>
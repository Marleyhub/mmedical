<?php 
$pag = 'os';

//verificar se ele tem a permissão de estar nessa página
if(@$os == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
?>
<div class="justify-content-between">
	<form action="rel/lista_os_class.php" target="_blank" method="POST">
 	<div class="left-content mt-2">

 <a style="margin-bottom: 20px; margin-top: 20px" class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i>Adicionar <?php echo ucfirst($pag); ?></a>



	<div style="float:right;margin-top: 20px">
				<button class="btn btn-success esc botao_rel" type="submit">Relatório</button>
			</div>


  		<div style="display: inline-block; margin-bottom: 10px; margin: 10px 10px;">

			<input type="date" name="dataInicial"  class="form-control2" id="dataInicial" style="height:35px; width:49%; font-size: 13px;" value="<?php echo date('Y-m-d') ?>" required onchange="buscar()">

			<input type="date" name="dataFinal" class="form-control2" id="dataInicial" style="height:35px; width:49%; font-size: 13px;" value="<?php echo date('Y-m-d') ?>" required onchange="buscar()">	
		</div>	





		<div class="ocultar_mobile" style="display: inline-block;">
				<select class="form-select" aria-label="Default select example" name="status" id="status" onchange="buscar()">
				<option value="">Todos</option>
				<option value="Aberta">Abertas</option>
				<option value="Iniciada">Iniciadas</option>
				<option value="Aguardando_Peca">Aguardando Peça</option>
				<option value="Aguardando_Aprovação">Aguardando Aprovação</option>
				<option value="Sem_Reparo">Sem Reparo</option>
				<option value="Nao_Aprovada">Não Aprovadas</option>
				<option value="Finalizada">Finalizadas</option>
				<option value="Entregue">Entregues</option>
				<option value="Hoje">Entregas Hoje</option>
			</select>
		</div>

		
		
	</div>


	</form>

	

	
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- Modal OS-->
<div class="modal fade" id="modalForm" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document" style="width:90%; overflow: scroll; height:auto; max-height: 600px; scrollbar-width: thin;">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form method="post" id="form_orcamento">
			<div class="modal-body">
					<div class="row" style="margin-top: 5px">					
						<div class="col-md-5 col-8">						
							<div class="form-group"> 
								<label>Cliente</label> 
									<div id="listar_clientes">
									
									</div>
							</div>		
						</div>

					<div class="col-md-1 col-4" style="margin-top: 28px; margin-left: -15px">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCliente" > <i class="fa fa-plus"></i> </button>	
					</div>


						<div class="col-md-3">						
							<div class=""> 
								<label>Produtos / <small>R$ <span id="tot_produtos"></span></small></label> 
								<select class="sel2" name="produto" id="produto"  style="width:80%;"> 
									<option value="">Adicionar Produto</option>
									<?php 
									$query = $pdo->query("SELECT * FROM produtos where ativo = 'Sim' order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>

								<a class="btn btn-success" href="#" onclick="addProduto()" class="btn btn-primary"> <i class="fa fa-check"></i> </a>
							</div>						
						</div>

						


						<div class="col-md-3">						
							<div class=""> 
								<label>Serviços / <small>R$ <span id="tot_servicos"></span></small></label> 
								
								<select class="sel2" name="servico" id="servico"  style="width:80%;"> 
									<option value="">Adicionar Serviço</option>
									<?php 
									$query = $pdo->query("SELECT * FROM servicos where ativo = 'Sim' order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>

								<a class="btn btn-success" href="#" onclick="addServico()" class="btn btn-primary"> <i class="fa fa-check"></i> </a>
							</div>						
						</div>

					
					</div>

				

					
					<div id="div_listar" class="row" style="margin-top: 0px; margin-bottom: 10px; overflow: scroll; height:auto; max-height: 250px; scrollbar-width: thin;">
						<div class="col-md-12" id="listar_produtos">	
						</div>

						<div class="col-md-12" id="listar_servicos">	
						</div>
					</div>



					<div class="row" style="margin-top: 0px">

							<div class="col-md-3 mb-2 col-6">		
								<label>Técnico</label> 
								<select class="sel2" name="tecnico" id="tecnico" style="width:100%;"> 
									<option value="">Selecione um Técnico</option>
									<?php 
									$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Técnico' or nivel = 'Administrador' order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>								
								
							</div>

						<div class="col-md-3">		
							<div class="form-group"> 
								<label>Modelo</label> 
								<input maxlength="255" class="form-control" type="text" name="modelo" id="modelo"  placeholder="A10 - A105" required>
							</div>	
						</div>



							<div class="col-md-3 col-6"> 
								<label>Equipamento</label> 
								<select class="sel2" name="equipamento" id="equipamento" style="width:100%;"> 
									<option value="">Selecione um Equipamento</option>
									<?php 
									$query = $pdo->query("SELECT * FROM equipamentos where ativo = 'Sim' order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>

								</select>

							</div>


							
							<div class="col-md-3 col-6"> 

								<label>Marca</label> 
								<select class="sel2" name="marca" id="marca"  style="width:100%;"> 
									<option value="">Selecione um Marca</option>
									<?php 
									$query = $pdo->query("SELECT * FROM marcas where ativo = 'Sim' order by id desc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } ?>

								</select>

							</div>




					</div>

	

					<div class="row" style="margin-top: 15px">	

						<div class="col-md-2 col-6" style="display:none">	
							<div class="form-group"> 
								<label>Valor R$</label> 
								<input class="form-control" type="number" name="vall" id="vall"  placeholder="valor" onkeyup="totalizar()" onchange="totalizar()">
							</div>	
						</div>

						

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Produtos e Serviços R$</label> 
								<input class="form-control" type="text" name="valor" id="valor" readonly>
							</div>						
						</div>

						

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Tipo Desconto</label> 
								<select class="form-select"  name="tipo_desconto" id="tipo_desconto" onchange="totalizar()">
									<option value="%">% Porcentagem</option>
									<option value="Valor">R$ Valor</option>
								</select>
							</div>						
						</div>

						<div class="col-md-2 col-6">						
							<div class="form-group"> 
								<label>Desconto</label> 
								<input class="form-control" type="number" name="desconto" id="desconto" placeholder="Desconto"  onkeyup="totalizar()">
							</div>						
						</div>


						<div class="col-md-2 col-6">						
							<div class="form-group"> 
								<label>Frete</label> 
								<input class="form-control" type="text" name="frete" id="frete" placeholder="Se Houver" onkeyup="totalizar()">
							</div>						
						</div>	

						<div class="col-md-2 col-6">		
							<div class="form-group"> 
								<label>Mão de Obra</label> 
								<input class="form-control" type="number" name="mao_obra" id="mao_obra"  placeholder="Caso Tenha Valor" onkeyup="totalizar()" onchange="totalizar()">
							</div>	
						</div>
						


					</div>



					<div class="row" style="margin-top: 10px">

					

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Data Entrega</label> 
								<input class="form-control" type="date" name="data_entrega" id="data_entrega" required>
							</div>						
						</div>

						<div class="col-md-2 col-6">		
							<div class="form-group"> 
								<label>Valor de Entrada R$</label> 
								<input class="form-control" type="number" name="val_entrada" id="val_entrada"  placeholder="Valor de Entrada" onkeyup="totalizar()" onchange="totalizar()">
							</div>	
						</div>

					

						<div class="col-md-2 col-6">						
							<div class="form-group"> 
								<label>SubTotal</label> 
								<input class="form-control" type="text" name="subtotal" id="subtotal" readonly >
							</div>						
						</div>

						<div class="col-md-3 col-6">						
							<div class="form-group"> 
								<label>Senha do Aparelho</label> 
								<input class="form-control" type="text" name="senha" id="senha" placeholder="123456" >
							</div>						
						</div>

						<div class="col-md-2 col-6">						
							<div class="form-group"> 
								<label>Garantia</label> 
								<input class="form-control" type="text" name="dias_garantia" id="dias_garantia" placeholder="90 Dias" >
							</div>						
						</div>


					</div>


				<div class="row">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Defeito (Relatado pelo Cliente)</label> 
								<input maxlength="1000" class="form-control" type="text" name="defeito" id="defeito" placeholder="Não liga, Não carrega, etc" required>
							</div>						
						</div>
							
				</div>


				<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Condições ou Avarias</label> 
								<input maxlength="1000" class="form-control" type="text" name="condicoes" id="condicoes" placeholder="Tela Quebrada, arranhado, etc">
							</div>						
						</div>								
				</div>


					
				<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Laudo Técnico</label> 
								<input maxlength="1000" class="form-control" type="text" name="laudo" id="laudo" placeholder="Laudo Técnico se Houver">
							</div>						
						</div>								
				</div>


					<div class="row">
						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Acessórios</label> 
								<input maxlength="1000" class="form-control" type="text" name="acessorios" id="acessorios" placeholder="Capa, pelicula, chip, etc">
							</div>						
						</div>									
					</div>
					




					<div class="row" style="margin-top: 0px">

						<div class="col-md-8">					
							<div class="form-group"> 
								<label>OBS</label> 
								<input maxlength="1000" class="form-control" type="text" name="obs" id="obs" placeholder="Capa, pelicula, chip...">
							</div>						
						</div>

						<div class="col-md-2 col-6">						
							<div class="form-group"> 
								<label>Enviar PDF</label> 
								<select class="form-select"  name="enviar_pdf" id="enviar_pdf">
									<option value="Sim">Sim</option>
									<option value="Não">Não</option>
								</select>
							</div>						
						</div>

						<div class="col-md-2" style="margin-top: 22px">						
							<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>					
						</div>								

				</div>

					<div class="row" style="margin-top: 0px">


				</div>			
						

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


			</form>

		</div>
	</div>
</div>






<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel">Adicionar Cliente</h4>
				<button id="btn-fechar-cliente" aria-label="Close" class="btn-close" data-bs-toggle="modal" data-bs-target="#modalForm" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			<form id="form-cliente">
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
				<small><div id="mensagem_cliente" align="center"></div></small>
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
					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Cliente: </b></span><span id="nome_cliente_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>OS: </b></span><span id="id_dados"></span>
					</div>

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
						<span><b>Entrada: </b></span><span id="val_entrada_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Mão de Óbra: </b></span><span id="val_entrada_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Subtotal: </b></span><span id="subtotal_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Garantia: </b></span><span id="dias_garantia_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Senha: </b></span><span id="senha_dados"></span>
					</div>

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Técnico: </b></span><span id="nome_tecnico_dados"></span>
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


			<form id="form_rel" method="POST" action="rel/os_class.php" target="_blank" style="display:none">
				<input type="text" name="id" id="id_orca">
				<input type="text" name="enviar" id="enviar_rel" value="Sim">
				<button type="submit" id="botao_disparar_rel">Enviar</button>
			</form>


		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {

				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});


				$(document).on('select2:open', () => {
				    document.querySelector('.select2-search__field').focus();
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
                inserir();
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


function listarClientes(valor){
	$.ajax({
        url: 'paginas/' + pag + "/listar_clientes.php",
        method: 'POST',
        data: {valor},
        dataType: "html",

        success:function(result){
            $("#listar_clientes").html(result);           
        }
    });
}

function addProduto(){
	var id = $("#id").val();
	var produto = $("#produto").val();
	if(produto == ""){
		alert('Selecione um produto');
		return;
	}
	$.ajax({
        url: 'paginas/' + pag + "/addProduto.php",
        method: 'POST',
        data: {produto, id},
        dataType: "html",

        success:function(result){
           listarProdutos();        
        }
    });
}

function listarProdutos(orc){

	totalizar();
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


function quantidadeProdutos(id){		
	var quant = $("#quant_produtos_"+id).val();	
	$.ajax({
        url: 'paginas/' + pag + "/quantidade_produtos.php",
        method: 'POST',
        data: {id, quant},
        dataType: "html",

        success:function(result){             	
           listarProdutos();    
        }
    });
}


function excluirProduto(id){
	$.ajax({
        url: 'paginas/' + pag + "/excluir_produto.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){             	
           listarProdutos();    
        }
    });
}








function addServico(){
	var id = $("#id").val();
	var servico = $("#servico").val();
	if(servico == ""){
		alert('Selecione um Serviço');
		return;
	}
	$.ajax({
        url: 'paginas/' + pag + "/addServico.php",
        method: 'POST',
        data: {servico, id},
        dataType: "html",

        success:function(result){
           listarServicos();        
        }
    });
}

function listarServicos(orc){
	totalizar();
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


function quantidadeServicos(id){		
	var quant = $("#quant_servicos_"+id).val();	
	$.ajax({
        url: 'paginas/' + pag + "/quantidade_servicos.php",
        method: 'POST',
        data: {id, quant},
        dataType: "html",

        success:function(result){             	
           listarServicos();    
        }
    });
}


function excluirServico(id){
	$.ajax({
        url: 'paginas/' + pag + "/excluir_servico.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){             	
           listarServicos();    
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
        	
        	var msg = mensagem.split('-');      	 
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (msg[0].trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();
                listar();
                listarServicos();
                listarProdutos();

                
                var id_orc = msg[1].trim();
               //abrir o relatório pdf
               window.open("rel/os_class.php?id="+id_orc+"&enviar=Sim"); 

                  $('#id_orca').val(id_orc);
                 $('#enviar_rel').val('Sim'); 
                 
                  var enviar_pdf = $('#enviar_pdf').val(); 
                 if(enviar_pdf == 'Sim'){                 	
                 	 $('#botao_disparar_rel').click();
                 }
                

            } else {
               alert(msg[0])
            }

             $('#btn_salvar').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



function buscar(){
	var dataInicial = $('#dataInicial').val();
	var dataFinal = $('#dataFinal').val();
	var status = $('#status').val();

	listar(dataInicial, dataFinal, status);

}

function totalizar(){
	
	var mao_obra = $('#mao_obra').val();
	var val_entrada = $('#val_entrada').val();
	var vall = $('#vall').val();
	var desconto = $('#desconto').val();
	var tipo_desconto = $('#tipo_desconto').val();
	var frete = $('#frete').val();
	var id = $("#id").val();
	

	$.ajax({
        url: 'paginas/' + pag + "/totalizar.php",
        method: 'POST',
        data: {desconto, tipo_desconto, frete, id, mao_obra, val_entrada, vall},
        dataType: "html",

        success:function(result){   
        var vlr = result.split('-');          	
           $('#subtotal').val(vlr[1]);
           $('#valor').val(vlr[0]);
        }
    });
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
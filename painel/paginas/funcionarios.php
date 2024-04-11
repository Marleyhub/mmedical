<?php 
$pag = 'funcionarios';

//verificar se ele tem a permissão de estar nessa página
if(@$funcionarios == 'ocultar'){
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

<!-- Modal -->
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
						<div class="col-md-6 mb-2">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Seu Email"  required>							
						</div>

						
					</div>


					<div class="row">

						<div class="col-md-4 mb-2 col-6">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Seu Telefone" required>							
						</div>
						

						<div class="col-md-4 mb-2 col-6">							
								<label>Cargo</label>
								<select class="form-select" name="nivel" id="nivel">
								  <?php 
								  	$query = $pdo->query("SELECT * from cargos order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){ ?>
											<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } } ?>
								</select>							
						</div>

							<div class="col-md-4">							
								<label>Chave Pix</label>
								<input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix" >							
							</div>


						
					</div>

					<div class="row">

						<div class="col-md-9 mb-2">							
								<label>Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu Endereço" >							
						</div>

						<div class="col-md-3">							
								<label>Comissão %</label>
								<input type="number" class="form-control" id="comissao" name="comissao" placeholder="Comissão %" >							
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
				<div class="row" style="margin-top: 0px">
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					
					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>Email: </b></span><span id="email_dados"></span>
					</div>

					

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Nível: </b></span><span id="nivel_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Comissão: </b></span><span id="comissao_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Chave Pix: </b></span><span id="pix_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="200px"></div>
					</div>
				</div>
			</div>
					
		</div>
	</div>
</div>



	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
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
			
			const modalForm = document.getElementById('modalForm')
const nome = document.getElementById('nome')

modalForm.addEventListener('shown.bs.modal', () => {
  nome.focus()
})
</script>



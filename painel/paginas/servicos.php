<?php 
$pag = 'servicos';

//verificar se ele tem a permissão de estar nessa página
if(@$servicos == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
 ?>
<div class="margem_mobile breadcrumb-header justify-content-between">
	<div class="left-content mt-2">
<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i> Adicionar <?php echo ucfirst($pag); ?></a>

<a class="btn btn-success botao_rel" style="position:absolute; right:40px" href="rel/servicos_class.php" target="_blank">Relatório</a>


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

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>


<input type="hidden" id="ids">

<!-- Modal  -->
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
								<input type="text" autofocus class="form-control" id="nome" name="nome"  placeholder="Nome Serviço" required>							
						</div>

						<div class="col-md-4 col-6">							
								<label>Valor</label>
								<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" placeholder="" >							
						</div>

						
						
					</div>


					<div class="row">

						<div class="col-md-6 col-6">							
								<label>Comissão %</label>
								<input type="number" class="form-control" id="comissao" name="comissao" placeholder="Se Diferente do Padrão"  >							
						</div>

						

						<div class="col-md-6 col-6">							
								<label>Dias Previsão</label>
								<input type="number" class="form-control" id="dias" name="dias" placeholder="Previsão do Serviço"  >							
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




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
			
		const modalForm = document.getElementById('modalForm')
		const nome = document.getElementById('nome')

		modalForm.addEventListener('shown.bs.modal', () => {
  	nome.focus()
	})
		</script>
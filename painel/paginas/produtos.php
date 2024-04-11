<?php 
$pag = 'produtos';

//verificar se ele tem a permissão de estar nessa página
if(@$produtos == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
 ?>

<div class="breadcrumb-header justify-content-between">
 	<div class="left-content mt-2">
<form method="POST" action="rel/produtos_class.php" target="_blank">
<a class="btn ripple btn-primary text-white" onclick="inserir()" type="button"><i class="fe fe-plus me-2"></i> Adicionar <?php echo ucfirst($pag); ?></a>

<select class="form-control sel30" name="categoria" id="busca" style="width:180px" onchange="buscar()">
	<option value="">Buscar por Categoria</option>
								  <?php 
								  	$query = $pdo->query("SELECT * from categorias order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){ ?>
											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } } ?>
</select>				

<button type="submit" class="btn btn-success botao_rel" >Relatório</button>


<!-- BOTÃO EXCLUIR SELEÇÃO -->
			<div class="dropdown" style="display: inline-block;">                      
                        <a href="#" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown" class="btn btn-danger dropdown" id="btn-deletar" style="display:none"><i class="fe fe-trash-2"></i> Deletar</a>
                  <div  class="dropdown-menu tx-13">
                      <div style="width: 240px; padding:15px 5px 0 10px;" class="dropdown-item-text">
                        <p>Excluir Selecionados? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
                      </div>
                  </div>
             </div>
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


<input type="hidden" id="ids">

<!-- Modal Produtios -->
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
						<div class="col-md-4 mb-2">							
								<label>Código</label>
								<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código de Barras" onkeyup="gerarCodigo()">							
						</div>
						<div class="col-md-8">						
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>					
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 mb-2 col-6">						
								<label>Categoria</label>
								<select class="form-select sel2" name="categoria" id="categoria" style="width:100%" required>
									<option value="">Selecione a Categoria</option>
								  <?php 
								  	$query = $pdo->query("SELECT * from categorias where ativo = 'Sim' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){ ?>
											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } } ?>
								</select>						
						</div>

							<div class="col-md-6 col-6">						
								<label>Sub Categoria</label>
								<select class="form-select sel2" name="sub_categoria" id="sub_categoria" style="width:100%">
									<option value="">Sub Categoria</option>
								  <?php 
								  	$query = $pdo->query("SELECT * from sub_categorias where ativo = 'Sim' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$linhas = @count($res);
									if($linhas > 0){
										for($i=0; $i<$linhas; $i++){ ?>
											<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>
									<?php } } ?>
								</select>						
							</div>

					
					</div>


					<div class="row">
						<div class="col-md-3 mb-2 col-6">	
							<label>Valor Compra</label>
								<input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor Compra" >	
						</div>

						<div class="col-md-3 mb-2 col-6">	
							<label>Valor Venda</label>
								<input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor Venda" required>	
						</div>

						<div class="col-md-3 col-6">	
							<label>Quantidade</label>
								<input type="number" class="form-control" id="estoque" name="estoque" placeholder="Quantidade" <?php if($nivel_usuario != 'Administrador'){ ?> readonly <?php } ?>>	
						</div>

						<div class="col-md-3 col-6">	
							<label>Nível Estoque</label>
								<input type="number" class="form-control" id="nivel_estoque" name="nivel_estoque" placeholder="Nível Mínimo" >	
						</div>
					</div>

						<div class="row">
						<div class="col-md-8">							
								<label>Foto</label>
								<input type="file" class="form-control" id="foto" name="foto" onchange="carregarImg()">							
						</div>

						<div class="col-md-4">						
							<img src=""  width="80px" id="target">
						</div>

						
					</div>


					<div id="listar-codigo"></div>


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






<!-- Modal Saida-->
<div class="modal fade" id="modalSaida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_saida"></span></h4>
				<button id="btn-fechar-saida" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<form id="form-saida">

				<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								
								<input type="number" class="form-control" id="quantidade_saida" name="quantidade_saida" placeholder="Quantidade Saída" required>    
							</div> 	
						</div>

						<div class="col-md-5">
							<div class="form-group">								
								<input type="text" class="form-control" id="motivo_saida" name="motivo_saida" placeholder="Motivo Saída" required>    
							</div> 	
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Salvar</button>
						
						</div>
					</div>	
				
				<input type="hidden" id="id_saida" name="id">
				<input type="hidden" id="estoque_saida" name="estoque">

				</form>

				<br>
					<small><div id="mensagem-saida" align="center"></div></small>
			</div>

			
		</div>
	</div>
</div>





<!-- Modal Entrada-->
<div class="modal fade" id="modalEntrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_entrada"></span></h4>
				<button id="btn-fechar-entrada" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<form id="form-entrada">

				<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								
								<input type="number" class="form-control" id="quantidade_entrada" name="quantidade_entrada" placeholder="Quantidade Entrada" required>    
							</div> 	
						</div>

						<div class="col-md-5">
							<div class="form-group">								
								<input type="text" class="form-control" id="motivo_entrada" name="motivo_entrada" placeholder="Motivo Entrada" required>    
							</div> 	
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-primary">Salvar</button>
						
						</div>
					</div>	
				
				<input type="hidden" id="id_entrada" name="id">
				<input type="hidden" id="estoque_entrada" name="estoque">

				</form>

				<br>
					<small><div id="mensagem-entrada" align="center"></div></small>
			</div>

			
		</div>
	</div>
</div>

<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>
			
			<div class="modal-body">
				<small>
				<div class="row" style="margin-top: 0px">
					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Codigo: </b></span><span id="codigo_dados"></span>
					</div>

					
					<div class="col-md-7" style="margin-bottom: 5px">
						<span><b>Categoria: </b></span><span id="categoria_dados"></span>
					</div>

						
					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Sub Categoria: </b></span><span id="sub_categoria_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Valor Compra: </b></span><span id="compra_dados"></span>
					</div>

				

					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Valor Venda: </b></span><span id="venda_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Estoque: </b></span><span id="estoque_dados"></span>
					</div>


					<div class="col-md-5" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>


					<div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="200px"></div>
					</div>


					
				</div>
			</small>
				<div id="listar_debitos" style="margin-top: 15px">

				</div>
			</div>
					
		</div>
	</div>
</div>





<!-- Modal etiquetas -->
<div class="modal fade" id="modalEtiquetas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo-etiquetas"></span></h4>
				<button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
			</div>

			<form action="barras/barcode.php" method="post" target="_blank">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-8">							
								<label>Quantidade Gerada</label>
								<input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade de etiquetas" required >							
						</div>

						<div class="col-md-4">							
								<button type="submit" class="btn btn-primary" style="margin-top: 25px">Gerar Etiquetas</button>					
						</div>

					</div>

						

					<input type="hidden" name="id" id="id-etiqueta">
					<input type="hidden" name="codigo" id="codigo-etiqueta">
					<input type="hidden" name="valor" id="valor-etiqueta">
					<input type="hidden" name="nome" id="nome-etiqueta">
				

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>


		
			</form>
		</div>
	</div>
</div>





<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	$(document).ready(function() {


		$('.sel30').select2({
			
		});

	
		
    $('.sel2').select2({
    	dropdownParent: $('#modalForm')
    });

    $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });	

    $('.sel3').select2({
    	dropdownParent: $('#modalComprar')
    });

     $('.sel4').select2({
    	dropdownParent: $('#modalEntrada')
    });

      $('.sel5').select2({
    	dropdownParent: $('#modalSaida')
    });

      $('.sel6').select2({
    });
});
</script>


<script type="text/javascript">
	function carregarImg() {
    var target = document.getElementById('target');
    var file = document.querySelector("#foto").files[0];
    
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
	

$("#form-saida").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/saida.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-saida').text('');
            $('#mensagem-saida').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-saida').click();
                listar();          

            } else {

                $('#mensagem-saida').addClass('text-danger')
                $('#mensagem-saida').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>





 <script type="text/javascript">
	

$("#form-entrada").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/entrada.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-entrada').text('');
            $('#mensagem-entrada').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-entrada').click();
                listar();          

            } else {

                $('#mensagem-entrada').addClass('text-danger')
                $('#mensagem-entrada').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


function buscar(){
	var busca = $('#busca').val();
	listar(busca)
}
</script>

<script type="text/javascript">
	function gerarCodigo(){
		var codigo = $('#codigo').val();

		
		    $.ajax({
		        url: 'paginas/' + pag + "/gerar-codigo.php",
		        method: 'POST',
		        data: {codigo},
		        dataType: "html",

		        success:function(result){
		            $("#listar-codigo").html(result);
		           
		        }
		    });
		
	}
</script>



<!-- Auto Foco no campo da modal -->
<script type="text/javascript">
			
		const modalForm = document.getElementById('modalForm')
		const codigo = document.getElementById('codigo')

		modalForm.addEventListener('shown.bs.modal', () => {
  	codigo.focus()
	})


	
		</script>
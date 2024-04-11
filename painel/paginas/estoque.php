<?php 
$pag = 'estoque';

//verificar se ele tem a permissão de estar nessa página
if(@$estoque == 'ocultar'){
    echo "<script>window.location='index.php'</script>";
    exit();
}
 ?>

<div class="bs-example widget-shadow margem_mobile" style="padding:15px; margin-top: 30px"  id="listar">

</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	$(document).ready( function () {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});

		$('.sel3').select2({
			
		});
	});
</script>

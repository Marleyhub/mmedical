<?php 
require_once("../../../conexao.php");
$pagina = 'clientes';

$valor = @$_POST['valor'];

echo '<select class="sel2" name="cliente" id="cliente" style="width:100%;" required>';

if($valor == ""){
	echo '<option value="">Selecionar Cliente</option>';
}

$query = $pdo->query("SELECT * FROM clientes order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i < @count($res); $i++){
	foreach ($res[$i] as $key => $value){}

	echo '<option value="'.$res[$i]['id'].'">'.$res[$i]['nome'].' - '.$res[$i]['cpf'].'</option>';

}

echo '</select>';

?>


	<script type="text/javascript">
			$(document).ready(function() {				
				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});
			});
	</script>
<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];


$home = 'ocultar';
$configuracoes = 'ocultar';
$orcamentos = 'ocultar';
$vendas = 'ocultar';
$nova_os = 'ocultar';

//grupo pessoas
$usuarios = 'ocultar';
$funcionarios = 'ocultar';
$clientes = 'ocultar';
$fornecedores = 'ocultar';



//grupo cadastros
$servicos = 'ocultar';
$frequencias = 'ocultar';
$cargos = 'ocultar';
$formas_pgto = 'ocultar';
$acessos = 'ocultar';
$grupos = 'ocultar';


//grupo produtos
$produtos = 'ocultar';
$categorias = 'ocultar';
$sub_categorias = 'ocultar';
$estoque = 'ocultar';
$saidas = 'ocultar';
$entradas = 'ocultar';
$equipamento = 'ocultar';
$marca = 'ocultar';
$modelo = 'ocultar';


//grupo financeiro
$rel_financeiro = 'ocultar';
$compras = 'ocultar';
$pagar = 'ocultar';
$receber = 'ocultar';
$rel_lucro = 'ocultar';
$lista_vendas = 'ocultar';
$comissoes = 'ocultar';


//os
$os = 'ocultar';
$os_status = 'ocultar';
$os_tecnico = 'ocultar';


$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];

		if($chave == 'home'){
			$home = '';
		}


		if($chave == 'configuracoes'){
			$configuracoes = '';
		}


		if($chave == 'orcamentos'){
			$orcamentos = '';
		}


		if($chave == 'vendas'){
			$vendas = '';
		}

		if($chave == 'nova_os'){
			$nova_os = '';
		}


		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'funcionarios'){
			$funcionarios = '';
		}

		if($chave == 'clientes'){
			$clientes = '';
		}

		
		if($chave == 'fornecedores'){
			$fornecedores = '';
		}



		if($chave == 'servicos'){
			$servicos = '';
		}

		if($chave == 'frequencias'){
			$frequencias = '';
		}

		if($chave == 'cargos'){
			$cargos = '';
		}

		
		if($chave == 'formas_pgto'){
			$formas_pgto = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}


		if($chave == 'grupos'){
			$grupos = '';
		}


		if($chave == 'produtos'){
			$produtos = '';
		}

		if($chave == 'categorias'){
			$categorias = '';
		}

		if($chave == 'sub_categorias'){
			$sub_categorias = '';
		}

		if($chave == 'estoque'){
			$estoque = '';
		}

		if($chave == 'saidas'){
			$saidas = '';
		}

		if($chave == 'entradas'){
			$entradas = '';
		}

		if($chave == 'equipamento'){
			$equipamento = '';
		}

		if($chave == 'marca'){
			$marca = '';
		}

		if($chave == 'modelo'){
			$modelo = '';
		}



		if($chave == 'compras'){
			$compras = '';
		}

		if($chave == 'rel_financeiro'){
			$rel_financeiro = '';
		}

		if($chave == 'pagar'){
			$pagar = '';
		}

		if($chave == 'receber'){
			$receber = '';
		}

		if($chave == 'rel_lucro'){
			$rel_lucro = '';
		}

	
		if($chave == 'lista_vendas'){
			$lista_vendas = '';
		}

		if($chave == 'comissoes'){
			$comissoes = '';
		}




		if($chave == 'os'){
			$os = '';
		}


		if($chave == 'os_status'){
			$os_status = '';
		}

		if($chave == 'os_tecnico'){
			$os_tecnico = '';
		}


		
		
	}

}


$pag_inicial = '';
if($home != 'ocultar'){
	$pag_inicial = 'home';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);	
	if($total_reg > 0){
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pag_inicial = $res2[0]['chave'];		

	}else{
		echo 'Você não tem permissão para acessar nenhuma página, acione o administrador!';
		echo "<script>localStorage.setItem('id_usu', '')</script>";
		exit();
	}
}



if($usuarios == 'ocultar' and $funcionarios == 'ocultar' and $clientes == 'ocultar' and $fornecedores == 'ocultar'){
	$menu_pessoas = 'ocultar';
}else{
	$menu_pessoas = '';
}



if($servicos == 'ocultar' and $cargos == 'ocultar' and $frequencias == 'ocultar' and $grupos == 'ocultar' and $acessos == 'ocultar' and $formas_pgto == 'ocultar'){
	$menu_cadastros = 'ocultar';
}else{
	$menu_cadastros = '';
}


if($produtos == 'ocultar' and $categorias == 'ocultar' and $sub_categorias == 'ocultar' and $equipamento == 'ocultar' and $marca == 'ocultar' and $modelo == 'ocultar' and $estoque == 'ocultar' and $saidas == 'ocultar' and $entradas == 'ocultar'){
	$menu_produtos = 'ocultar';
}else{
	$menu_produtos = '';
}



if($compras == 'ocultar' and $rel_financeiro == 'ocultar' and $pagar == 'ocultar' and $receber == 'ocultar' and $rel_lucro == 'ocultar' and $lista_vendas == 'ocultar' and $comissoes == 'ocultar'){
	$menu_financeiro = 'ocultar';
}else{
	$menu_financeiro = '';
}




if($os == 'ocultar' and $os_status == 'ocultar' and $os_tecnico == 'ocultar' ){
	$menu_os = 'ocultar';
}else{
	$menu_os = '';
}



 ?>
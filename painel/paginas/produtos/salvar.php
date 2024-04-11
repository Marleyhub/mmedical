<?php 
$tabela = 'produtos';
require_once("../../../conexao.php");

$codigo = $_POST['codigo'];
$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$sub_categoria = $_POST['sub_categoria'];
$valor_compra = $_POST['valor_compra'];
$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$estoque = $_POST['estoque'];
$nivel_estoque = $_POST['nivel_estoque'];
$id = $_POST['id'];
 
//validar codigo
if($codigo != ""){
	$query = $pdo->query("SELECT * from $tabela where codigo = '$codigo'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0 and $id != $res[0]['id']){
		echo 'Código já Cadastrado, escolha outro!!';
		exit();
	}
}

$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = str_replace(',', '.', $valor_venda);

//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}

//validacao nome
$query = $pdo->query("SELECT * from $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Produto já Existe!';
	exit();
}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../images/produtos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'webp'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/produtos/'.$foto);
			}

			$foto = $nome_img;
		
			move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET codigo = :codigo, nome = :nome, categoria = :categoria, sub_categoria = :sub_categoria, valor_compra = :valor_compra, valor_venda = :valor_venda, estoque = :estoque, nivel_estoque = :nivel_estoque, foto = '$foto', ativo = 'Sim' ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET codigo = :codigo, nome = :nome, categoria = :categoria, sub_categoria = :sub_categoria, valor_compra = :valor_compra, valor_venda = :valor_venda, estoque = :estoque, nivel_estoque = :nivel_estoque, foto = '$foto' where id = '$id'");
}
$query->bindValue(":codigo", "$codigo");
$query->bindValue(":nome", "$nome");
$query->bindValue(":categoria", "$categoria");
$query->bindValue(":sub_categoria", "$sub_categoria");
$query->bindValue(":valor_compra", "$valor_compra");
$query->bindValue(":valor_venda", "$valor_venda");
$query->bindValue(":estoque", "$estoque");
$query->bindValue(":nivel_estoque", "$nivel_estoque");
$query->execute();

echo 'Salvo com Sucesso';

 ?>
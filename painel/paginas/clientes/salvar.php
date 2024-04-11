<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$telefone2 = $_POST['telefone2'];
$telefone = $_POST['telefone'];
$pessoa = $_POST['pessoa'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$id = $_POST['id'];
$email = @$_POST['email'];
$nome2 = @$_POST['nome2'];
$apelido = @$_POST['apelido'];



$senha = '123';
$senha_crip = md5($senha);

//validacao email
if($email != ""){
	$query = $pdo->query("SELECT * from $tabela where email = '$email'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$id_reg = @$res[0]['id'];
	if(@count($res) > 0 and $id != $id_reg){
		echo 'Email já Cadastrado!';
		exit();
	}
}

//validacao cpf
if($cpf != ""){
	$query = $pdo->query("SELECT * from $tabela where cpf = '$cpf'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$id_reg = @$res[0]['id'];
	if(@count($res) > 0 and $id != $id_reg){
		echo 'CPF já Cadastrado!';
		exit();
	}
}

//validacao telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}



if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, telefone = :telefone, pessoa = '$pessoa', telefone2 = :telefone2, data = curDate(), endereco = :endereco, cpf = :cpf, email = :email, nome2 = :nome2, apelido = :apelido ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, telefone = :telefone, pessoa = '$pessoa', telefone2 = :telefone2, endereco = :endereco, cpf = :cpf, email = :email, nome2 = :nome2, apelido = :apelido where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone2", "$telefone2");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":email", "$email");
$query->bindValue(":nome2", "$nome2");
$query->bindValue(":apelido", "$apelido");
$query->execute();

if($id == ""){
$ult_id = $pdo->lastInsertId();
$query = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, senha = '$senha', senha_crip = '$senha_crip', nivel = 'Cliente', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = :telefone, data = curDate(), endereco = :endereco, id_ref = '$ult_id'");

}else{
	$ult_id = $id ;
	$query = $pdo->prepare("UPDATE usuarios SET nome = :nome,  telefone = :telefone, endereco = :endereco where id_ref = '$ult_id' and nivel = 'Cliente' ");
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->execute();
echo 'Salvo com Sucesso';



//api whats
if($api_whatsapp == 'Sim' and $id == ""){
	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
	
	
	$mensagem = '*Você foi Cadastrado na Empresa '.$nome_sistema.'* %0A';
		$mensagem .= 'Nome: *'.$nome.'* %0A';
		$mensagem .= 'Telefone: *'.$telefone.'* %0A';
		$mensagem .= 'Senha: *'.$senha.'* %0A%0A';
		$mensagem .= '_Use seu telefone e sua senha para acesso, após acessar seu painel, troque a senha para uma de sua preferência!_ %0A';
		$mensagem .= 'Site: *'.$url_sistema.'* %0A%0A';


		if($instagram_sistema > 0){
		$mensagem .= 'Siga nosso Instagram: *https://www.instagram.com/'.$instagram_sistema.'* %0A%0A';
		}

	require('../../../apis/api_texto.php');
}

 ?>

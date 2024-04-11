<?php 
@session_start();
require_once("conexao.php");

$id_usu = @$_POST['id'];
$pagina = @$_POST['pagina'];
if($id_usu != ""){

	$query = $pdo->prepare("SELECT * from usuarios where id = :id");
	$query->bindValue(":id", "$id_usu");
	$query->execute();
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$linhas = @count($res);
	if($linhas > 0){

	$_SESSION['nome'] = $res[0]['nome'];
	$_SESSION['id'] = $res[0]['id'];
	$_SESSION['nivel'] = $res[0]['nivel'];

	if($pagina == ""){
		echo '<script>window.location="painel"</script>';  
	}else{
		echo '<script>window.location="painel/'.$pagina.'"</script>';  
	}
	
	}else{
		echo "<script>localStorage.setItem('id_usu', '')</script>";
		echo '<script>window.location="index.php"</script>';
	}
}

$usuario = @$_POST['usuario'];
$senha = @$_POST['senha'];
$salvar = @$_POST['salvar'];
$senha_crip = md5($senha);

function Mask($mask,$str){

    @$str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        @$mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}

$usuario2 = Mask("(##) #####-####",$usuario);


$query = $pdo->prepare("SELECT * from usuarios where (email = :email or telefone = :usuario2 or telefone = :email) and senha_crip = :senha");
$query->bindValue(":email", "$usuario");
$query->bindValue(":senha", "$senha_crip");
$query->bindValue(":usuario2", "$usuario2");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

if($linhas > 0){

	if($res[0]['ativo'] != 'Sim'){
		$_SESSION['msg'] = 'Seu Acesso foi desativado!'; 
		echo '<script>window.location="receber.php"</script>';  
	}


	$id = $res[0]['id'];
	$email = $res[0]['email'];


	//armazenar no storage o id e o nivel
	echo "<script>localStorage.setItem('id_usu', '$id')</script>";
	echo "<script>localStorage.setItem('email_empresa', '$email')</script>";

	$_SESSION['nome'] = $res[0]['nome'];
	$_SESSION['id'] = $res[0]['id'];
	$_SESSION['nivel'] = $res[0]['nivel'];
	$_SESSION['id_ref'] = $res[0]['id_ref'];
	$id = $res[0]['id'];

	if($salvar == 'Sim'){
		echo "<script>localStorage.setItem('email_usu', '$usuario')</script>";
		echo "<script>localStorage.setItem('senha_usu', '$senha')</script>";
		echo "<script>localStorage.setItem('id_usu', '$id')</script>";
	}else{
		echo "<script>localStorage.setItem('email_usu', '')</script>";
		echo "<script>localStorage.setItem('senha_usu', '')</script>";
		echo "<script>localStorage.setItem('id_usu', '')</script>";
	}


	if($_SESSION['nivel'] == 'Cliente'){
		echo '<script>window.location="painel_cliente"</script>';
	}else{
		echo '<script>window.location="painel"</script>';
	}

	
	
}else{
	$_SESSION['msg'] = 'Dados Incorretos!'; 
	echo '<script>window.location="index.php"</script>';  
}


 ?>

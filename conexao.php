<?php 

//definir fuso horário
date_default_timezone_set('America/Sao_Paulo');
 

//dados conexão bd local
$servidor = 'localhost';
$banco = 'assistec';
$usuario = 'root';
$senha = '';

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
		echo 'Erro ao conectar ao banco de dados!<br>';
	//echo $e;
}

// PEGAR URL AUTOMÁTICAMENTE PARA PDF
$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/assistec/";
}




//variaveis globais
$nome_sistema = 'Assistec';
$email_sistema = 'contato@hugocursos.com.br';
$telefone_sistema = '(11)97050-4731';


$query = $pdo->query("SELECT * from config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'logo.png', logo_rel = 'logo.jpg', icone = 'icone.png', validade_orcamento = '7', excluir_orcamentos = '60', comissao_geral = 50, api_whatsapp = 'Não', marca_dagua = 'Sim', impressao_automatica = 'Não', fonte_comprovante = '12', dias_comissao = '7', cobranca_auto = 'Sim', duas_vias_os = 'Sim', msg_rodape = 'É UMA GRANDE SATISFAÇÃO TER VOCÊ COMO NOSSO CLIENTE, VOLTE SEMPRE!', garantia = 'Garantia', termos = 'Termos', logo_painel = 'logo_painel.png', ativo = 'Sim");
}else{
$nome_sistema = $res[0]['nome'];
$email_sistema = $res[0]['email'];
$telefone_sistema = $res[0]['telefone'];
$endereco_sistema = $res[0]['endereco'];
$instagram_sistema = $res[0]['instagram'];
$logo_sistema = $res[0]['logo'];
$logo_rel = $res[0]['logo_rel'];
$icone_sistema = $res[0]['icone'];
$validade_orcamento = $res[0]['validade_orcamento'];
$excluir_orcamentos = $res[0]['excluir_orcamentos'];
$comissao_geral = $res[0]['comissao_geral'];
$api_whatsapp = $res[0]['api_whatsapp'];
$token = $res[0]['token'];
$instancia = $res[0]['instancia'];
$chave_pix = $res[0]['chave_pix'];
$marca_dagua = $res[0]['marca_dagua'];
$impressao_automatica = $res[0]['impressao_automatica'];
$fonte_comprovante = $res[0]['fonte_comprovante'];
$cnpj_sistema = $res[0]['cnpj'];
$dias_comissao = $res[0]['dias_comissao'];
$cobranca_auto = $res[0]['cobranca_auto'];
$data_cobranca = $res[0]['data_cobranca'];
$duas_vias_os = $res[0]['duas_vias_os'];
$msg_rodape = $res[0]['msg_rodape'];
$garantia = $res[0]['garantia'];
$termos = $res[0]['termos'];
$logo_painel = $res[0]['logo_painel'];
$ativo_sistema = $res[0]['ativo'];
$entrar_automatico = $res[0]['entrar_automatico'];
$mostrar_preloader = $res[0]['mostrar_preloader'];

$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);


if($ativo_sistema != 'Sim' and $ativo_sistema != ''){ ?>
	<style type="text/css">
		@media only screen and (max-width: 700px) {
		  .imgsistema_mobile{
		    width:300px;
		  }    
		}
	</style>
	<div style="text-align: center; margin-top: 100px">
	<img src="<?php echo $url_sistema ?>img/bloqueio.png" class="imgsistema_mobile">	
	</div>
<?php 
exit();
} 


}	
 ?>

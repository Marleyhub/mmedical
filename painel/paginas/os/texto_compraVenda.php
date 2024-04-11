<?php 
$tabela = 'config'; 
require_once("../../../conexao.php");

 
$data_hoje = date('Y-m-d');
$data_hojeF = implode('/', array_reverse(explode('-', $data_hoje)));

$data_2anos = date('Y-m-d', strtotime("+2 years",strtotime($data_hoje)));
$data_2anosF = implode('/', array_reverse(explode('-', $data_2anos)));

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_extenso = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$query = $pdo->query("SELECT * from config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

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
 

if($cnpj_sistema != ""){
    $texto_cnpj = 'inscrita no CNPJ '.$cnpj_sistema;
}else{
    $texto_cnpj = 'inscrito no CPF '.$cpf;
}


echo <<<HTML

<div style="margin-top: 10px">
<center><h4><b>RECIBO DE COMPRA DE APARELHO</b></h4></center><br>
</div>
<div style="padding: 10px;">



<P>R$ ____________ (valor por extenso).</P><br>
<P>(nome completo do vendedor), (CPF ou RG), residentes e domiciliados á Rua: ________________________, Nº: _______, Cidade: ___________________________, Estado:  ___________________, aqui chamados simplesmente de <b>VENDEDOR</b>.</P><br> 


<p>Declara, pelo presente instrumento, que recebeu, nesta data de <b>{$data_hojeF}</b>, da Empresa <b>{$nome_sistema}</b>, $texto_cnpj, Empresa estabelecida no Endereço: {$endereco_sistema}. aqui chamados simplesmente de <b>COMPRADOR.</b><br><br> 

O valor de (Digite o Valor), à vista, referente a COMPRA do telefone celular Marca:__________ Modelo: ____________ IMEI: __________  Serial: __________________________.<br><br>


  <p><b>Senha de acesso:</b> _______________________.<br><br>
 


  <p>Livre e desimpedido de qualquer ônus, senhas e vínculos de operadora.</p><br>
<p>Através deste Recibo, o <b>VENDEDOR</b> da plena e total quitação aos <b>COMPRADOR</b> que declaram nada mais ter a receber por parte do <b>VENDEDOR</b>.<br><br><br>



<div align="center">
São Paulo, {$data_extenso}.
</div>
<br><br><br>


<div align="center">
____________________________________________________________________________<br>
ASSINATURAS VENDEDOR 
</div>
<br><br>



<div align="center">
____________________________________________________________________________<br>
TESTEMUNHA 1
</div>
<br><br>

<div align="center">
____________________________________________________________________________<br>
TESTEMUNHA 2
</div>


</div>
HTML;

?>
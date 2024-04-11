<?php 
@session_start();
require_once("../conexao.php");


$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";


$data_inicio_mes = $ano_atual."-".$mes_atual."-01";
$data_inicio_ano = $ano_atual."-01-01";

if($mes_atual == '04' || $mes_atual == '06' || $mes_atual == '09' || $mes_atual == '11'){
	$data_final_mes = $ano_atual.'-'.$mes_atual.'-30';
}else if($mes_atual == '02'){
	$data_final_mes = $ano_atual.'-'.$mes_atual.'-28';
}else{
	$data_final_mes = $ano_atual.'-'.$mes_atual.'-31';
}


if(@$_GET['pagina'] != ""){
	$pagina = @$_GET['pagina'];
}else{
	$pagina = 'pagar';
}

$id_usuario = @$_SESSION['id'];
$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$nome_usuario = $res[0]['nome'];
	$email_usuario = $res[0]['email'];
	$telefone_usuario = $res[0]['telefone'];
	$senha_usuario = $res[0]['senha'];
	$nivel_usuario = $res[0]['nivel'];
	$foto_usuario = $res[0]['foto'];
	$endereco_usuario = $res[0]['endereco'];
}

?>
<!DOCTYPE HTML>
<html lang="pt-BR" dir="ltr">
	
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		

		<meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="Description" content="Fluxo Comunicação Inteligente">
        <meta name="Author" content="Samuel Lima">
        <meta name="Keywords" content="fluxo, comunicacao, inteligente, marketing, whatsapp"/>

		<title><?php echo $nome_sistema ?></title>

		<link rel="icon" href="../img/icone.png" type="image/x-icon"/>
		<link href="../assets/css/icons.css" rel="stylesheet">
		<link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/style.css" rel="stylesheet">
		<link href="../assets/css/style-dark.css" rel="stylesheet">
		<link href="../assets/css/style-transparent.css" rel="stylesheet">
		<link href="../assets/css/skin-modes.css" rel="stylesheet" />
		<link href="../assets/css/animate.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link href="../assets/css/custom.css" rel="stylesheet" />
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/modernizr.custom.js"></script>	

		<!-- fontawesome-->
	<link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">	


		


	</head>

	<body class="ltr main-body app sidebar-mini">



		<!-- Page -->
		<div class="page">

			<div>
				<!-- APP-HEADER1 -->
				<div class="main-header side-header sticky nav nav-item">
						<div class=" main-container container-fluid">
							<div class="main-header-left ">
								<div class="responsive-logo">
									<a href="index.php" class="header-logo">
										<img src="../img/logo_painel.png" class="mobile-logo logo-1" alt="logo" style="width:40% !important">
										<img src="../img/logo_painel.png" class="mobile-logo dark-logo-1" alt="logo" style="width:40% !important">
									</a>
								</div>
								<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
									<a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left" ></i></a>
									<a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
								</div>
								<div class="logo-horizontal">
									<a href="index.php" class="header-logo">
										<img src="../img/logo_painel.png" class="mobile-logo logo-1" alt="logo">
										<img src="../img/logo_painel.png" class="mobile-logo dark-logo-1" alt="logo">
									</a>
								</div>
								<div class="main-header-center ms-4 d-sm-none d-md-none d-lg-block form-group">
									
								</div>
							</div>
							<div class="main-header-right">
								<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon fe fe-more-vertical "></span>
								</button>
								<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
									<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
										<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
								
											<li class="dropdown nav-item">
												<a class="new nav-link theme-layout nav-link-bg layout-setting" >
													<span class="dark-layout">
														<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M20.742 13.045a8.088 8.088 0 0 1-2.077.271c-2.135 0-4.14-.83-5.646-2.336a8.025 8.025 0 0 1-2.064-7.723A1 1 0 0 0 9.73 2.034a10.014 10.014 0 0 0-4.489 2.582c-3.898 3.898-3.898 10.243 0 14.143a9.937 9.937 0 0 0 7.072 2.93 9.93 9.93 0 0 0 7.07-2.929 10.007 10.007 0 0 0 2.583-4.491 1.001 1.001 0 0 0-1.224-1.224zm-2.772 4.301a7.947 7.947 0 0 1-5.656 2.343 7.953 7.953 0 0 1-5.658-2.344c-3.118-3.119-3.118-8.195 0-11.314a7.923 7.923 0 0 1 2.06-1.483 10.027 10.027 0 0 0 2.89 7.848 9.972 9.972 0 0 0 7.848 2.891 8.036 8.036 0 0 1-1.484 2.059z"/></svg></span>
													<span class="light-layout">
														<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24">
															<path d="M6.993 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007S14.761 6.993 12 6.993 6.993 9.239 6.993 12zM12 8.993c1.658 0 3.007 1.349 3.007 3.007S13.658 15.007 12 15.007 8.993 13.658 8.993 12 10.342 8.993 12 8.993zM10.998 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2h-3zm17 0h3v2h-3zM4.219 18.363l2.12-2.122 1.415 1.414-2.12 2.122zM16.24 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.342 7.759 4.22 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"/>
														</svg>
													</span>
												</a>
											</li>

							
									
											
											<li class="nav-item full-screen fullscreen-button">
												<a class="new nav-link full-screen-link" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"/></svg></a>
											</li>
						
											<li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
												<a class="new nav-link profile-user d-flex" href="#" data-bs-toggle="dropdown"><img src="images/perfil/<?php echo $foto_usuario ?>"></a>
												<div class="dropdown-menu">
													<div class="menu-header-content p-3 border-bottom">
														<div class="d-flex wd-100p">
															<div class="main-img-user"><img src="images/perfil/<?php echo $foto_usuario ?>"></div>
															<div class="ms-3 my-auto">
																<h6 class="tx-15 font-weight-semibold mb-0"><?php echo $nome_usuario ?></h6><span class="dropdown-title-text subtext op-6  tx-12"><?php echo $nivel_usuario ?></span>
															</div>
														</div>
													</div>
													<a class="dropdown-item" href="" data-bs-target="#modalPerfil" data-bs-toggle="modal"><i class="fa fa-user"></i>Perfil</a>	
												
													<a class="dropdown-item" href="logout.php"><i class="fa fa-arrow-left"></i> Sair</a>
												</div>
											</li>
										</ul>
									</div>
								</div>
							
							</div>
						</div>
					</div>


				<!--PAINEL LATERAL-->
				<div class="sticky">
					<aside class="app-sidebar">
						<div class="main-sidebar-header active">
							<a class="header-logo active" href="index.php">
								<img src="../img/logo_painel.png" class="main-logo  desktop-logo" alt="logo">
								<img src="../img/logo_painel.png" class="main-logo  desktop-dark" alt="logo">
								<img src="../img/icone.png" class="main-logo  mobile-logo" alt="logo">
								<img src="../img/icone.png" class="main-logo  mobile-dark" alt="logo">
							</a>
						</div>
						<div class="main-sidemenu">
							<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
							<ul class="side-menu">

						

		

								<li class="slide ">
									<a class="side-menu__item" data-bs-toggle="slide" href="index.php"><i class="fa fa-usd text-white mt-1"></i>
										<span class="side-menu__label" style="margin-left: 15px">Meus Pagamentos</span></a>
								
								</li>


								<li class="slide ">
									<a class="side-menu__item" href="orcamentos.php">
										<i class="fa fa-pencil text-white"></i>
										<span class="side-menu__label" style="margin-left: 15px">Meus Orçamentos</span></a>
								</li>

								<li class="slide ">
									<a class="side-menu__item" href="os.php">
										<i class="fa fa-sun-o text-white"></i>
										<span class="side-menu__label" style="margin-left: 15px">Meus Serviços</span></a>
								</li>


				


						
							
			
								
							</ul>
							<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
						</div>
					</aside>
				</div>				
			</div>

			<!-- MAIN-CONTENT -->
			<div class="main-content app-content">

				<!-- container -->
				<div class="main-container container-fluid">



				<?php 
				require_once('paginas/'.$pagina.'.php');
				?>


				</div>
				<!-- Container closed -->
			</div>
			<!-- MAIN-CONTENT CLOSED -->

				
			






			<!-- FOOTER -->
			<div class="main-footer">
				<div class="container-fluid pt-0 ht-100p">
					 Copyright © <?php echo date('Y'); ?> <a href="javascript:void(0);" class="text-primary">MonielProg</a>. Todos os direitos reservados
				</div>
			</div>			<!-- FOOTER END -->

		</div>
		<!-- End Page -->

		<!-- BUYNOW-MODAL -->
		       
		
	
		<a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>


		<!-- GRAFICOS -->
		<script src="../assets/plugins/chart.js/Chart.bundle.min.js"></script>		
		<script src="../assets/js/apexcharts.js"></script>

		<!--INTERNAL  INDEX JS -->
		<script src="../assets/js/index.js"></script>
	

	
		<script src="../assets/plugins/jquery/jquery.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/plugins/moment/moment.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="../assets/plugins/perfect-scrollbar/p-scroll.js"></script>
		<script src="../assets/js/eva-icons.min.js"></script>
		<script src="../assets/plugins/side-menu/sidemenu.js"></script>
		<script src="../assets/js/sticky.js"></script>
		<script src="../assets/plugins/sidebar/sidebar.js"></script>
		<script src="../assets/plugins/sidebar/sidebar-custom.js"></script>


		<!-- INTERNAL DATA TABLES -->
		<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
		<script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
		<script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
		<script src="../assets/plugins/datatable/js/jszip.min.js"></script>
		<script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
		<script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
		<script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
		<script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
		<script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
		<script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>


		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


		<!-- POPOVER JS -->
		<script src="../assets/js/popover.js"></script>

		<script src="../assets/js/themecolor.js"></script>
		<script src="../assets/js/custom.js"></script>		

		<!--INTERNAL  INDEX JS -->
		<script src="../assets/js/index.js"></script>




		
	</body>

</html>


<!-- Modal Perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header bg-primary text-white">
                            <h4 class="modal-title">Alterar Dados</h4>
                            <button id="btn-fechar" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
                        </div>

			<form id="form-perfil">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6 mb-3">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome_perfil" name="nome" placeholder="Seu Nome" value="<?php echo @$nome_usuario ?>" required>							
						</div>

						<div class="col-md-6 mb-3">							
								<label>Email</label>
								<input type="email" class="form-control" id="email_perfil" name="email" placeholder="Seu Nome" value="<?php echo @$email_usuario ?>" required>							
						</div>
					</div>


					<div class="row">
						<div class="col-md-4 mb-3">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone_perfil" name="telefone" placeholder="Seu Telefone" value="<?php echo @$telefone_usuario ?>" required>							
						</div>

						<div class="col-md-4 mb-3">							
								<label>Senha</label>
								<input type="password" class="form-control" id="senha_perfil" name="senha" placeholder="Senha" value="<?php echo @$senha_usuario ?>" required>							
						</div>

						<div class="col-md-4 mb-3">							
								<label>Confirmar Senha</label>
								<input type="password" class="form-control" id="conf_senha_perfil" name="conf_senha" placeholder="Confirmar Senha" value="" required>							
						</div>

						
					</div>


					<div class="row">
						<div class="col-md-12 mb-3">	
							<label>Endereço</label>
							<input type="text" class="form-control" id="endereco_perfil" name="endereco" placeholder="Seu Endereço" value="<?php echo @$endereco_usuario ?>" >	
						</div>
					</div>
					


					<div class="row">
						<div class="col-md-8 mb-3">							
								<label>Foto</label>
								<input type="file" class="form-control" id="foto_perfil" name="foto" value="<?php echo @$foto_usuario ?>" onchange="carregarImgPerfil()">							
						</div>

						<div class="col-md-4 mb-3">								
							<img src="images/perfil/<?php echo $foto_usuario ?>"  width="80px" id="target-usu">								
							
						</div>

						
					</div>


					<input type="hidden" name="id_usuario" value="<?php echo @$id_usuario ?>">
				

				<br>
				<small><div id="msg-perfil" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>


		<!-- Modal Config -->
	<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
				<div class="modal-header bg-primary text-white">
                            <h4 class="modal-title">Alterar Configurações</h4>
                            <button id="btn-fechar-confug" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
                        </div>
						<form id="form-config">
							<div class="modal-body">


								<div class="row">
									<div class="col-md-5">							
										<label>Nome da Empresa</label>
										<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="Nome de Empresa" value="<?php echo @$nome_sistema ?>" required>							
									</div>

									<div class="col-md-4">							
										<label>Email Sistema</label>
										<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email do Sistema" value="<?php echo @$email_sistema ?>" >							
									</div>

									<div class="col-md-3">							
										<label>Telefone Sistema</label>
										<input type="text" class="form-control" id="telefone_sistema" name="telefone_sistema" placeholder="Telefone do Sistema" value="<?php echo @$telefone_sistema ?>" required>							
									</div>



								</div>


									<div class="row">
									

									<div class="col-md-3">							
										<label>CNPJ</label>
										<input type="text" class="form-control" id="cnpj_sistema"  name="cnpj_sistema" placeholder="CNPJ do Sistema" value="<?php echo @$cnpj_sistema ?>" >							
									</div>


									<div class="col-md-4">	
										<label>Chave Pix</label>
										<input type="text" class="form-control" name="chave_pix" placeholder="CNPJ xxxxxxxxxxxx" value="<?php echo @$chave_pix ?>">		
									</div>

										<div class="col-md-5">							
										<label>Instagram</label>
										<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Instagram" value="<?php echo @$instagram_sistema ?>">							
									</div>

								</div>


								<div class="row">
									<div class="col-md-9">							
										<label>Endereço <small>(Rua Número Bairro e Cidade)</small></label>
										<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X..." value="<?php echo @$endereco_sistema ?>" >							
									</div>

									<div class="col-md-3">	
											<label>Impressão Duas Vias OS</label>
											<select class="form-select" name="duas_vias_os">
												<option <?php if(@$duas_vias_os == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
												<option <?php if(@$duas_vias_os == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
											</select>	
										</div>

								
								</div>



								<div class="row">
									<div class="col-md-3">	
										<label>Validade Orçamento</label>
										<input type="number" class="form-control" id="validade_orcamento" name="validade_orcamento" placeholder="Dias de Validade" value="<?php echo @$validade_orcamento ?>">		
									</div>

									<div class="col-md-3">	
										<label>Excluir Orçamentos</label>
										<input type="number" class="form-control" id="excluir_orcamentos" name="excluir_orcamentos" placeholder="Dias Excluir Pendentes" value="<?php echo @$excluir_orcamentos ?>">		
									</div>

									<div class="col-md-3">	
										<label>Comissão Serviços</label>
										<input type="number" class="form-control" id="comissao_geral" name="comissao_geral" placeholder="Comissão Geral %" value="<?php echo @$comissao_geral ?>">		
									</div>


								</div>




								<div class="row">
									<div class="col-md-3">	
										<label>Api Whatsapp</label>
										<select class="form-select" name="api_whatsapp">
											<option <?php if(@$api_whatsapp == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
											<option <?php if(@$api_whatsapp == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
										</select>	
									</div>

									<div class="col-md-3">	
										<label>Token Api Whatsapp</label>
										<input type="text" class="form-control" name="token" placeholder="Token da API" value="<?php echo @$token ?>">		
									</div>

									<div class="col-md-3">	
										<label>Instância Api Whats</label>
										<input type="text" class="form-control" name="instancia" placeholder="Instância Whatsapp" value="<?php echo @$instancia ?>">		
									</div>

									<div class="col-md-3">	
										<label>Marca D'agua Relatório</label>
										<select class="form-select" name="marca_dagua">
											<option <?php if(@$marca_dagua == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
											<option <?php if(@$marca_dagua == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
										</select>	
									</div>

								</div>


								<div class="row">
									<div class="col-md-3">	
										<label>Impressão Automática</label>
										<select class="form-select" name="impressao_automatica">
											<option <?php if(@$impressao_automatica == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
											<option <?php if(@$impressao_automatica == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
										</select>	
									</div>

									<div class="col-md-3">
										<label>Fonte Comprovante</label>
										<input type="number" class="form-control" name="fonte_comprovante" placeholder="Tamanho da Fonte" value="<?php echo @$fonte_comprovante ?>">		
									</div>

									<div class="col-md-3">
										<label>Dias Comissão</label>
										<input type="number" class="form-control" name="dias_comissao" placeholder="Pag. Comissão" value="<?php echo @$dias_comissao ?>">		
									</div>	

									<div class="col-md-3">
										<label>Cobrança Automática</label>
										<select class="form-select" name="cobranca_auto">
											<option <?php if(@$cobranca_auto == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
											<option <?php if(@$cobranca_auto == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
										</select>	
									</div>
								</div>


 
								<div class="row">

									<div class="col-md-4">						
										<div class="form-group"> 
											<label>Logo (Escura) (*png)</label> 
											<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
										</div>						
									</div>

									<div class="col-md-2">
										<div id="divImg">
											<img src="../img/<?php echo $logo_sistema ?>"  width="80px" id="target-logo" style="background:#f5f5f5; margin-top: 30px;">									
										</div>
									</div>
									<div class="col-md-4">						
										<div class="form-group"> 
											<label>Logo Relatório (Escura) (*Jpg)</label> 
											<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
										</div>						
									</div>
									<div class="col-md-2">
										<div id="divImg">
											<img src="../img/<?php echo @$logo_rel ?>"  width="80px" id="target-logo-rel" style="background:#f5f5f5; margin-top: 30px;">									
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">						
										<div class="form-group"> 
											<label>Logo Painel (Clara) (*Png)</label> 
											<input class="form-control" type="file" name="foto-logo-painel" onChange="carregarImgLogoPainel();" id="foto-logo-painel">
										</div>						
									</div>
									<div class="col-md-2">
										<div id="divImg">
											<img src="../img/<?php echo @$logo_painel ?>"  width="70px"  id="target-logo-painel" style="background:#f5f5f5; margin-top: 30px;">									
										</div>
									</div>

								


									<div class="col-md-4">						
										<div class="form-group"> 
											<label>Ícone (*Png)</label> 
											<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
										</div>						
									</div>
									<div class="col-md-2">
										<div id="divImg">
											<img src="../img/<?php echo $icone_sistema ?>"  width="50px" id="target-icone" style="background:#f5f5f5;">									
										</div>
									</div>

								</div>


					<div class="row">	
						<div class="col-md-12">							
							<label>Mensagem Rodapé</label>

							<div>
							<textarea style="width: 760px; height:200px;" id="msg_rodape" class="textareag" name="msg_rodape" placeholder="Mensagem de Agradecimento"><?php echo @$msg_rodape ?></textarea>
							</div>					
						</div>
					</div>




					<div class="row" >					

						<div class="col-md-12">						
							<div class="form-group"> 
								<label>Garantia</label>
								<div>
								<textarea style="width: 760px; height:280px;" id="garantia" class="textareag" name="garantia" ><?php echo $garantia ?></textarea>
								</div>
							</div>						
						</div>
	
					</div>



					<div class="row">					

						<div class="col-md-12" >						
							<div class="form-group"> 
								<label>Termos</label> 
								<textarea style="width: 760px; height:200px;" id="termos" class="textareag" name="termos"><?php echo $termos ?></textarea>
							</div>						
						</div>
	
					</div>



								<br>
								<small><div id="msg-config" align="center"></div></small>
							</div>
							<div class="modal-footer">       
								<button type="submit" class="btn btn-primary">Salvar</button>
							</div>
						</form>
					</div>
				</div>
			</div>







			<!-- Modal Rel Financeiro -->
			<div class="modal fade" id="modalRelFin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h4 class="modal-title" id="exampleModalLabel">Relatório Financeiro</h4>
							<button id="btn-fechar-rel" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
						</div>
						<form method="POST" action="rel/financeiro_class.php" target="_blank">
							<div class="modal-body">	
								<div class="row">
									<div class="col-md-4">
										<label>Data Inicial</label>
										<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
									</div>

									<div class="col-md-4">
										<label>Data Final</label>
										<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
									</div>

									<div class="col-md-4">
										<label>Filtro Data</label>
										<select name="filtro_data" class="form-select">
											<option value="data_lanc">Data de Lançamento</option>
											<option value="data_venc">Data de Vencimento</option>
											<option value="data_pgto">Data de Pagamento</option>
										</select>
									</div>
								</div>		


								<div class="row">				
									<div class="col-md-4">
										<label>Entradas / Saídas</label>
										<select name="filtro_tipo" class="form-select">
											<option value="receber">Entradas / Ganhos</option>
											<option value="pagar">Saídas / Despesas</option>
										</select>
									</div>

									<div class="col-md-4">
										<label>Tipo Lançamento</label>
										<select name="filtro_lancamento" class="form-select">
											<option value="">Tudo</option>
											<option value="Conta">Ganhos / Despesas</option>
											<option value="Venda">Vendas</option>
											<option value="Serviço">Serviços</option>
											<option value="Cancelamento">Devoluções</option>
											<option value="Compra">Compras</option>
											<option value="Comissão">Comissões</option>
										</select>
									</div>
									<div class="col-md-4">
										<label>Pendentes / Pago</label>
										<select name="filtro_pendentes" class="form-select">
											<option value="">Tudo</option>
											<option value="Não">Pendentes</option>
											<option value="Sim">Pago</option>
										</select>
									</div>			
								</div>		



							</div>
							<div class="modal-footer">       
								<button type="submit" class="btn btn-primary">Gerar</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal Rel Lucro -->
			<div class="modal fade" id="modalRelLucro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary text-white">
							<h4 class="modal-title" id="exampleModalLabel">Relatório de Lucro</h4>
							<button id="btn-fechar-rel" aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span class="text-white" aria-hidden="true">&times;</span></button>
						</div>
						<form method="POST" action="rel/lucro_class.php" target="_blank">
							<div class="modal-body">	
								<div class="row">
									<div class="col-md-4">
										<label>Data Inicial</label>
										<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
									</div>

									<div class="col-md-4">
										<label>Data Final</label>
										<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
									</div>


								</div>		


								

							</div>
							<div class="modal-footer">       
								<button type="submit" class="btn btn-primary">Gerar</button>
							</div>
						</form>
					</div>
				</div>
			</div>




	<!-- Mascaras JS -->
<script type="text/javascript" src="js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	<script type="text/javascript">
				function carregarImgPerfil() {
					var target = document.getElementById('target-usu');
					var file = document.querySelector("#foto_perfil").files[0];

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
				$("#form-perfil").submit(function () {

					event.preventDefault();
					var formData = new FormData(this);

					$.ajax({
						url: "editar-perfil.php",
						type: 'POST',
						data: formData,

						success: function (mensagem) {
							$('#msg-perfil').text('');
							$('#msg-perfil').removeClass()
							if (mensagem.trim() == "Editado com Sucesso") {

								$('#btn-fechar-perfil').click();
								location.reload();				


							} else {

								$('#msg-perfil').addClass('text-danger')
								$('#msg-perfil').text(mensagem)
							}


						},

						cache: false,
						contentType: false,
						processData: false,

					});

				});
			</script>






			<script type="text/javascript">
				$("#form-config").submit(function () {

					event.preventDefault();
					nicEditors.findEditor('garantia').saveContent();
					nicEditors.findEditor('termos').saveContent();
					nicEditors.findEditor('msg_rodape').saveContent();
				
					var formData = new FormData(this);

					$.ajax({
						url: "editar-config.php",
						type: 'POST',
						data: formData,

						success: function (mensagem) {

							$('#msg-config').text('');
							$('#msg-config').removeClass()
							if (mensagem.trim() == "Editado com Sucesso") {

								$('#btn-fechar-config').click();
								location.reload();		


							} else {

								$('#msg-config').addClass('text-danger')
								$('#msg-config').text(mensagem)
							}


						},

						cache: false,
						contentType: false,
						processData: false,

					});

				});
			</script>




			<script type="text/javascript">
				function carregarImgLogo() {
					var target = document.getElementById('target-logo');
					var file = document.querySelector("#foto-logo").files[0];

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
				function carregarImgLogoRel() {
					var target = document.getElementById('target-logo-rel');
					var file = document.querySelector("#foto-logo-rel").files[0];

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
				function carregarImgIcone() {
					var target = document.getElementById('target-icone');
					var file = document.querySelector("#foto-icone").files[0];

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
				function carregarImgLogoPainel() {
					var target = document.getElementById('target-logo-painel');
					var file = document.querySelector("#foto-logo-painel").files[0];

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




<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
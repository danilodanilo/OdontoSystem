<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';

unset($_SESSION['tipo_conta']);
unset($_SESSION['nome_paciente']);
unset($_SESSION['nome_recebedor']);
unset($_SESSION['valor']);
unset($_SESSION['data']);
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if(!isset($_SESSION['usuario'])){
	header('Location:login.php');
}
else{
	$usuario = $_SESSION['usuario'];

	$qry = mysql_query("select perfil from users where username = '$usuario'");

	$perfil = mysql_result($qry, 0);
	//echo $controle;

	if($perfil == 0){
		?>
<script language="javascript">
					alert("Usuário sem permissão para tal ação");
					window.location = 'index.php';
</script>
		<?php

	}else{


		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="ThemeFuse" />
<meta name="Description" content="A short description of your company" />
<meta name="Keywords"
	content="Some keywords that best describe your business" />
<title>Odontosyst</title>
<link href="HTML/style.css" media="screen" rel="stylesheet"
	type="text/css" />

<script type="text/javascript" src="HTML/js/jquery.min.js"></script>
<script type="text/javascript" src="HTML/js/preloadCssImages.js"></script>

<script type="text/javascript" language="JavaScript"
	src="HTML/js/general.js"></script>
<script type="text/javascript" language="JavaScript"
	src="HTML/js/jquery.tools.min.js"></script>
<script type="text/javascript" language="JavaScript"
	src="HTML/js/jquery.easing.1.3.js"></script>

<script type="text/javascript" language="JavaScript"
	src="HTML/js/slides.jquery.js"></script>

<link rel="stylesheet" type="text/css"
	href="HTML/css/md-theme/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" type="text/css" href="HTML/css/ui.selectmenu.css" />
<script type="text/javascript" language="javascript"
	src="HTML/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" language="javascript"
	src="HTML/js/ui.selectmenu.js"></script>
<script type="text/javascript" language="javascript"
	src="HTML/js/styled.selectmenu.js"></script>

<script type="text/javascript" language="javascript"
	src="HTML/js/reservations2.js"></script>
<script type="text/javascript" language="javascript"
	src="HTML/js/reservations.js"></script>
<script language="Javascript"> 
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este pagamento ?");   
	if (resposta == true) { 
		window.location.href = "excluir_pagamento.php?id="+id; 
		} 
	} 
</script>

<script language="Javascript"> 
function confirma_excluir_recebimento(id) { 
	var resposta = confirm("Tem certeza que deseja remover este pagamento ?");   
	if (resposta == true) { 
		window.location.href = "excluir_recebimento.php?id="+id; 
		} 
	} 
</script>

<script language="Javascript"> 
function excluir_pagamento(id) { 
	var resposta = confirm("Tem certeza que deseja remover este pagamento ?");   
	if (resposta == true) { 
		window.location.href = "excluir_pagamento.php?id="+id; 
		} 
	} 
</script>
<script language="Javascript"> 
function editar(id){
	window.location.href = "editar_pagamentos.php?id="+id;
}
</script>
<script language="Javascript"> 
function chama_graficos(){
	window.location.href = "graficos.php";
}
</script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet"
	type="text/css" />
<!-- sw showcase -->
<link href="HTML/css/aw-showcase.css" media="screen" rel="stylesheet"
	type="text/css" />
<script type="text/javascript" language="JavaScript"
	src="HTML/js/jquery.aw-showcase.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#showcase").awShowcase({
		content_width:			960,
		content_height:			444,
		fit_to_parent:			false,
		auto:					true,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					false,
		buttons:				false,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false,
		pauseonover:			true,
		stoponclick:			true,
		transition:				'fade',
		transition_delay:		300,
		transition_speed:		500,
		show_caption:			'onhover',
		thumbnails:				true,
		thumbnails_position:	'inside-last',
		thumbnails_direction:	'vertical',
		thumbnails_slidex:		0,
		dynamic_height:			false, 
		speed_change:			true,
		viewline:				false
	});
});
</script>

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet"
	type="text/css" />
</head>

<body>



	<div class="body_wrap">

		<div class="header" align="center">

			<div class="header_top">
				<div class="container">
					<div class="logo">
						<a href="index.php"><img src="HTML/images/col_icon_2.png"
							width="210" height="80" alt="Medica" /> </a>
					</div>
					<div class="header_contacts">
					<?php   echo "<p>Bem vindo $usuario </p>";
					?>
					</div>
				</div>
			</div>
		<div class="header_menu">
				<div class="container">
					<div class="topmenu" align="left">
						<ul class="dropdown">
							<li class="menu-item-home"><a
								href="index.php"><span>In&iacute;cio</span> </a></li>
							<li class="menu-item-home"><a href="#"><span>Cadastramento</span> </a>
								<ul>
									<li class="menu-item-home"><a href="novo_usuario.php"><span>Controle
												de Usu&aacute;rios</span> </a>
									</li>
									<li class="menu-item-home"><a href="novo_paciente.php"><span>Controle
												de Pacientes</span> </a>
									</li>

									<li class="menu-item-home"><a href="novo_fornecedor.php"><span>Controle
												de Fornecedores</span> </a>
									</li>

									<li class="menu-item-home"><a href="novo_medicamento.php"><span>Controle
												de Medicamentos</span> </a>
									</li>

									<li class="menu-item-home"><a href="novo_procedimento.php"><span>Controle
												de Procedimentos</span> </a>
									</li>

								</ul>
							</li>
							<li class="menu-item-home parent current-menu-ancestor"><a href="#"><span>Financeiro</span> </a>
								<ul>
									<li class="current-menu-item"><a href="pagamentos.php"><span>Pagamentos</span> </a></li>
									<li><a href="orcamento.php"><span>Orçamento</span> </a></li>


								</ul>
							</li>
							<li><a href="agendar_consulta.php"><span>Agendamento</span> </a>
							</li>
							<li><a href="#"><span>Outros Servi&ccedil;os</span> </a>
								<ul>
									<li><a href="receita.php"><span>Gerar Receita</span> </a></li>
									<li><a href="atestado.php"><span>Gerar Atestado</span> </a></li>
								</ul>
							</li>
							<li><a href="sair.php"><span>Sair</span> </a></li>

						</ul>
					</div>
				</div>
			</div>
			<div class="middle sidebarRight">
				<div class="entry">
					<div class="container_12">
						<input value="Nova Conta"
							title="Cadastrar Nova Conta Pagar/Receber" class="button_styled"
							onclick="window.location.href='nova_conta.php'"
							style="text-align: center; background: #474747; color: #ffffff; border: 1px solid #474747;"
							id="send" />



						<div class="post-item">
							<div class="col col_1_2 ">
								<div class="inner">
									<h2>Contas a Pagar</h2>
									<div class="styled_table table_turquoise" align="center">
										<table id="tabela_1" width="50%" cellpadding="0"
											cellspacing="0">
											<thead>
												<tr class="tr_1">
													<th style="width: 25%">Ação</th>
													<th style="width: 25%">Descrição</th>
													<th style="width: 25%">R$</th>
													<th style="width: 25%">Data</th>
													<th style="width: 25%">Status</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$query = "SELECT SUM( REPLACE( (

													SELECT REPLACE( pag_valor, '.', '' ) ) , ',', '.' )
													) AS total
													FROM pag_pagar
													WHERE controle =0";
											$sql = mysql_query($query);
											if($sql){
												$total_pagar = mysql_result($sql,0,'total');

											}
											$query2 = "select * from pag_pagar where controle=0 order by data";
											$sql2 = mysql_query($query2);
											if($sql2)
											$count = mysql_numrows($sql2);
											//$total_receber = 0;
											for($i=0; $i<$count; $i++){
												$id = mysql_result($sql2, $i, 'id');
												$descricao = mysql_result($sql2, $i,'pag_descricao');
												if($descricao == 'undefined')
												$descricao = 'Sem Descrição';
													
												$valor = mysql_result($sql2, $i,'pag_valor');
												$status = mysql_result($sql2, $i,'status');

												if($status == 'a pagar')
												$status_mostrar = 'À Pagar';
												else
												$status_mostrar = 'Pago';
												$data = mysql_result($sql2, $i,'data');
												$data_format = mostraData($data);
													

												echo '<tr>';
												//ALTERAR AQUI****
												echo "<td><a href='editar_pagamentos.php?id_pag=$id'>
					     	<img title='Editar Pagamento' border='0' src='ico_edit.png' width='15' height='10'></a>
					       	<a href='#' onclick=excluir_pagamento($id) > <img title='Excluir Pagamento' border='0' src='icon_x2.png' width='15' height='10'></a>
					     	
					     	            		   
					     	</td>";

												echo "<td>$descricao</td>";
												echo "<td>$valor</td>";
												echo "<td>$data_format</td>";
												echo "<td>$status_mostrar</td>";


												echo '</tr>';
											}



					     	?>
											</tbody>
											<?php
										 $total = number_format($total_pagar, 2, ',', '.');
											echo "Total a Pagar - $total";

											?>
										</table>
									</div>
								</div>
							</div>
							<div class="col col_1_2 ">
								<div class="inner">
									<h2>Contas a Receber</h2>
									<div class="styled_table table_turquoise" align="center">
										<table id="tabela_2" width="50%" cellpadding="0"
											cellspacing="0">
											<thead>
												<tr class="tr_1">
													<th style="width: 25%">Ação</th>
													<th style="width: 25%">Descrição</th>
													<th style="width: 25%">R$</th>
													<th style="width: 25%">Data</th>
													<th style="width: 25%">Status</th>

												</tr>
											</thead>
											<tbody>
											<?php
											$query = "SELECT SUM( REPLACE( (

													SELECT REPLACE( rec_valor, '.', '' ) ) , ',', '.' )
													) AS total
													FROM pag_receber
													WHERE controle =0";
											$sql = mysql_query($query);
											if($sql){
												$total_receber = mysql_result($sql,0,'total');

											}
											$query2 = "select * from pag_receber where controle=0 order by data";
											$sql2 = mysql_query($query2);
											if($sql2)
											$count = mysql_numrows($sql2);
											//$total_receber = 0;
											for($i=0; $i<$count; $i++){
												$id = mysql_result($sql2, $i, 'id');
												$descricao = mysql_result($sql2, $i,'rec_descricao');
												if($descricao == 'undefined')
												$descricao = 'Sem Descrição';
													
												$valor = mysql_result($sql2, $i,'rec_valor');
												$status = mysql_result($sql2, $i,'status');
												if($status == 'a receber')
												$status_mostrar = 'À Receber';
												$data = mysql_result($sql2, $i,'data');
												$data_format = mostraData($data);
												echo '<tr>';
												echo "<td><a href='editar_recebimentos.php?id_edit=$id'><img title='Editar Recebimento' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma_excluir_recebimento($id)'><img title='Excluír Recebimento' border='0' src='icon_x2.png' width='15' height='10'></a>
		                                		                                		
		                                </td>";


												echo "<td>$descricao</td>";
												echo "<td>$valor</td>";
												echo "<td>$data_format</td>";
												echo "<td>$status_mostrar</td>";

												echo '</tr>';


													
											}
					     	?>
											</tbody>

											<?php

											$total = number_format($total_receber, 2, ',', '.');
											echo "Total a Receber - $total";

											?>
										</table>
										<div class="row field_text alignleft omega ">
						
									</div>
									
								</div>
								
							</div>
						</div>
						<!--/ entry -->

					</div>
							<input value="Gráficos" title="Visualizar Gráficos" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="chama_graficos()" type="submit" /> 
							</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</div>

</body>
</html>

											<?php
	}
}
?>
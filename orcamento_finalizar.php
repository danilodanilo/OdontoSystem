<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';
$usuario = $_SESSION['usuario'];
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
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
<script type='text/javascript' src='HTML/js/jquery.autocomplete.js'></script>
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
<script type="text/javascript">
function chamaindex(){
	window.location.href = "index.php";
}
</script>
<script type="text/javascript">
function gerar_pdf(id){
	window.location.href = "gerar_orcamento_pdf.php?id_orcamento="+id;
	
}
</script>
<script language="Javascript"> 
function confirma(id_orcamento,id_procedimento) { 
	var resposta = confirm("Tem certeza que deseja remover este item de Orçamento ?");   
	if (resposta) { 
		window.location.href = "excluir_orcamento.php?id_orcamento="+id_orcamento+"&id_procedimento="+id_procedimento; 
		} 
	} 
</script> 

</head>

<body>
	<div class="body_wrap">
		<div class="header">
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
							<li><a href="index.php"><span>In&iacute;cio</span> </a></li>
							<li><a href="#"><span>Cadastramento</span> </a>
								<ul>
									<li class="current-menu-item"><a href="novo_usuario.php"><span>Controle
												de Usu&aacute;rios</span> </a>
									</li>
									<li class="current-menu-item"><a href="novo_paciente.php"><span>Controle
												de Pacientes</span> </a>
									</li>

									<li class="current-menu-item"><a href="novo_fornecedor.php"><span>Controle
												de Fornecedores</span> </a>
									</li>

									<li class="current-menu-item"><a href="novo_medicamento.php"><span>Controle
												de Medicamentos</span> </a>
									</li>

									<li class="current-menu-item"><a href="novo_procedimento.php"><span>Controle
												de Procedimentos</span> </a>
									</li>

								</ul>
							</li>
							<li class="menu-item-home parent current-menu-ancestor"><a
								href="#"><span>Financeiro</span> </a>
								<ul>
									<li><a href="pagamentos.php"><span>Pagamentos</span> </a></li>
									<li class="current-menu-item"><a href="orcamento.php"><span>Orçamento</span>
									</a></li>


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
				<div class="container_12">

					<!-- content -->
					<div class="grid_8 content">



						<div class="post-item">



							<h1>Orçamento</h1>

							<div class="entry">



								<div class="contact-form">

									<div class="row field_text alignleft omega">
										<div class="styled_table table_turquoise">
											<table id="tabela" width="99%" cellpadding="0"
												cellspacing="0">
												<thead>
												<?php
												?>
													<tr>
														<th style="width: 15%">Ação</th>
														<th style="width: 15%">Procedimento</th>
														<th style="width: 40%">Descrição do Serviço</th>
														<th style="width: 25%">Dente</th>
														<th style="width: 25%">Valor R$</th>
													</tr>
												</thead>
												<tbody>
												<?php
												$valor_total=0;
												$id_orcamento = $_GET['id_orcamento'];

												$sql = "SELECT a.id_orcamento, a.id_procedimento, b.nome_procedimento, b.numero_dente, b.fk_cod_proc, c.cod_procedimento, c.valor_procedimento, c.nome_procedimento, d.nome
														FROM orcamento_procedimento a
														INNER JOIN orcamento b ON a.id_orcamento = b.id
														INNER JOIN procedimentos c ON a.id_procedimento = c.id
														inner join pacientes d on d.id=b.fk_pacientes
														WHERE a.id_orcamento =$id_orcamento";



												$result = mysql_query($sql);
												if($result){
													$nome_paciente = mysql_result($result, 0,'d.nome');
													echo "<b><u>Paciente: $nome_paciente </b></u>";
													$count = mysql_numrows($result);
													$valor_total=0;
													for($i=0; $i<$count; $i++){
														
														$proc_cod = mysql_result($result, $i,'c.cod_procedimento');
														$nome_proc = mysql_result($result, $i,'c.nome_procedimento');
														$numero_dente = mysql_result($result, $i,'b.numero_dente');
														$valor = mysql_result($result, $i,'c.valor_procedimento');
														$id_procedimento = mysql_result($result, $i,'a.id_procedimento');
													echo "<tr>"; 
													echo "<td><a href='#' onclick='confirma($id_orcamento,$id_procedimento)'><img
																title='Excluir do Orcamento' border='0'
																src='icon_x2.png' width='15' height='10'></a>
														</td>"; 
													?>


														<td><?php echo $proc_cod;?></td>
														<td><?php echo $nome_proc;?></td>
														<td><?php echo $numero_dente;?></td>
														<td><?php echo $valor;?></td>
													</tr>
													
													<?php
													$valor_total += $valor;
													}

												}else{
													?>
													<script language="javascript">
														alert("ERRO SQL");
														
														</script>
														<?php
												}							
														
													
												
												
												$valor_format = number_format($valor_total, 2, '.', '');
												?>
													<td>Total <?php echo $valor_format;?></td>
												</tbody>

											</table>
										</div>
									</div>


								</div>


								<div class="clear"></div>
							</div>

						</div>

					</div>



					<div class="clear"></div>
					<div class="row field_text">
						<input value="Finalizar" title="Finalizar Orçamento"
							class="button_styled"
							style="background: #474747; color: #ffffff; border: 1px solid #474747;"
							onclick="chamaindex();" id="send" type="submit" /> 
							<?php 
							//echo $id_orcamento;
							echo "<input
							value='Gerar PDF' title='Gerar PDF do Orçamento'
							class='button_styled'
							style='background: #474747; color: #ffffff; border: 1px solid #474747;'
							onclick='gerar_pdf($id_orcamento);' id='send' type='submit' />'";
							?>
					</div>

				</div>

			</div>
			<div class="middle_bot"></div>




		</div>
	</div>
</body>
</html>

<?php

session_start();
include 'conecta_banco.php';
include 'funcoes.php';
$usuario = $_SESSION['usuario'];
$query = "select * from pacientes where controle=0";
$sql = mysql_query($query);

$count_sql = mysql_num_rows($sql);
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

if(!empty($_GET['id_consulta'])){
	$id_consulta_back = $_GET['id_consulta'];
	$ret = backtracking($id_consulta_back);
}
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
function irpagina(nome)
{
	var receita = document.getElementById('receita').value;
	window.location.href = "gerar_receita_pdf.php?nome="+nome+"&receita="+receita;
}
</script>

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
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover esta consulta ?");   
	if (resposta == true) { 
		window.location.href = "excluir_consulta.php?id="+id; 
	} 
} 
</script>

<script>
function showHint(str)
{
if (str.length==0)
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gethint.php?q="+str,true);
xmlhttp.send();
}
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
							<li class="menu-item-home"><a href="index.php"><span>In&iacute;cio</span>
							</a></li>
							<li class="menu-item-home"><a href="#"><span>Cadastramento</span>
							</a>
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
							<li class="menu-item-home"><a href="#"><span>Financeiro</span> </a>
								<ul>
									<li class="menu-item-home"><a href="pagamentos.php"><span>Pagamentos</span>
									</a></li>
									<li class="menu-item-home"><a href="orcamento.php"><span>Orçamento</span>
									</a></li>


								</ul>
							</li>
							<li class="menu-item-home parent current-menu-ancestor"><a
								href="agendar_consulta.php"><span>Agendamento</span> </a>
							</li>
							<li class="menu-item-home"><a href="#"><span>Outros
										Servi&ccedil;os</span> </a>
								<ul>
									<li class="menu-item-home"><a href="receita.php"><span>Gerar
												Receita</span> </a></li>
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
							<div class="contact-form" align="left">


								<h1>
									<br>Todas as Consultas</br> </br>
								</h1>

								<div class="styled_table table_turquoise" align="center">
									<table id="tabela" width="50%" cellpadding="0"
										cellspacing="110">
										<thead>
											<tr>
												<th width="10%">Ação</th>
												<th width="10%">Nome do Paciente</th>
												<th width="10%">Data</th>
												<th width="30%">Horário</th>
												<th width="30%">Dentista</th>

											</tr>
										</thead>

										<?php
								//$data_hj = date('dd/mm/YY');
										$query ="SELECT a. * , b.nome
									FROM agenda a
									INNER JOIN pacientes b ON a.id_paciente = b.id
									WHERE data >= curdate( ) order by data";

										$sql = mysql_query($query);
										if($sql){
											$cont = mysql_num_rows($sql);

											for($i=0;$i<$cont;$i++){

												$id_consulta = mysql_result($sql, $i,'a.id_agenda');
												$data = mysql_result($sql, $i,'a.data');
												$data_f = mostraData($data);
												$horario = mysql_result($sql, $i,'a.horario');
												$horario_termino = mysql_result($sql, $i,'a.horario_termino');
												$id_paciente = mysql_result($sql, $i,'a.id_paciente');
												$nome_paciente = mysql_result($sql, $i,'b.nome');
												$nome_dentista = mysql_result($sql, $i,'a.dentista_nome');
												$nome_dentista = ucfirst($nome_dentista);


												echo '<tbody>';
												echo '<tr>';
													
												echo "<td><a href='remarcar_consulta.php?id_consulta=$id_consulta'><img title='Remarcar Consulta' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma($id_consulta)'><img title='Excluír Consulta' border='0' src='icon_x2.png' width='15' height='10'></a>
		                                		                                		
		                                </td>";
												echo "<td>$nome_paciente</td>";
												echo "<td>$data_f</td>";
												echo "<td>I.$horario./T.$horario_termino</td>";
												echo "<td>Dr.$nome_dentista</td>";
													
											}

											echo '</tbody>';
										}
											
											

											
										?>

									</table>
								</div>





							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
	</div>
	<div class="clear"></div>
	</div>
	</div>
	<div class="middle_bot"></div>
	</div>

</body>
</html>


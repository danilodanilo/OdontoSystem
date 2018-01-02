<?php

session_start();
include 'conecta_banco.php';
$usuario = $_SESSION['usuario'];
$query = "select * from pacientes where controle=0";
$sql = mysql_query($query);

$count_sql = mysql_num_rows($sql);
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
	var atestado = document.getElementById('atestado').value;
	window.location.href = "gerar_atestado_pdf.php?nome="+nome+"&atestado="+atestado;
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
			<h3 class="toggle box" align="center">
				Ver Todos os Pacientes<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
			<div class="styled_table table_turquoise" align="center">
				<table id="tabela" width="50%" cellpadding="0" cellspacing="0">
					<thead>
						<tr class="tr_1">
							<th style="width: 25%">Ação</th>
							<th style="width: 25%">Nome do Paciente</th>
							<th style="width: 25%">E-mail</th>
							<th style="width: 25%">Data de Nascimento</th>
						</tr>
					</thead>
					<tbody>
					<?php

					if ($sql){
						for($i=0;$i<$count_sql;$i++){
							$id = mysql_result($sql, $i, 'id');
							$nome_p = mysql_result($sql, $i,'nome');
							// $end_p = mysql_result($sql, $i,'endereco');
							// $tel_p = mysql_result($sql, $i,'telefone');
							// $cel_p = mysql_result($sql, $i,'celular');
							$email_p = mysql_result($sql, $i,'email');
							$data = mysql_result($sql, $i,'dt_nasc');
							//recebe o parâmetro e armazena em um array separado por -
							$data_f = explode('-', $data);
							//armazena na variavel data os valores do vetor data e concatena /
							$data_form = $data_f[2].'/'.$data_f[1].'/'.$data_f[0];
							// $cpf_p = mysql_result($sql, $i,'cpf');
							// $rg_p = mysql_result($sql, $i,'rg');
							// $bairro_p = mysql_result($sql, $i,'bairro');
							// $cidade_p = mysql_result($sql, $i,'cidade');
							// $estado_p = mysql_result($sql, $i,'estado');



							echo '<tr>';
							echo "<td><a href='atestado.php?nome_paciente=$nome_p'><img title='Selecionar Paciente' border='0' src='icon_check2.png' width='15' height='10'></a>
		                                		  
		                                		                                		
		                                </td>";

							echo "<td>$nome_p</td>";
							//	echo "<td>$end_p</td>";
							// echo "<td>$tel_p $cel_p </td>";
							echo "<td>$email_p</td>";
							echo "<td>$data_form</td>";
							//  echo "<td>$cpf_p</td>";
							// echo "<td>$cidade_p</td>";

							echo '</tr>';



						}?>
					</tbody>
					<?php
					}

					?>
				</table>
			</div>
</pre>
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
							<li class="menu-item-home"><a href="#"><span>Financeiro</span> </a>
								<ul>
									<li class="menu-item-home"><a href="pagamentos.php"><span>Pagamentos</span> </a></li>
									<li class="menu-item-home"><a href="orcamento.php"><span>Orçamento</span> </a></li>


								</ul>
							</li>
							<li class="menu-item-home"><a href="agendar_consulta.php"><span>Agendamento</span> </a>
							</li>
							<li class="menu-item-home parent current-menu-ancestor"><a href="#"><span>Outros Servi&ccedil;os</span> </a>
								<ul>
									<li class="menu-item-home"><a href="receita.php"><span>Gerar Receita</span> </a></li>
									<li class="current-menu-item"><a href="atestado.php"><span>Gerar Atestado</span> </a></li>
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
							<div class="contact-form" align="left" width="100px">
								<form action="gerar__pdf.php" method="post"
									name="gerar_">

									<h1>
										<br> Atestado M&eacute;dico</br>
									</h1>

									<?php
									if(!empty($_GET['nome_paciente'])){
										$nome_paciente = $_GET['nome_paciente'];
										?>
									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Paciente</strong> </label><br /> <input
												name="nome_fornecedor" id="nome_fornecedor"
												value="<?php echo $nome_paciente; ?>"
												class="inputtext input_middle required" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<?php
									}
									else{
										?>

									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Paciente</strong> </label><br /> <input
												name="nome_fornecedor" id="nome_fornecedor"
												class="inputtext input_middle required" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<?php
									}
									?>

									<div class="row field_textarea alignleft">
										<label><strong>Atestado</strong> </label><br />
										<textarea id="atestado" name="atestado"
											class="textarea textarea_middle required" cols="40" rows="10"></textarea>
									</div>
									<div class="row field_text alignleft">
										<div class="row">
											<div class="entry">
												<?php
												if(!empty($nome_paciente)){
													echo '<input value="Gerar " title="Gerar PDF da "
													class="button_styled" onclick="irpagina(\''.$nome_paciente.'\');"
													style="background: #474747; color: #ffffff; border: 1px solid #474747;"
													id="send" type="submit" />';
												} 
												else{
													echo '<input value="Gerar Atestado" title="Gerar PDF"
													class="button_styled" style="background: #474747; color: #ffffff; border: 1px solid #474747;"
													id="send" type="submit" />';
												}
												
													?>
											</div>

										</div>

									</div>
								</form>
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


<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';

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
		//$teste = 2002

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
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<?php

		$mes = 1;
		for($i=0; $i<12; $i++){

			$valor_total = 0.0;

			$query = "SELECT SUM( REPLACE( (

													SELECT REPLACE( rec_valor, '.', '' ) ) , ',', '.' )
													) AS total
													FROM pag_receber
													WHERE controle =0 
                                                    and month(data) = $mes and year(data)=extract(year from current_date)";
			$result = mysql_query($query);

			$query2 = "SELECT SUM( REPLACE( (

													SELECT REPLACE( pag_valor, '.', '' ) ) , ',', '.' )
													) AS total2 
													FROM pag_pagar
													WHERE controle =0 
                                                    and month(data) = $mes and year(data)=extract(year from current_date)";
			$result2 = mysql_query($query2);
			if ($mes == 1){
				$valor_jan = mysql_result($result, 0, 'total');
				$valorpag_jan = mysql_result($result2, 0, 'total2');
				$total_jan = $valor_jan - $valorpag_jan;
			}else if ($mes == 2){
				$valor_fev = mysql_result($result, 0, 'total');
				$valorpag_fev = mysql_result($result2, 0, 'total2');
				$total_fev = $valor_fev - $valorpag_fev;
			}else if ($mes == 3){
				$valor_mar = mysql_result($result, 0, 'total');
				$valorpag_mar = mysql_result($result2, 0, 'total2');
				$total_mar = $valor_mar - $valorpag_mar;				
			}else if ($mes == 4){
				$valor_abr = mysql_result($result, 0, 'total');
				$valorpag_abr = mysql_result($result2, 0, 'total2');
				$total_abr = $valor_abr - $valorpag_abr;
			}else if ($mes == 5){
				$valor_maio = mysql_result($result, 0, 'total');
				$valorpag_maio = mysql_result($result2, 0, 'total2');
				$total_maio = $valor_maio - $valorpag_maio;
			}else if ($mes == 6){
				$valor_jun = mysql_result($result, 0, 'total');
				$valorpag_jun = mysql_result($result2, 0, 'total2');
				$total_jun = $valor_jun - $valorpag_jun;
			}else if ($mes == 7){
				$valor_jul = mysql_result($result, 0, 'total');
				$valorpag_jul = mysql_result($result2, 0, 'total2');
				$total_jul = $valor_jul - $valorpag_jul;
			}else if ($mes == 8){
				$valor_ago = mysql_result($result, 0, 'total');
				$valorpag_ago = mysql_result($result2, 0, 'total2');
				$total_ago = $valor_ago - $valorpag_ago;
			}else if ($mes == 9){
				$valor_set = mysql_result($result, 0, 'total');
				$valorpag_set = mysql_result($result2, 0, 'total2');
				$total_set = $valor_set - $valorpag_set;
			}else if ($mes == 10){
				$valor_out = mysql_result($result, 0, 'total');
				$valorpag_out = mysql_result($result2, 0, 'total2');
				$total_out = $valor_out - $valorpag_out;
			}else if ($mes == 11){
				$valor_nov = mysql_result($result, 0, 'total');
				$valorpag_nov = mysql_result($result2, 0, 'total2');
				$total_nov = $valor_nov - $valorpag_nov;
			}else  if($mes == 12){
				$valor_dez = mysql_result($result, 0, 'total');
				$valorpag_dez = mysql_result($result2, 0, 'total2');
				$total_dez = $valor_dez - $valorpag_dez;
			}
			$mes ++;
		}

		?>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Meses de 2014', 'Resultado'],
          ['Jan',  <?php echo $total_jan;?>,],
          ['Fev',  <?php echo $total_fev;?>,],
          ['Mar',  <?php echo $total_mar;?>,],
          ['Abr',  <?php echo $total_abr;?>,],
          ['Mai',  <?php echo $total_maio;?>,],
          ['Jun',  <?php echo $total_jun;?>,],
          ['Jul',  <?php echo $total_jul;?>,],
          ['Ago',  <?php echo $total_ago;?>,],
          ['Set',  <?php echo $total_set;?>,],
          ['Out',  <?php echo $total_out;?>,],
          ['Nov',  <?php echo $total_nov;?>,],
          ['Dez',  <?php echo $total_dez;?>,]
          
        ]);

        var options = {
          title: 'Resultados do Ano',
          hAxis: {title: 'Meses de 2014', titleTextStyle: {color: 'red'}},
          is3d: true,
          width: 950,
          height: 500,
          seriesTypes: 'bars',
          series: {4:{type: "line"}}
          
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>




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



						<div class="post-item">
							<div class="col col_1_2 ">

								<div class="styled_table table_turquoise" align="center">
									<div id="chart_div" style="width: 900px; height: 500px;"></div>

								</div>

							</div>
								<div class="col col_1_2 ">

							

							</div>


							<div class="clear"></div>
						</div>
					</div>
					<?php
	}
}
?>

				</div>
			</div>
		</div>
	</div>

</body>
</html>


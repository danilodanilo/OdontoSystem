<?php

session_start();
$usuario = $_SESSION['usuario'];
include 'conecta_banco.php';
include 'funcoes.php';
if (!empty($_GET['id_edit'])){
	$id = $_GET['id_edit'];
}

$query = "select a.*, b.nome from pag_receber a
inner join pacientes b on a.fk_id_paciente=b.id 
where a.id=$id and a.controle=0";
//echo $query;
$sql = mysql_query($query);

echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if($sql){
	$nome_paciente = mysql_result($sql, 0, 'b.nome');
	$data = mysql_result($sql, 0, 'a.data');
	$descricao = mysql_result($sql, 0, 'rec_descricao');
	$parcelas = mysql_result($sql, 0, 'a.rec_n_parcelas');
	$valor = mysql_result($sql, 0, 'a.rec_valor');
	$data =  mysql_result($sql, 0, 'a.data');
	
	$data_format = formata_data($data);
	
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
<script type="text/javascript">
function formatar_moeda(campo, separador_milhar, separador_decimal, tecla) {
var sep = 0;
var key = '';
var i = j = 0;
var len = len2 = 0;
var strCheck = '0123456789';
var aux = aux2 = '';
var whichCode = (window.Event) ? tecla.which : tecla.keyCode;

if (whichCode == 13) return true; // Tecla Enter
if (whichCode == 8) return true; // Tecla Delete
key = String.fromCharCode(whichCode); // Pegando o valor digitado
if (strCheck.indexOf(key) == -1) return false; // Valor inválido (não inteiro)
len = campo.value.length;
for(i = 0; i < len; i++)
if ((campo.value.charAt(i) != '0') && (campo.value.charAt(i) != separador_decimal)) break;
aux = '';
for(; i < len; i++)
if (strCheck.indexOf(campo.value.charAt(i))!=-1) aux += campo.value.charAt(i);
aux += key;
len = aux.length;
if (len == 0) campo.value = '';
if (len == 1) campo.value = '0'+ separador_decimal + '0' + aux;
if (len == 2) campo.value = '0'+ separador_decimal + aux;

if (len > 2) {
aux2 = '';

for (j = 0, i = len - 3; i >= 0; i--) {
if (j == 3) {
aux2 += separador_milhar;
j = 0;
}
aux2 += aux.charAt(i);
j++;
}

campo.value = '';
len2 = aux2.length;
for (i = len2 - 1; i >= 0; i--)
campo.value += aux2.charAt(i);
campo.value += separador_decimal + aux.substr(len - 2, len);
}

return false;
}
</script>
<script type="text/javascript">
function valida_editar(){
	var id = <?php echo $id;?>;
	var nome_paciente = document.getElementById("nome_paciente").value;
	var data = document.getElementById("data").value;
	var valor = document.getElementById("valor").value;
	if(document.getElementById("nome_paciente").value != "")
		var parcelas = document.getElementById("numero_parcelas").value;
	if(document.getElementById("descricao").value != "")
		var descricao = document.getElementById("descricao").value;
	if(document.getElementById("status").value != "")
		var status = document.getElementById("status").value;
	
	window.location.href = "valida_editar_recebimento.php?id="+id+"&nome_paciente="+nome_paciente+"&data="+data+"&valor="+valor+"&parcelas="+parcelas+"&descricao="+descricao+"&status="+status;
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
							<li class="menu-item-home"><a href="index.php"><span>In&iacute;cio</span>
							</a></li>
							<li><a href="#"><span>Cadastramento</span> </a>
								<ul>
									<li class="menu-item"><a href="novo_usuario.php"><span>Controle
												de Usu&aacute;rios</span> </a>
									</li>
									<li class="menu-item"><a href="novo_paciente.php"><span>Controle
												de Pacientes</span> </a>
									</li>

									<li class="menu-item"><a href="novo_fornecedor.php"><span>Controle
												de Fornecedores</span> </a>
									</li>

									<li class="menu-item"><a href="#"><span>Controle de
												Medicamentos</span> </a>
									</li>

									<li class="menu-item"><a href="index.html"><span>Controle de
												Procedimentos</span> </a>
									</li>

									<li class="menu-item"><a href="index.html"><span>Controle de
												Especialidades</span> </a>
									</li>



								</ul>
							</li>
							<li><a href="sair.php"><span>Sair</span> </a></li>
							<li class="current-menu-item"><a href="#"><span>Financeiro</span>
							</a>
								<ul>
									<li><a href="#"><span>Pagamentos</span> </a></li>
									<li><a href="#"><span>Orçamento</span> </a></li>


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

							
													</ul>
					</div>
				</div>
			</div>
	</div>
	<div class="middle sidebarRight">
			<div class="container_12">

				<!-- content -->
				<div class="grid_8 content">
					<div class="post-item">

						<div class="contact-form">
							<br>*Campos Obrigatórios</br>
							<h1>
								<br>Editar Contas à Receber</br>
							</h1>
							<div class="row field_text alignleft ">
								<div class="row field_text alignleft">
									<p>
										<label><strong>Nome do Cliente*</strong> </label><br /> <input
											name="nome_paciente" id="nome_paciente"
											class="inputtext input_middle required" value="<?php echo $nome_paciente; ?>" size="35"
											tabindex="10" type="text" />
									</p>
								</div>

							</div>
							<div class="row field_text alignleft ">
								<div class="row field_text alignleft">
							<p align="left">
								<label><strong>Data*</strong> </label><br /> <input
									class="inputtext input_middle required" name="data" id="data"
									value="<?php echo $data_format; ?>" size="20" tabindex="20" type="text" />

							</p>
							</div>
							</div>

							<br />
							<div class="row field_text alignleft ">
								<p align="left">
									<label><strong>Valor R$*</strong> </label><br /> <input
										class="inputtext input_middle required" name="valor"
										id="valor" value="<?php echo $valor; ?>"
										onkeypress="return formatar_moeda(this,'.',',',event);"
										size="10" tabindex="0" type="text" />

								</p>
							</div>
							<div class="row field_text alignleft omega">
								<p>
									<label><strong>Número da Parcela</strong> </label><br /> <input
										class="inputtext input_middle required" name="numero_parcelas"
										id="numero_parcelas" value="<?php echo $parcelas; ?>" size="10" tabindex="0"
										type="text" />

								</p>
							</div>
								<div class="row field_text alignleft">
								<div class="row field_select">
								<label><strong>Status*</strong> </label> <select
									class="select_styled" name="status" id="status">

									<option value="a receber">à Receber</option>
									<option value="recebido">Recebido</option>

								</select>
							</div>
							</div>

							<div class="row field_textarea alignleft">
								<label><strong>Descrição do Recebimento</strong> </label><br />
								<textarea id="descricao" name="descricao"
									class="textarea textarea_middle required" cols="40" rows="10"><?php echo $descricao; ?></textarea>
							</div>
							
							<div class="row field_text alignleft omega ">
								<input value="Enviar Dados" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="valida_editar()" type="submit" /> <input
									value="Voltar" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="window.location = 'pagamentos.php'"
									type="submit" />
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
	
	
	
<?php 	
}
else{
	?>
	<script language="javascript">
				alert("Ocorreu um Erro SQL");
				window.history.go(-1);
				</script>
					<?php
	
}
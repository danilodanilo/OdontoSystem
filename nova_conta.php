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
		if(!empty($_GET['tipo_conta'])){

			$tipo_conta = $_GET['tipo_conta'];
			$_SESSION['tipo_conta'] = $tipo_conta;
		}
		//include 'conecta_banco.php';
		$query = "select * from pacientes where controle=0";
		$sql = mysql_query($query);
		if($sql)
		$count_sql = mysql_num_rows($sql);
		?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
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
<script type='text/javascript' src='HTML/js/jquery.autocomplete.js'></script>
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
<script>
$(function() {
	$( "#data" ).datepicker({
		minDate: 'today',
		showOtherMonths: true,
		selectOtherMonths: true
		
	});
});
</script>
<script>
$().ready(function() {
    $("#nome_paciente").autocomplete("sugerir_nome_paciente.php", {
        width: 260,
        matchContains: true,
        selectFirst: false
    });
});
</script>

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
function valida_recebimento(){
	var nome_paciente = document.getElementById("nome_paciente").value;
	var data = document.getElementById("data").value;
	var valor = document.getElementById("valor").value;
	if(document.getElementById("nome_paciente").value != "")
		var parcelas = document.getElementById("numero_parcelas").value;
	if(document.getElementById("descricao").value != "")
		var descricao = document.getElementById("descricao").value;
	if(document.getElementById("status").value != "")
		var status = document.getElementById("status").value;
	
	window.location.href = "nova_conta_validar.php?nome_paciente="+nome_paciente+"&data="+data+"&valor="+valor+"&parcelas="+parcelas+"&descricao="+descricao+"&status="+status;
}
</script>

<script type="text/javascript">
function valida_pagamento(){
	var nome_recebedor = document.getElementById("nome_recebedor").value;
	var data = document.getElementById("data").value;
	var valor = document.getElementById("valor").value;
	if(document.getElementById("numero_parcelas").value != "")
		var parcelas = document.getElementById("numero_parcelas").value;
	if(document.getElementById("descricao").value != "")
		var descricao = document.getElementById("descricao").value;
	if(document.getElementById("status").value != "")
		var status = document.getElementById("status").value;
	
	window.location.href = "nova_conta_pagamento.php?nome_recebedor="+nome_recebedor+"&data="+data+"&valor="+valor+"&parcelas="+parcelas+"&descricao="+descricao+"&status="+status;
}
</script>

<script type="text/javascript">
function Chamar_pagina(){
	var tipo_conta = document.getElementById("tipo_conta").value;
	
	window.location.href = "nova_conta.php?tipo_conta="+tipo_conta;
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

			<?php
			if (!empty($tipo_conta) && $tipo_conta == 'recebimento'){
			//if($tipo_conta == 'recebimento'){
			?>
			<h3 class="toggle box" align="center">
				Ver Todos os Pacientes<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
		<div class="styled_table table_turquoise" align="center">
                    <table id="tabela" width="60%" cellpadding="0"
						cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 25%">Ação</th>
                                <th style="width: 25%">Nome do Paciente</th>
                                </tr>
                        </thead>
                       <tbody>
                       <?php
                       if ($sql){
                       	for($i=0;$i<$count_sql;$i++){
                       		$id = mysql_result($sql, $i, 'id');
                       		$nome_p = mysql_result($sql, $i,'nome');
                       	



                       		echo '<tr>';
                       		echo "<td><a href='nova_conta.php?nome_paciente=$nome_p'><img title='Selecionar Paciente' border='0' src='icon_check2.png' width='15' height='10'></a>
		                                		                         		
		                                </td>";

                       		echo "<td>$nome_p</td>";
                       		

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
          
				
			<?php 	
			}
		?>
			
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
			<div class="container_12">

				<!-- content -->
				<div class="grid_8 content">
					<div class="post-item">

						<div class="contact-form">
							<br>*Campos Obrigatórios</br>
							<?php
							if(empty($_SESSION['tipo_conta'])){
								//unset($_SESSION['tipo_conta']);
								//$tipo_conta_aux = $_SESSION['tipo_conta']
								?>
							<h1>
								<br>Cadastramento de Novas Contas</br>
							</h1>
							<?php

							}else{
								//$_SESSION['conta'] = $tipo_conta;
								$tipo_conta_format = ucfirst($_SESSION['tipo_conta']);
								?>
							<h1>
								<br>Cadastramento de Novas Contas -
								<?php echo $tipo_conta_format;?>
								</br>
							</h1>
							<?php
							}
							?>




							<?php
							if(empty($tipo_conta) && empty($_SESSION['tipo_conta'])){
								?>
							<div class="row field_select">
								<label><strong>Tipo da Conta</strong> </label> <select
									class="select_styled" name="tipo_conta" id="tipo_conta">

									<option value="pagamento">Pagamento</option>
									<option value="recebimento">Recebimento</option>

								</select>
							</div>
							<div class="row field_text center ">
								<input value="Enviar Dados" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="Chamar_pagina()" type="submit" />
							</div>
							<?php }
							else if($_SESSION['tipo_conta']=='pagamento'){//pagamento


								?>
							<div class="row field_select alignleft">
								<label><strong>Status*</strong> </label> <select
									class="select_styled" name="status" id="status">

									<option value="a pagar">à Pagar</option>
									<option value="pago">Pago</option>

								</select>
							</div>
							<?php if (!empty($_SESSION['nome_recebedor'])){
								$nome_recebedor = $_SESSION['nome_recebedor'];
							
							?>
							<div class="row field_text aligncenter">
								<p>
									<label><strong>Nome do Recebedor*</strong> </label><br /> <input
										name="nome_recebedor" id="nome_recebedor"
										class="inputtext input_middle required" value="<?php echo $nome_recebedor; ?>" size="35"
										tabindex="10" type="text" />
								</p>
							</div>
							<?php }
							else{
								?>
								<div class="row field_text aligncenter">
								<p>
									<label><strong>Nome do Recebedor*</strong> </label><br /> <input
										name="nome_recebedor" id="nome_recebedor"
										class="inputtext input_middle required" value="" size="35"
										tabindex="10" type="text" />
								</p>
							</div>
							<?php 
							}
							if(!empty($_SESSION['data'])){
							?>
							
							<div class="row field_text alignright">
								<p align="left">
									<label><strong>Data*</strong> </label><br /> <input
										class="inputtext input_middle required" name="data" id="data"
										value="<?php echo $_SESSION['data']; ?>" size="20" tabindex="20" type="text" />

								</p>
							</div>
							<?php 
							}else{
								
							?>
								<div class="row field_text alignright">
								<p align="left">
									<label><strong>Data*</strong> </label><br /> <input
										class="inputtext input_middle required" name="data" id="data"
										value="" size="20" tabindex="20" type="text" />

								</p>
							</div>
							<?php 
							}
							if(!empty($_SESSION['valor'])){
								
							?>
							<div class="row field_text alignleft omega">
								<p>
									<label><strong>Valor R$*</strong> </label><br /> <input
										class="inputtext input_middle required" name="valor"
										id="valor"
										value="<?php echo $_SESSION['valor']; ?>" size="10" tabindex="0" type="text" />

								</p>
							</div>
							<?php 
							}else{
							?>
								<div class="row field_text alignleft omega">
								<p>
									<label><strong>Valor R$*</strong> </label><br /> <input
										class="inputtext input_middle required" name="valor"
										id="valor"
										onkeypress="return formatar_moeda(this,'.',',',event);"
										size="10" tabindex="0" type="text" />

								</p>
							</div>
							<?php 
							}
							?>
							<div class="row field_text alignleft">
								<p>
									<label><strong>Número da Parcela</strong> </label><br /> <input
										class="inputtext input_middle required" name="numero_parcelas"
										id="numero_parcelas" value="" size="10" tabindex="0"
										type="text" />

								</p>
							</div>


							<div class="row field_textarea alignleft">
								<label><strong>Descrição do Pagamento</strong> </label><br />
								<textarea id="descricao" name="descricao"
									class="textarea textarea_middle required" cols="40" rows="10"></textarea>
							</div>

							<div class="row field_text alignleft omega ">
								<input value="Enviar Dados" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="valida_pagamento()" type="submit" /> <input
									value="Voltar" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="window.location = 'pagamentos.php'"
									type="submit" />
							</div>



							<?php
							}else{//recebimento
								?>

							<div class="row field_select alignleft">
								<label><strong>Status*</strong> </label> <select
									class="select_styled" name="status" id="status">

									<option value="a receber">à Receber</option>
									<option value="recebido">Recebido</option>

								</select>
							</div>

							<?php
							if (!empty($_SESSION['nome_paciente'])){
								$nome_paciente = $_SESSION['nome_paciente'];
								?>

							<div class="row field_text alignleft omega">
								<p>	
									<label><strong>Nome do Paciente*</strong> </label><br /> <input
										
										name="nome_paciente" id="nome_paciente"
																			
										value="<?php $nome_paciente; ?>" size="35" tabindex="10"
										type="text" />
								</p>
							</div>



							<?php
							}else if(!empty($_GET['nome_paciente'])){
								
								?>

							<div class="row field_text aligncenter">
								<p>
							
									<label><strong>Nome do Paciente*</strong> </label><br /> <input
										name="nome_paciente" id="nome_paciente"
										class="ac_input" value="<?php echo $_GET['nome_paciente']; ?>" size="35"
										tabindex="10" type="text" />
								</p>


							</div>
							<?php

							}else{
							?>
							<div class="row field_text aligncenter">
								<p>
							
									<label><strong>Nome do Paciente*</strong> </label><br /> <input
										name="nome_paciente" id="nome_paciente"
										class="ac_input" value="" size="35"
										tabindex="10" type="text" />
								</p>


							</div>
							<?php 
							}
							?>
							<div class="row field_text alignright">
								<p align="left">
									<label><strong>Data*</strong> </label><br /> <input
										class="inputtext input_middle required" name="data" id="data"
										value="" size="20" tabindex="20" type="text" />

								</p>
							</div>

							<div class="row field_text alignleft omega">
								<p>
									<label><strong>Valor R$*</strong> </label><br /> <input
										class="inputtext input_middle required" name="valor"
										id="valor"
										onkeypress="return formatar_moeda(this,'.',',',event);"
										size="10" tabindex="0" type="text" />

								</p>
							</div>


							<div class="row field_text alignleft">
								<p>
									<label><strong>Número da Parcela</strong> </label><br /> <input
										class="inputtext input_middle required" name="numero_parcelas"
										id="numero_parcelas" value="" size="10" tabindex="0"
										type="text" />

								</p>
							</div>


							<div class="row field_textarea alignleft">
								<label><strong>Descrição do Recebimento</strong> </label><br />
								<textarea id="descricao" name="descricao"
									class="textarea textarea_middle required" cols="40" rows="10"></textarea>
							</div>

							<div class="row field_text alignleft omega ">
								<input value="Enviar Dados" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="valida_recebimento()" type="submit" /> <input
									value="Voltar" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" onclick="window.location = 'pagamentos.php'"
									type="submit" />
							</div>

							<?php
							}
							?>














						</div>
						<!--/ content -->



						
					</div>
				</div>
			
			</div>
	<div class="clear"></div>
	</div>
		</div>
		</div>
		
		<?php
	}
}?>

</body>
</html>

<?php
session_start();
unset($_SESSION['ultimo_inserido']);
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if(!empty($_SESSION['nome_paciente'])){
	$nome_paciente = $_SESSION['nome_paciente'];

}else {
	$nome_paciente="";
}
if(!empty($_SESSION['email'])){
	$email = $_SESSION['email'];
}else{
	$email="";
}
if(!empty($_SESSION['dt_nasc'])){
	$data_nascimento = $_SESSION['dt_nasc'];
}else{
	$data_nascimento="";
}
if(!empty($_SESSION['cpf'])){
	$cpf = $_SESSION['cpf'];
}else{
	$cpf="";
}
if(!empty($_SESSION['rg'])){
	$rg = $_SESSION['rg'];
}else{
	$rg = "";
}
if(!empty($_SESSION['endereco'])){
	$endereco = $_SESSION['endereco'];
}else{
	$endereco = "";
}
if(!empty($_SESSION['bairro'])){
	$bairro = $_SESSION['bairro'];
}else {
	$bairro = "";
}
if(!empty($_SESSION['cidade'])){
	$cidade = $_SESSION['cidade'];
}else{
	$cidade = "";
}
if(!empty($_SESSION['estado'])){
	$estado = $_SESSION['estado'];
}else{
	$estado = "";
}
if(!empty($_SESSION['tel'])){
	$tel = $_SESSION['tel'];
}else{
	$tel = "";
}
if(!empty($_SESSION['cel'])){
	$cel = $_SESSION['cel'];
}else{
	$cel = "";
}
if(!empty($_SESSION['profissao'])){
	$profissao = $_SESSION['profissao'];
}else{
	$profissao = "";
}

if(!isset($_SESSION['usuario'])){
	header('Location:login.php');
}
else{
	$usuario = $_SESSION['usuario'];
	include 'conecta_banco.php';
	$query = "select * from pacientes where controle=0";
	$sql = mysql_query($query);
	if($sql)
	$count_sql = mysql_num_rows($sql);

	if(!empty($_GET['id_edit'])){


		$id_edit = $_GET['id_edit'];

		$query2 = "select * from pacientes where id=$id_edit and controle=0";
		$sql2 = mysql_query($query2);

		$nome_p_edit = mysql_result($sql2,0 ,'nome');
		$end_p_edit = mysql_result($sql2,0,'endereco');
		$tel_p_edit = mysql_result($sql2, 0,'telefone');
		$cel_p_edit = mysql_result($sql2,0,'celular');
		$email_p_edit = mysql_result($sql2,0,'email');
		$data = mysql_result($sql2,0,'dt_nasc');
		//recebe o parâmetro e armazena em um array separado por -
		$data_f = explode('-', $data);
		//armazena na variavel data os valores do vetor data e concatena /
		$data_form_edit = $data_f[2].'/'.$data_f[1].'/'.$data_f[0];
		$cpf_p_edit = mysql_result($sql2,0, 'cpf');
		$rg_p_edit = mysql_result($sql2,0,'rg');
		$bairro_p_edit = mysql_result($sql2,0,'bairro');
		$cidade_p_edit = mysql_result($sql2,0, 'cidade');
		$estado_p_edit = mysql_result($sql2, 0,'estado');
		$profissao_p_edit = mysql_result($sql2, 0,'profissao');
		 

	}


	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="ThemeFuse" />
<meta name="Description" content="A short description of your company" />
<meta name="Keywords" content="Some keywords that best describe your business" />
<title>Odontosyst</title>
<link href="HTML/style.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="HTML/js/jquery.min.js"></script>
<script type="text/javascript" src="HTML/js/preloadCssImages.js"></script>

<script type="text/javascript" language="JavaScript" src="HTML/js/general.js"></script>
<script type="text/javascript" language="JavaScript" src="HTML/js/jquery.tools.min.js"></script>
<script type="text/javascript" language="JavaScript" src="HTML/js/jquery.easing.1.3.js"></script>

<script type="text/javascript" language="JavaScript" src="HTML/js/slides.jquery.js"></script>
<script src="HTML/js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>


<script type="text/javascript">
function LimpaEditar() {
	if(document.getElementById('nome_paciente_edit').value!="") {
		document.getElementById('nome_paciente_edit').value="";
		document.getElementById('email_edit').value="";
		document.getElementById('tel_edit').value="";
		document.getElementById('cel_edit').value="";
		document.getElementById('cpf_edit').value="";
		document.getElementById('rg_edit').value="";
		document.getElementById('dt_nasc_edit').value="";
		document.getElementById('profissao_edit').value="";
		document.getElementById('endereco_edit').value="";
		document.getElementById('bairro_edit').value="";
		document.getElementById('cidade_edit').value="";
		document.getElementById('estado_edit').value="";
		
		
	
	}
}
</script>
<script>
jQuery(function($){
   $("#cpf").mask("999.999.999-99");
   $("#cpf_edit").mask("999.999.999-99");
   $("#rg").mask("99.999.999-9");
   $("#rg_edit").mask("99.999.999-9");
   $("#tel").mask("(99)9999-9999");
   $("#tel_edit").mask("(99)99999-9999");
   $("#cel").mask("(99)99999-9999");
   $("#cel_edit").mask("(99)99999-9999");
   $("#dt_nasc").mask("99/99/9999");
   $("#dt_nasc_edit").mask("99/99/9999");
   
  
});
</script>

<script language="Javascript"> 
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este usuário ?");   
	if (resposta == true) { 
		window.location.href = "excluir_paciente.php?id="+id; 
		} 
	} 
</script>
<script type="text/javascript">
function validate_cpf(cpf){
	 
	 //Limpa pontos e Traços da string
	 cpf = cpf.replace(/\./g, "");
	 cpf = cpf.replace(/\-/g, "");
	 cpf = cpf.replace(/\_/g, "");
	 
	 if(cpf.length!=11){ var result = false; };
	 
	 pri = eval(cpf.substring(0,3));
	 seg = eval(cpf.substring(4,7));
	 ter = eval(cpf.substring(8,11));
	 qua = eval(cpf.substring(12,14));
	 
	 var i;
	 var numero;
	 
	 numero = (pri+seg+ter+qua);
	 
	 c = cpf.substr(0,9);
	 
	 var dv = cpf.substr(9,2);
	 
	 var d1 = 0;
	 
	 for (i = 0; i < 9; i++){
	 d1 += c.charAt(i)*(10-i);
	 }
	 
	 if (d1 == 0){
	 var result = false;
	 }
	 
	 d1 = 11 - (d1 % 11);
	 if (d1 > 9) d1 = 0;
	 
	 if (dv.charAt(0) != d1){
	 var result = false;
	 }
	 
	 d1 *= 2;
	 for (i = 0; i < 9; i++){
	 d1 += c.charAt(i)*(11-i);
	 }
	 
	 d1 = 11 - (d1 % 11);
	 if (d1 > 9) d1 = 0;
	 
	 if (dv.charAt(1) != d1){
	 var result = false;
	 }
	 
	 if (result == false) {
	  alert("Digite o CPF no seguinte formato: 999.999.999-99");
	 }
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
		</div>
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
                                <th style="width: 25%">Endereço</th>
                                <th style="width: 25%">Telefones</th>
                                <th style="width: 25%">Data de Nascimento</th>
                                <th style="width: 25%">CPF</th>
                             
								
							</tr>
                        </thead>
                       <tbody>
                       <?php
                       if ($sql){
                       	for($i=0;$i<$count_sql;$i++){
                       		$id = mysql_result($sql, $i, 'id');
                       		$nome_p = mysql_result($sql, $i,'nome');
                       		$end_p = mysql_result($sql, $i,'endereco');
                       		$tel_p = mysql_result($sql, $i,'telefone');
                       		$cel_p = mysql_result($sql, $i,'celular');
                       		$email_p = mysql_result($sql, $i,'email');
                       		$data = mysql_result($sql, $i,'dt_nasc');
                       		//recebe o parâmetro e armazena em um array separado por -
                       		$data_f = explode('-', $data);
                       		//armazena na variavel data os valores do vetor data e concatena /
                       		$data_form = $data_f[2].'/'.$data_f[1].'/'.$data_f[0];
                       		$cpf_p = mysql_result($sql, $i,'cpf');
                       		$rg_p = mysql_result($sql, $i,'rg');
                       		$bairro_p = mysql_result($sql, $i,'bairro');
                       		$cidade_p = mysql_result($sql, $i,'cidade');
                       		$estado_p = mysql_result($sql, $i,'estado');



                       		echo '<tr>';
                       		echo "<td><a href='novo_paciente.php?id_edit=$id'><img title='Detalhes do Paciente' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma($id)'><img title='Excluír Paciente' border='0' src='icon_x2.png' width='15' height='10'></a>
		                                		                                		
		                                </td>";

                       		echo "<td>$nome_p</td>";
                       		echo "<td>$end_p</td>";
                       		echo "<td>$tel_p $cel_p </td>";
                       		//   echo "<td>$email_p</td>";
                       		echo "<td>$data_form</td>";
                       		echo "<td>$cpf_p</td>";
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
							<li class="menu-item-home parent current-menu-ancestor"><a href="#"><span>Cadastramento</span> </a>
								<ul>
									<li class="menu-item-home"><a href="novo_usuario.php"><span>Controle
												de Usu&aacute;rios</span> </a>
									</li>
									<li class="current-menu-item"><a href="novo_paciente.php"><span>Controle
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
							<li><a href="#"><span>Financeiro</span> </a>
								<ul>
									<li><a href="pagamentos.php"><span>Pagamentos</span> </a></li>
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
							
							<h1>
								<br>Cadastramento de Paciente</br>
							</h1>
							<input value="Limpar Campos" title="send" class="button_styled"
								style="background: #474747; color: #ffffff; border: 1px solid #474747;"
								id="send" type="button" onclick="LimpaEditar()" />

							<form action="cadastro_pacientes_validar.php" method="post"
								name="cadastro_pacientes">
								<?php
								if(!empty($_GET['id_edit'])){
									?>


								<div class="row field_text alignleft">
									<p>
										<label><strong>Nome do Paciente*</strong> </label><br /> <input
											name="nome_paciente_edit" id="nome_paciente_edit"
											class="inputtext input_middle required"
											value="<?php echo $nome_p_edit;?>" size="35" tabindex="10"
											type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>E-mail*</strong> </label><br /> <input
											name="email_edit" id="email_edit"
											class="inputtext input_middle required"
											value="<?php echo $email_p_edit;?>" size="20" tabindex="20"
											type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Telefone*</strong> </label><br /> <input
											class="inputtext input_middle required" name="tel_edit"
											id="tel_edit" value="<?php echo $tel_p_edit;?>" size="20"
											tabindex="20" type="text"/>
									
									</p>
								</div>
								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Celular*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cel_edit"
											id="cel_edit" value="<?php echo $cel_p_edit;?>" size="20"
											tabindex="20" type="text"/>
									
									</p>
								</div>



								<div class="row field_text alignleft">
									<p>
										<label><strong>CPF*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cpf_edit"
											id="cpf_edit" value="<?php echo $cpf_p_edit;?>"
											onblur="validate_cpf(this.value)" size="20" tabindex="20"
											type="text"/>
									
									</p>
								</div>



								<div class="row field_text alignleft omega">
									<p>
										<label><strong>RG*</strong> </label><br /> <input
											class="inputtext input_middle required" name="rg_edit"
											id="rg_edit" value="<?php echo $rg_p_edit;?>" size="20"
											tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Data de Nascimento*</strong> </label><br /> <input
											class="inputtext input_middle required" name="dt_nasc_edit"
											id="dt_nasc_edit" value="<?php echo $data_form_edit;?>"
											size="10" tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Profiss&atilde;o*</strong> </label><br /> <input
											class="inputtext input_middle required" name="profissao_edit"
											id="profissao_edit" value="<?php echo $profissao_p_edit;?>"
											size="35" tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Endere&ccedil;o*</strong> </label><br /> <input
											class="inputtext input_middle required" name="endereco_edit"
											id="endereco_edit" value="<?php echo $end_p_edit;?>"
											size="10" tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Bairro*</strong> </label><br /> <input
											class="inputtext input_middle required" name="bairro_edit"
											id="bairro_edit" value="<?php echo $bairro_p_edit;?>"
											size="35" tabindex="20" type="text" />
									</p>
								</div>

								<div class="row field_text alignleft ">
									<p>
										<label><strong>Cidade*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cidade_edit"
											id="cidade_edit" value="<?php echo $cidade_p_edit;?>"
											size="35" tabindex="20" type="text" />
									</p>
								</div>


								<div class="row field_text alignleft omega">
									<div class="row field_select">
										<label><strong>Estado*</strong> </label><br /> <select
											class="select_styled" name="estado_edit" id="estado_edit">
											<option value="<?php $estado_p_edit;?> ">
											<?php echo $estado_p_edit; ?>
											</option>
											<option value="ac">AC</option>
											<option value="al">AL</option>
											<option value="ap">AP</option>
											<option value="am">AM</option>
											<option value="ba">BA</option>
											<option value="ce">CE</option>
											<option value="df">DF</option>
											<option value="es">ES</option>
											<option value="GO">GO</option>
											<option value="ma">MA</option>
											<option value="mt">MT</option>
											<option value="ms">MS</option>
											<option value="mg">MG</option>
											<option value="pa">PA</option>
											<option value="pb">PB</option>
											<option value="pr">PR</option>
											<option value="pe">PE</option>
											<option value="pi">PI</option>
											<option value="rj">RJ</option>
											<option value="rn">RN</option>
											<option value="rs">RS</option>
											<option value="ro">RO</option>
											<option value="rr">RR</option>
											<option value="sc">SC</option>
											<option value="sp">SP</option>
											<option value="se">SE</option>
											<option value="to">TO</option>
										</select>
									</div>
								</div>
								<?php
								$var_controle=1;
								echo "<input type='hidden' name='var_controle' id='var_controle' value='$var_controle'>";
								echo "<input type='hidden' name='id_edit' id='id_edit' value='$id_edit'>";
								}else{

									?>



								<div class="row field_text alignleft">
									<p>
										<label><strong>Nome do Paciente*</strong> </label><br /> <input
											name="nome_paciente" id="nome_paciente"
											class="inputtext input_middle required"
											value="<?php echo $nome_paciente;?>" size="35" tabindex="10"
											type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>E-mail*</strong> </label><br /> <input
											name="email" id="email"
											class="inputtext input_middle required"
											value="<?php echo $email;?>" size="20" tabindex="20"
											type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Telefone*</strong> </label><br /> <input
											class="inputtext input_middle required" name="tel" id="tel"
											value="<?php echo $tel;?>" size="20" tabindex="20"
											type="text"/>
									
									</p>
								</div>
								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Celular*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cel" id="cel"
											value="<?php echo $cel;?>" size="20" tabindex="20"
											type="text"/>
									
									</p>
								</div>



								<div class="row field_text alignleft">
									<p>
										<label><strong>CPF*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cpf" id="cpf"
											value="<?php echo $cpf;?>" onblur="validate_cpf(this.value)"
											size="20" tabindex="20" type="text"/>
									
									</p>
								</div>



								<div class="row field_text alignleft omega">
									<p>
										<label><strong>RG*</strong> </label><br /> <input
											class="inputtext input_middle required" name="rg" id="rg"
											value="<?php echo $rg;?>" size="20" tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Data de Nascimento*</strong> </label><br /> <input
											class="inputtext input_middle required" name="dt_nasc"
											id="dt_nasc" value="<?php echo $data_nascimento;?>" size="10"
											tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Profiss&atilde;o*</strong> </label><br /> <input
											class="inputtext input_middle required" name="profissao"
											id="profissao" value="<?php echo $profissao;?>" size="35"
											tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft">
									<p>
										<label><strong>Endere&ccedil;o*</strong> </label><br /> <input
											class="inputtext input_middle required" name="endereco"
											id="endereco" value="<?php echo $endereco;?>" size="10"
											tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft omega">
									<p>
										<label><strong>Bairro*</strong> </label><br /> <input
											class="inputtext input_middle required" name="bairro"
											id="bairro" value="<?php echo $bairro;?>" size="35"
											tabindex="20" type="text"/>
									
									</p>
								</div>

								<div class="row field_text alignleft ">
									<p>
										<label><strong>Cidade*</strong> </label><br /> <input
											class="inputtext input_middle required" name="cidade"
											id="cidade" value="<?php echo $cidade;?>" size="35"
											tabindex="20" type="text"/>
									
									</p>
								</div>


								<div class="row field_text alignleft omega">
									<div class="row field_select">
										<label><strong>Estado*</strong> </label><br /> <select
											class="select_styled" name="estado" id="estado">
											<option value="nd">--</option>
											<option value="ac">AC</option>
											<option value="al">AL</option>
											<option value="ap">AP</option>
											<option value="am">AM</option>
											<option value="ba">BA</option>
											<option value="ce">CE</option>
											<option value="df">DF</option>
											<option value="es">ES</option>
											<option value="GO">GO</option>
											<option value="ma">MA</option>
											<option value="mt">MT</option>
											<option value="ms">MS</option>
											<option value="mg">MG</option>
											<option value="pa">PA</option>
											<option value="pb">PB</option>
											<option value="pr">PR</option>
											<option value="pe">PE</option>
											<option value="pi">PI</option>
											<option value="rj">RJ</option>
											<option value="rn">RN</option>
											<option value="rs">RS</option>
											<option value="ro">RO</option>
											<option value="rr">RR</option>
											<option value="sc">SC</option>
											<option value="sp">SP</option>
											<option value="se">SE</option>
											<option value="to">TO</option>
										</select>
									</div>
								</div>
								<?php
								$var_controle=0;
								echo "<input type='hidden' name='var_controle' id='var_controle' value='$var_controle'>";
								}

								?>
								<div class="row field_text alignleft ">
									<div class="row">
										<div class="entry">
											<input value="Enviar Dados" title="send"
												class="button_styled"
												style="background: #474747; color: #ffffff; border: 1px solid #474747;"
												id="send" type="submit" />
										</div>

									</div>

								</div>

							</form>

						</div>

					</div>
				</div>
				<!--/ content -->



				<div class="clear"></div>
			</div>
		</div>
		<div class="middle_bot"></div>

	</div>
</body>
</html>
								<?php
}
?>
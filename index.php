<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';
//define('GUSER', 'danilo.dan4@gmail.com');	// <-- Insira aqui o seu GMail
//define('GPWD', '07364847');		// <-- Insira aqui a senha do seu GMail
unset($_SESSION['nome_recebedor']);
unset($_SESSION['dentista_nome']);
unset($_SESSION['tipo_conta']);
unset($_SESSION['fornecedor']);
unset($_SESSION['ie']);
unset($_SESSION['cnpj']);
unset($_SESSION['endereco']);
unset($_SESSION['obs']);
unset($_SESSION['email']);
unset($_SESSION['bairro']);
unset($_SESSION['cidade']);
unset($_SESSION['estado']);
unset($_SESSION['fornecedor']);
unset($_SESSION['tel']);
unset($_SESSION['nome_paciente']);
unset($_SESSION['nome_medicamento']);
unset($_SESSION['estoque']);
unset($_SESSION['dados_ad']);
unset($_SESSION['nome_procedimento']);
unset($_SESSION['valor']);
unset($_SESSION['ultimo_inserido']);
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if(!isset($_SESSION['usuario'])){
	header('Location:login.php');
}
else{
	//echo 'entrei';
	//**envio de email para pacientes com consultas agendadas para amanha**//
	$qry_email = "select a.data,a.horario, a.dentista_nome, b.email, b.nome,b.celular from agenda a
					inner join pacientes b
					where a.id_paciente = b.id and data = curdate() + 1";
	//echo $qry_email;
	$exec_qry_email = mysql_query($qry_email);
	$count = mysql_num_rows($exec_qry_email);
	//echo $count;
	for($i=0; $i<$count; $i++){
		//echo 'entrei';
		$data_sms = mysql_result($exec_qry_email, $i,'a.data');
		$horario_sms = mysql_result($exec_qry_email, $i,'a.horario');
		$nome_p_sms = mysql_result($exec_qry_email, $i,'b.nome');
		//$end_email = mysql_result($exec_qry_email, $i,'b.email');
		$nome_dentista_sms = mysql_result($exec_qry_email,$i,'a.dentista_nome');
		$nome_dentista = ucfirst($nome_dentista_sms);
		//echo $nome_dentista;
		
		$sms_cel = mysql_result($exec_qry_email, $i, 'b.celular');
				
		// Constantes - Valores obtidos no menu Ferramentas -> Gateway do Mister Postman
		$UserID = '7b454be3-635e-4acc-8c6c-3e99241b6179';
		$Token = '17705486';

		// numero destino -  2 digitos codigo pais ( Brasil = 55 ) + 2 digitos codigo de area + numero do celular
		$destino = $sms_cel;

		// mensagem a ser enviada
		$mensagem = "$nome_p_sms, voce tem uma consulta odontologica agendada amanha as $horario_sms com o Dr.$nome_dentista. Caso nao possa comparecer, favor ligar para 11 1111-1111.";
		//echo $mensagem;
		// Codifica a mensagem - URLEncode
		$mensagem = urlencode($mensagem);
	
		$URLGateway = 'http://www.misterpostman.com.br/gateway.aspx?UserID='.$UserID.'&Token='.$Token.'&NroDestino='.$destino.'&Mensagem='.$mensagem.'';

		// Aciona o Gateway  - Opção ideal para PHP 4.3.x ou superior
		$Content = file_get_contents($URLGateway);

		// Coloca no video a resposta do gateway
		//echo $Content;
		


	}


	$usuario = $_SESSION['usuario'];
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
$().ready(function() {
    $("#s").autocomplete("sugerir_nome_paciente.php", {
        width: 260,
        matchContains: true,
        selectFirst: true
    });
});
</script>
<script type="text/javascript">
function teste(){
	var valor = document.getElementById('s').value;
    if(valor != "" && valor != "Pesquisar Paciente"){
    	window.location.href = "index.php?valor="+valor; 
    }
    else{
    	alert("Digite o nome de algum paciente");
		window.location = 'index.php';
   }
	
}

</script>
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
			<!-- search widget -->

			<div class="contact-form">

				<div>

					<input class="ac_input" name="s" id="s" value="Pesquisar Paciente"
						type="text" onfocus="javascript:this.value=''" /><input
						id="searchsubmit" class="btn-submit" value=""
						title="Clique para Pesquisar" onclick="teste()" type="submit" />
					<p align="left"></p>
				</div>

			</div>
			<!--/ search widget -->

			<div class="header_menu">
				<div class="container">
					<div class="topmenu" align="left">
						<ul class="dropdown">
							<li class="menu-item-home parent current-menu-ancestor"><a
								href="index.php"><span>In&iacute;cio</span> </a></li>
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
			<?php
			if(!empty($_GET['valor'])){
				$nome_paciente = $_GET['valor'];
				$qry = "select * from pacientes where nome='$nome_paciente'";
				$sql = mysql_query($qry);

				$id = mysql_result($sql, 0, 'id');
				$endereco = mysql_result($sql, 0, 'endereco');
				$tel = mysql_result($sql, 0, 'telefone');
				$cel = mysql_result($sql, 0, 'celular');
				$email = mysql_result($sql, 0, 'email');
				$id = mysql_result($sql, 0, 'id');
				$dt_nasc = mysql_result($sql, 0, 'dt_nasc');
				$cpf = mysql_result($sql, 0, 'cpf');
				$rg = mysql_result($sql, 0, 'rg');
				$bairro = mysql_result($sql, 0, 'bairro');
				$cidade = mysql_result($sql, 0, 'cidade');
				$estado = mysql_result($sql, 0, 'estado');
				$profissao = mysql_result($sql, 0, 'profissao');
				//$qry2 = "SELECT a . * , b . * FROM pacientes a INNER JOIN agenda b WHERE b.id_paciente = $id";



				?>




			<!-- header image/slider -->
			<div class="header_bot header_slider">
				<div class="container_12">
				
				<h2><a href='index.php'><img title='Limpar Nome do Paciente' border='0' src='icon_x2.png' width='15' height='10'></a>
				<?php echo $nome_paciente;?></h2>
					<!-- showcase slider -->

					<div class="showcase-slide">
						<div class="showcase-content">
							<pre class="brush: plain">
							</pre>


							<div class="tabs_framed small_tabs">

								<ul class="tabs">
									<li><a href="#tabs_1_1">Agenda</a></li>
									<li><a href="#tabs_1_2">Dados do Paciente</a></li>
									<li><a href="#tabs_1_3">Orçamentos</a></li>
									<li><a href="#tabs_1_4">Pagamentos</a></li>
									<li><a href="#tabs_1_5">Consultas</a></li>

								</ul>

								<div id="tabs_1_1" class="tabcontent">
									<div class="middle sidebarRight">
										<div class="container_12">

											<!-- content -->
											<div class="grid_8 content">

												<div class="post-item">

													<div class="contact-form">

														<!-- widget_reservation -->
														<div class="widget-container widget_reservation">

															<!-- column 2 -->
															<div class="col col_1_2 alpha">
																<iframe
																	src="https://www.google.com/calendar/embed?title=Agenda&amp;height=600&amp;wkst=1&amp;hl=pt_BR&amp;bgcolor=%239999ff&amp;src=dmessias%40gmail.com&amp;color=%232952A3&amp;ctz=America%2FSao_Paulo"
																	style="border: solid 1px #777" width="930" height="500"
																	frameborder="0" scrolling="no"> </iframe>
															</div>
															<!--/ column 2 -->



														</div>
														<!--/ widget_reservation -->


														<div class="clear"></div>
													</div>
												</div>

												<!--/ middle -->
											</div>
										</div>
									</div>
								</div>

								<div id="tabs_1_2" class="tabcontent">
									<div class="middle sidebarRight">
										<div class="grid_8 content">
											<div class="post-item">
												<div class="contact-form">
													<div class="row field_text alignleft">
														<p>
															<label><strong>Nome do Paciente</strong> </label><br /> <input
																name="nome_paciente" id="nome_paciente"
																class="inputtext input_middle required"
																value="<?php echo $nome_paciente;?>" size="35"
																tabindex="10" type="text" />

														</p>
													</div>
													<div class="row field_text alignleft omega">
														<p>
															<label><strong>E-mail</strong> </label><br /> <input
																name="email" id="email"
																class="inputtext input_middle required"
																value="<?php echo $email;?>" size="20" tabindex="20"
																type="text" />

														</p>
													</div>

													<div class="row field_text alignleft">
														<p>
															<label><strong>Telefone</strong> </label><br /> <input
																class="inputtext input_middle required" name="tel"
																id="tel" value="<?php echo $tel;?>" size="20"
																tabindex="20" type="text" />

														</p>
													</div>
													<div class="row field_text alignleft omega">
														<p>
															<label><strong>Celular</strong> </label><br /> <input
																class="inputtext input_middle required" name="cel"
																id="cel" value="<?php echo $cel;?>" size="20"
																tabindex="20" type="text" />

														</p>
													</div>



													<div class="row field_text alignleft">
														<p>
															<label><strong>CPF</strong> </label><br /> <input
																class="inputtext input_middle required" name="cpf"
																id="cpf" value="<?php echo $cpf;?>"
																onblur="validate_cpf(this.value)" size="20"
																tabindex="20" type="text" />

														</p>
													</div>



													<div class="row field_text alignleft omega">
														<p>
															<label><strong>RG</strong> </label><br /> <input
																class="inputtext input_middle required" name="rg"
																id="rg" value="<?php echo $rg;?>" size="20"
																tabindex="20" type="text" />

														</p>
													</div>

													<div class="row field_text alignleft">
														<p>
															<label><strong>Data de Nascimento</strong> </label><br />
															<input class="inputtext input_middle required"
																name="dt_nasc" id="dt_nasc"
																value="<?php echo $dt_nasc;?>" size="10" tabindex="20"
																type="text" />

														</p>
													</div>

													<div class="row field_text alignleft omega">
														<p>
															<label><strong>Profiss&atilde;o</strong> </label><br /> <input
																class="inputtext input_middle required" name="profissao"
																id="profissao" value="<?php echo $profissao;?>"
																size="35" tabindex="20" type="text" />

														</p>
													</div>

													<div class="row field_text alignleft">
														<p>
															<label><strong>Endere&ccedil;o</strong> </label><br /> <input
																class="inputtext input_middle required" name="endereco"
																id="endereco" value="<?php echo $endereco;?>" size="10"
																tabindex="20" type="text" />

														</p>
													</div>

													<div class="row field_text alignleft omega">
														<p>
															<label><strong>Bairro</strong> </label><br /> <input
																class="inputtext input_middle required" name="bairro"
																id="bairro" value="<?php echo $bairro;?>" size="35"
																tabindex="20" type="text" />

														</p>
													</div>

													<div class="row field_text alignleft ">
														<p>
															<label><strong>Cidade</strong> </label><br /> <input
																class="inputtext input_middle required" name="cidade"
																id="cidade" value="<?php echo $cidade;?>" size="35"
																tabindex="20" type="text" />

														</p>
													</div>


												

													<div class="clear"></div>
												</div>

											</div>
										</div>

									</div>
								</div>
								<div id="tabs_1_3" class="tabcontent">
									<div class="post-item">
										<div class="col col_1_2 ">
											<div class="inner" align="left">
												<h2>Orçamentos</h2>
												<div class="styled_table table_turquoise" align="center">
													<table id="tabela_1" width="50%" cellpadding="0"
														cellspacing="0">
														<thead>
															<tr class="tr_1">
															<th style="width: 25%">Código do Procedimento</th>
																<th style="width: 25%">Nome do Procedimento</th>
																<th style="width: 25%">Nº do Dente</th>
																<th style="width: 25%">Valor</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$qry3 = "SELECT a.id_orcamento, a.id_procedimento, b.nome_procedimento, b.numero_dente, b.fk_cod_proc, c.cod_procedimento, c.valor_procedimento, c.nome_procedimento, d.nome
																FROM orcamento_procedimento a
																INNER JOIN orcamento b ON a.id_orcamento = b.id
																INNER JOIN procedimentos c ON a.id_procedimento = c.id
																INNER JOIN pacientes d ON d.id = b.fk_pacientes
																WHERE d.id =$id";
														$exec_qry5 = mysql_query($qry3);
														if($exec_qry5)
														$count = mysql_num_rows($exec_qry5);
														for($i=0;$i<$count;$i++){
															$proc_cod = mysql_result($exec_qry5, $i,'c.cod_procedimento');
															$nome_proc = mysql_result($exec_qry5, $i,'c.nome_procedimento');
															$numero_dente = mysql_result($exec_qry5, $i,'b.numero_dente');
															$valor = mysql_result($exec_qry5, $i,'c.valor_procedimento');
															$id_procedimento = mysql_result($exec_qry5, $i,'a.id_procedimento');
															echo '<tr>';
															echo "<td>$proc_cod</td>";
															echo "<td>$nome_proc</td>";
															echo "<td>$numero_dente</td>";
															echo "<td>$valor</td>";

															echo '</tr>';
														}
														?>
														</tbody>
													</table>
												</div>
											</div>
											
											
										</div>
										
										<!--/ entry -->

									</div>
								</div>
								<div id="tabs_1_4" class="tabcontent">
									<div class="post-item">
										<div class="col col_1_2 ">
											<div class="inner" align="left">
												<h2>Contas</h2>
												<div class="styled_table table_turquoise" align="center">
													<table id="tabela_1" width="50%" cellpadding="0"
														cellspacing="0">
														<thead>
															<tr class="tr_1">
															<th style="width: 25%">Descrição</th>
																<th style="width: 25%">R$</th>
																<th style="width: 25%">Data</th>
																<th style="width: 25%">Status</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$qry3 = "select * from pag_receber where fk_id_paciente=$id";
														$exec_qry3 = mysql_query($qry3);
														if($exec_qry3)
															$count = mysql_num_rows($exec_qry3);
														for($i=0;$i<$count;$i++){
															$descricao = mysql_result($exec_qry3, $i,'rec_descricao');
															$valor = mysql_result($exec_qry3, $i, 'rec_valor');
															$data = mysql_result($exec_qry3, $i, 'rec_valor');
															$status = mysql_result($exec_qry3, $i, 'status');
															echo '<tr>';
															echo "<td>$descricao</td>";
															echo "<td>$valor</td>";
															echo "<td>$data</td>";
															echo "<td>$status</td>";

															echo '</tr>';
														}
														?>
														</tbody>
													</table>
												</div>
											</div>
											
											
										</div>
										
										<!--/ entry -->

									</div>
								</div>
								<div id="tabs_1_5" class="tabcontent">
								<div class="post-item">
										<div class="col col_1_2 ">
											<div class="inner" align="left">
												<h2>Consultas Agendadas</h2>
												<div class="styled_table table_turquoise" align="center">
													<table id="tabela_1" width="50%" cellpadding="0"
														cellspacing="0">
														<thead>
															<tr class="tr_1">
																<th style="width: 25%">Horário</th>
																<th style="width: 25%">Dentista</th>
																<th style="width: 25%">Data</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$qry4 = "select horario,dentista_nome,data from agenda where id_paciente=$id order by data";
														//echo $id;
														$exec_qry4 = mysql_query($qry4);
														if($exec_qry4)
															$count = mysql_num_rows($exec_qry4);
														for($i=0;$i<$count;$i++){
															$horario = mysql_result($exec_qry4, $i,'horario');
															$dentista = mysql_result($exec_qry4, $i, 'dentista_nome');
															$data = mysql_result($exec_qry4, $i, 'data');
															$data_format =formata_data($data);
															//$status = mysql_result($exec_qry4, $i, 'status');
															echo '<tr>';
															echo "<td>$horario</td>";
															echo "<td>$dentista</td>";
															echo "<td>$data_format</td>";
															

															echo '</tr>';
														}
														?>
														</tbody>
													</table>
												</div>
											</div>
											
											
										</div>
										
										<!--/ entry -->

									</div>
								
								</div>



								<div class="clear"></div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>





		<?php }else{

			//unset($nome_paciente);


			?>



		<div class="header_bot header_slider">
			<div class="container_12">

				<!-- showcase slider -->

				<div class="showcase-slide">
					<div class="showcase-content">
						<pre class="brush: plain">
							</pre>


						<div class="tabs_framed small_tabs">

							<ul class="tabs">
								<li><a href="#tabs_1_1">Agenda</a></li>


							</ul>

							<div id="tabs_1_1" class="tabcontent">
								<div class="middle sidebarRight">
									<div class="container_12">

										<!-- content -->
										<div class="grid_8 content">

											<div class="post-item">

												<div class="contact-form">

													<!-- widget_reservation -->
													<div class="widget-container widget_reservation">

														<!-- column 2 -->
														<div class="col col_1_2 alpha">
															<iframe
																src="https://www.google.com/calendar/embed?title=Agenda&amp;height=600&amp;wkst=1&amp;hl=pt_BR&amp;bgcolor=%239999ff&amp;src=dmessias%40gmail.com&amp;color=%232952A3&amp;ctz=America%2FSao_Paulo"
																style="border: solid 1px #777" width="930" height="500"
																frameborder="0" scrolling="no"></iframe>
														</div>
														<!--/ column 2 -->



													</div>
													<!--/ widget_reservation -->


													<div class="clear"></div>
												</div>
											</div>

											<!--/ middle -->
										</div>
									</div>
								</div>
							</div>


							<div class="clear"></div>

						</div>
					</div>
				</div>
			</div>
		</div>







		<?php
		}
}//fim do else
?>
		<div class="clear"></div>
	</div>
</body>

</html>

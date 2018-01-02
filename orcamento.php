<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';
//$qry = "select * from orcamento";
//$execqry = mysql_query($qry);

if (!empty($_GET['ultimo'])){
	//echo 'entrei a';
	$ultimo = $_GET['ultimo'];

	$_SESSION['ultimo_inserido'] = $ultimo;
	$id_orcamento = $ultimo;
	//unset($_SESSION['id_paciente_fk']);
}
else if (empty($_GET['ultimo']) && empty($_GET['procedimento'])) {
	//echo 'entrei b';
	unset($_SESSION['ultimo_inserido']);
	unset($_SESSION['nome_paciente_fk']);
	unset($_SESSION['id_paciente_fk']);
	$sql_n_orcamento = "select MAX(id) as id from orcamento";
	$execsql = mysql_query($sql_n_orcamento);
	$id_orcamento = mysql_result($execsql, 0, 'id');
	$id_orcamento += 1;
}
else{
	//echo 'entrei c';
	$sql_n_orcamento = "select MAX(id) as id from orcamento";
	$execsql = mysql_query($sql_n_orcamento);
	$id_orcamento = mysql_result($execsql, 0, 'id');
}


echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
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
<script type="text/javascript">
function chamaOrcamento(){
	var quadrante = document.getElementById('posicao_dente').value;
	var procedimento = document.getElementById('nome_procedimento').value;
	var n_dente = document.getElementById('n_dente').value;
	var descricao = document.getElementById('descricao').value;
	if( document.getElementById("parcelas") )
    	var parcelas = document.getElementById('parcelas').value;

	var paciente = document.getElementById('s').value;

	if(procedimento == ""){
		alert("Preencha o campo Nome do Procedimento");
	}else{
		 if(paciente=="vazio"){
	    		alert("Preecha o campo Nome do Paciente");
	    	
	    }else{
	    	 if(quadrante == ""){
	    	    	alert("Selecione uma opção no campo Quadrante");
	    	     }else{
	    	    	    if(n_dente == ""){
	    	    	    	alert("Preencha o campo Nº do Dente");
	    	    	     }
	    	    	    else{
	    	    	    	if(quadrante == "primeiro"){
								if(n_dente < 11 || n_dente > 18){
									alert("Dente nao é válido para este quadrante");
	    	    	    		}else{
	    	    	    			window.location.href = "orcamento_validar.php?paciente="+paciente+"&quadrante="+quadrante+"&procedimento="+procedimento+"&n_dente="+n_dente+"&descricao="+descricao+"&parcelas="+parcelas; 
	    	    	    			
		    	    	    	}
	    	    	    	}
								if(quadrante == "segundo"){
									if(n_dente < 21 || n_dente > 28){
										alert("Dente nao é válido para este quadrante");
									 }else{
										 window.location.href = "orcamento_validar.php?paciente="+paciente+"&quadrante="+quadrante+"&procedimento="+procedimento+"&n_dente="+n_dente+"&descricao="+descricao+"&parcelas="+parcelas; 
									 }
								}
								if(quadrante == "terceiro"){
									if(n_dente < 31 || n_dente > 38){
										alert("Dente nao é válido para este quadrante");
									}else{
										window.location.href = "orcamento_validar.php?paciente="+paciente+"&quadrante="+quadrante+"&procedimento="+procedimento+"&n_dente="+n_dente+"&descricao="+descricao+"&parcelas="+parcelas; 
										
									}
								}
							if(quadrante == "quarto"){
								if(n_dente < 41 || n_dente > 48){
									alert("Dente nao é válido para este quadrante");
								}
								else{
									window.location.href = "orcamento_validar.php?paciente="+paciente+"&quadrante="+quadrante+"&procedimento="+procedimento+"&n_dente="+n_dente+"&descricao="+descricao+"&parcelas="+parcelas; 
									
								}
							}
								
								

		    	    	}
	    	    }
		}
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

			<h3 class="toggle box" align="center">
				Ver Todos os Procedimentos<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
        <div class="styled_table table_turquoise" align="center">
                    <table id="tabela" width="70%" cellpadding="0"
							cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width: 25%">Ação</th>
                            	<th style="width: 25%">Código Procedimento</th>
                                <th style="width: 25%">Nome Procedimento</th>
                                <th style="width: 25%">Valor R$</th>
                          	</tr>
                        </thead>
                         <tbody>
                         <?php
                         $query = "select * from procedimentos";
                         $sql = mysql_query($query);
                         $count = mysql_num_rows($sql);
                         if($sql && $count > 0){
                         	for($i=0; $i < $count; $i++){

                         		$id = mysql_result($sql, $i,'id');
                         		$cod_procedimento = mysql_result($sql, $i, 'cod_procedimento');
                         		$nome_procedimento = mysql_result($sql, $i, 'nome_procedimento');
                         		$valor_procedimento = mysql_result($sql, $i, 'valor_procedimento');




                         		echo '<tr>';
                         		echo "<td><a href='orcamento.php?procedimento=$nome_procedimento'><img title='Selecionar Procedimento' border='0' src='icon_check2.png' width='15' height='10'></a>
		                   
		                                		                                		
		                                </td>";

                         		echo "<td>$cod_procedimento</td>";
                         		echo "<td>$nome_procedimento</td>";
                         		echo "<td>$valor_procedimento</td>";

                         		// echo "<td>$cidade_p</td>";






                         	}
                         	?>
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
							<li class="menu-item-home parent current-menu-ancestor"><a href="#"><span>Financeiro</span> </a>
								<ul>
									<li class="menu-item-home"><a href="pagamentos.php"><span>Pagamentos</span> </a></li>
									<li class="current-menu-item"><a href="orcamento.php"><span>Orçamento</span> </a></li>


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
			<!-- middle -->
			<div class="middle sidebarRight">
				<div class="container_12">

					<!-- content -->
					<div class="grid_8 content">



						<div class="post-item">

							<br />*Campos Obrigatórios <br />

							<h1>Orçamento</h1>

							<div class="entry">


								<p>
									<img src="HTML/images/Quadrantes_dentes.jpg" alt="" width="612"
										height="330" border="0" class="frame_center" />
								</p>
								<div class="contact-form">
								<?php
								if (empty($_SESSION['nome_paciente_fk'])){

									?>

									<?php
									if (empty($_GET['procedimento'])){
										//echo 'if1';
										?>
									<div class="row field_text alignleft">
										<strong><label>Nome do Procedimento*</label> </strong><br /> <input
											name="nome_procedimento" value="" id="nome_procedimento"
											class="inputtext required" size="40" type="text" />

									</div>
									<?php
									}else {
										?>
									<div class="row field_text alignleft">
										<strong><label>Nome do Procedimento*</label> </strong><br /> <input
											name="nome_procedimento"
											value="<?php echo $_GET['procedimento'];?>"
											id="nome_procedimento" class="inputtext required" size="40"
											type="text" />

									</div>

									<?php


									}?>
									<div class="row field_text alignleft">
										<strong><label>Nome do Paciente*</label> </strong><br /> <input
											name="s" value="" id="s" class="inputtext required" size="40"
											type="text" onfocus="javascript:this.value=''" />

									</div>

									<?php
								}else{

									$nome_paciente = $_SESSION['nome_paciente_fk'];

									?>



									<?php
									if (empty($_GET['procedimento'])){

										?>
									<div class="row field_text alignleft">
										<strong><label>Nome do Procedimento*</label> </strong><br /> <input
											name="nome_procedimento" value="" id="nome_procedimento"
											class="inputtext required" size="40" type="text" />

									</div>
									<?php
									}else {
										?>
									<div class="row field_text alignleft">
										<strong><label>Nome do Procedimento*</label> </strong><br /> <input
											name="nome_procedimento"
											value="<?php echo $_GET['procedimento'];?>"
											id="nome_procedimento" class="inputtext required" size="40"
											type="text" />

									</div>
									<?php


									}

									?>

									<div class="row field_text alignleft">
										<strong><label>Nome do Paciente*</label> </strong><br /> <input
											name="s" value="<?php echo $nome_paciente?>" id="s"
											class="inputtext required" size="40" type="text"
											onfocus="javascript:this.value=''" />

									</div>



									<?php
								}
								?>
									<div class="row field_select" align="left">

										<label><strong>Quadrante do Dente*</strong> </label><br /> <select
											class="select_styled" name="posicao_dente" id="posicao_dente">
											<option value='vazio'>--</option>
											<option value='primeiro'>Primeiro Quadrante</option>
											<option value='segundo'>Segundo Quadrante</option>
											<option value='terceiro'>Terceiro Quadrante</option>
											<option value='quarto'>Quarto Quadrante</option>
										</select>
									</div>

									<div class="row field_text alignleft omega">
										<strong><label>Nº do Dente*</label> </strong><br /> <input
											name="n_dente" value="" id="n_dente"
											class="inputtext required" size="10" type="text" />

									</div>
									<div class="row field_textarea alignleft">
										<label><strong>Descrição do Serviço</strong> </label><br />
										<textarea id="descricao" name="descricao"
											class="textarea textarea_middle required" cols="40" rows="10"></textarea>
									</div>
									<div class="row field_text alignleft omega">
										<div class="styled_table table_turquoise">
											<table id="tabela" width="99%" cellpadding="0"
												cellspacing="0">
												<thead>
												<?php
												$count = 0;
												if(!empty($_SESSION['id_paciente_fk'])){
													//echo 'aqui'. $_SESSION['id_paciente_fk'];

													$id_paciente = $_SESSION['id_paciente_fk'];

													//	$query_tabela = "select * from orcamento where fk_pacientes = 23";
													$query_tabela = "select MAX(id) as id from orcamento where fk_pacientes = $id_paciente";
													//echo $query_tabela;
													$result = mysql_query($query_tabela);
													$id = mysql_result($result, 0,'id');

													//echo $id;
													$qry2 = "select id_procedimento from orcamento_procedimento where id_orcamento = $id ";
													$res = mysql_query($qry2);

													if($res)
													$count=mysql_num_rows($res);

													//echo $count;

													//unset($_SESSION['id_paciente_fk']);
												}
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
												if($count > 0){
													for($i=0; $i<$count; $i++){

														$cod_proc = mysql_result($res, $i,'id_procedimento' );
														//echo $cod_proc;


														if (!empty($cod_proc)){
															//echo 'entrei if';
															$query_tabela2 = "SELECT a.id_orcamento, a.id_procedimento, b.nome_procedimento, b.numero_dente, b.fk_cod_proc, c.cod_procedimento, c.valor_procedimento, c.nome_procedimento
															FROM orcamento_procedimento a
															INNER JOIN orcamento b ON a.id_orcamento = b.id
															INNER JOIN procedimentos c ON a.id_procedimento = c.id
															WHERE c.id = $cod_proc
															AND a.id_orcamento=$id";
															//echo $query_tabela2;
															//$query_tabela2 = "select valor_procedimento, cod_procedimento from procedimentos where id=$cod_proc";
															$result2 = mysql_query($query_tabela2);
															$count2 = mysql_num_rows($result2);
															if($count2 >0)
															for($j=0; $j<$count2; $j++){
																if($result2){
																	$nome_proc = mysql_result($result2, $j, 'c.nome_procedimento');
																	$proc_cod = mysql_result($result2,$j,'c.cod_procedimento' );
																	$numero_dente= mysql_result($result2, $j, 'b.numero_dente');
																	$valor = mysql_result($result2, $j, 'c.valor_procedimento');

																}
															}



															echo "<tr>";

															echo "<td><a href='editar_procedimento.php?id_edit=$id'><img title='Editar Procedimento' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		                                		
		                                			</td>";
															?>


													<td><?php echo $proc_cod;?></td>
													<td><?php echo $nome_proc;?></td>
													<td><?php echo $numero_dente;?></td>
													<td><?php echo $valor;?></td>
													</tr>

													<?php
													$valor_total = $valor_total + $valor;

														}
													}

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
					<!--/ content -->

					<!-- sidebar -->
					<?php
					$data = date("d/m/Y")
					?>
					<br /> <br /> <br /> <br /> <br />
					<div class="grid_4 sidebar">
						<div class="contact-form">
							<div class="quoteBox-big">
								<div class="row field_text">
									<strong><label>Data do Orçamento</label> </strong><br /> <input
										name="data" value="<?php echo $data;?>" readonly="readonly"
										id="data" class="inputtext required" size="40" type="text" />
								</div>

								<div class="row field_text">
									<strong><label>Orçamento Número</label> </strong><br /> <input
										name="orçamento_numero" value="<?php echo $id_orcamento;?>"
										readonly="readonly" id="orçamento_numero"
										class="inputtext required" size="40" type="text" />
								</div>
								<?php
								if(empty($_SESSION['ultimo_inserido'])){



									?>
								<div class="row field_text">
									<strong><label>Nº Parcelas</label> </strong><br /> <input
										name="parcelas" value="" id="parcelas"
										class="inputtext required" size="40" type="text" />
								</div>
								<?php
								}
								?>
							</div>


						</div>

					</div>
					<!--/ sidebar -->

					<div class="clear"></div>
					<div class="row field_text">
						<input value="Enviar Dados" title="Enviar Dados"
							class="button_styled"
							style="background: #474747; color: #ffffff; border: 1px solid #474747;"
							onclick="chamaOrcamento();" id="send" type="submit" />


					</div>

				</div>

			</div>
			<div class="middle_bot"></div>

		</div>
	</div>

</body>
</html>

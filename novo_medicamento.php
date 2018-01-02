<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';

$usuario = $_SESSION['usuario'];

include 'conecta_banco.php';

echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

//include 'conecta_banco.php';
$query = "select * from pacientes where controle=0";
$sql = mysql_query($query);
if($sql)
$count_sql = mysql_num_rows($sql);
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

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet"
	type="text/css" />
<script type="text/javascript">
function LimpaEditar() {
	if(document.getElementById('nome_medicamento').value!=""){ 
		document.getElementById('nome_medicamento').value="";
		document.getElementById('estoque').value="";
		document.getElementById('dados_ad').value="";
		
	}	
	
	
}
</script>
<script type="text/javascript">
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este medicamento ?");   
	if (resposta == true) { 
		window.location.href = "excluir_medicamento.php?id="+id; 
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
			<h3 class="toggle box" align="center">
				Ver Todos os Medicamentos<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
        <div class="styled_table table_turquoise" align="center">
                    <table id="tabela" width="70%" cellpadding="0"
							cellspacing="0">
                        <thead>
                            <tr>
                            	<th style="width: 25%">Ação</th>
                                <th style="width: 25%">Medicamento</th>
                                <th style="width: 25%">Quantidade</th>
                                <th style="width: 25%">Dados Adicionais</th>
                              
								
							</tr>
                        </thead>
                         <tbody>
                         <?php
                         $query = "select * from medicamentos";
                         $sql = mysql_query($query);
                         $count = mysql_num_rows($sql);
                         if($sql && $count > 0){
                         	for($i=0; $i < $count; $i++){

                         		$id = mysql_result($sql, $i,'id');
                         		$nome_medicamento = mysql_result($sql, $i, 'nome_medicamento');
                         		$qtd = mysql_result($sql, $i, 'qtd_medicamento');
                         		$dados_add = mysql_result($sql, $i, 'dados_adicionais');



                         		echo '<tr>';
                         		echo "<td><a href='novo_medicamento.php?id_edit=$id'><img title='Detalhes do Medicamento' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma($id)'><img title='Excluir Medicamento' border='0' src='icon_x2.png' width='15' height='10'>
					     	</a>
		                                		                                		
		                                </td>";

                         		echo "<td>$nome_medicamento</td>";
                         		echo "<td>$qtd</td>";
                         		echo "<td>$dados_add </td>";

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
							<li class="menu-item-home parent current-menu-ancestor"><a href="#"><span>Cadastramento</span> </a>
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

									<li class="current-menu-item"><a href="novo_medicamento.php"><span>Controle
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
					<br>*Campos Obrigatórios</br>
					<!-- content -->
					<div class="grid_8 content">
						<div class="post-item">

							<div class="contact-form" align="left">

								<h1>
									<br>Cadastramento de Medicamentos</br>
								</h1>
								<input value="Limpar Campos" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" type="button" onclick="LimpaEditar()" />

								<form action="cadastro_medicamentos_validar.php" method="post"
									name="novo_medicamento.php">

									<?php
									if (!empty($_GET['id_edit'])){
										$controle = 1;
										$id_edit = $_GET['id_edit'];
										$query2 = "select * from medicamentos where id=$id_edit";
										$result = mysql_query($query2);

										if ($result){
											//echo 'entrei';
											$nome_medicamento_edit = mysql_result($result, 0, 'nome_medicamento');
											$qtd_edit = mysql_result($result, 0, 'qtd_medicamento');
											$dados_add_edit = mysql_result($result, 0, 'dados_adicionais');

										}
										?>
									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Medicamento*</strong> </label><br /> <input
												name="nome_medicamento" id="nome_medicamento"
												class="inputtext input_middle required"
												value="<?php echo $nome_medicamento_edit;?>" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<div class="row field_text alignright">
										<p>
											<label><strong>Quantidade em Estoque*</strong> </label><br />
											<input name="estoque" id="estoque"
												class="inputtext input_middle required"
												value="<?php echo $qtd_edit;?>" maxlength="5" tabindex="20"
												type="text" />
										</p>
									</div>
									<div class="row field_textarea alignleft">
										<label><strong>Dados Adicionais</strong> </label><br />
										<textarea id="dados_ad" name="dados_ad"
											class="textarea textarea_middle required" cols="40" rows="10"><?php echo $dados_add_edit;?></textarea>
									</div>
									<?php
									//echo $id_edit;
									echo "<input type='hidden' name='id_edit' id='id_edit' value='$id_edit'>";
									echo "<input type='hidden' name='controle' id='controle' value='$controle'>";
									}else{
										$controle = 0;
										if (!empty($_SESSION['nome_medicamento'])){
											$nome_medicamento = $_SESSION['nome_medicamento'];

											?>
									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Medicamento*</strong> </label><br /> <input
												name="nome_medicamento" id="nome_medicamento"
												class="inputtext input_middle required"
												value="<?php echo $nome_medicamento;?>" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<?php
										}else{
											$nome_medicamento = '';

											?>
									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Medicamento*</strong> </label><br /> <input
												name="nome_medicamento" id="nome_medicamento"
												class="inputtext input_middle required"
												value="<?php echo $nome_medicamento;?>" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<?php

										}
										?>



										<?php
										if (!empty($_SESSION['estoque'])){
											$qtd = $_SESSION['estoque'];

											?>
									<div class="row field_text alignright">
										<p>
											<label><strong>Quantidade em Estoque*</strong> </label><br />
											<input name="estoque" id="estoque"
												class="inputtext input_middle required"
												value="<?php echo $qtd;?>" maxlength="5" tabindex="20"
												type="text" />
										</p>
									</div>
									<?php
										}else{
											$qtd = '';


											?>
									<div class="row field_text alignright">
										<p>
											<label><strong>Quantidade em Estoque*</strong> </label><br />
											<input name="estoque" id="estoque"
												class="inputtext input_middle required"
												value="<?php echo $qtd;?>" maxlength="5" tabindex="20"
												type="text" />
										</p>
									</div>
									<?php
										}
										?>
									<div class="row field_textarea alignleft">
										<label><strong>Dados Adicionais</strong> </label><br />
										<textarea id="dados_ad" name="dados_ad"
											class="textarea textarea_middle required" cols="40" rows="10"></textarea>
									</div>
									<?php
										echo "<input type='hidden' name='controle' id='controle' value='$controle'>";
									}
								
									
										
									?>
									<div class="row field_text">
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

				</div>
				<div class="clear"></div>
			</div>
		</div>

		<div class="middle_bot"></div>

</body>
</html>


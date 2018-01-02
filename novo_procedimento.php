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
	if(document.getElementById('nome_procedimento').value!=""){ 
		document.getElementById('nome_procedimento').value="";
		document.getElementById('valor').value="";
		
		
	}	
	
	
}
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
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este Procedimento ?");   
	if (resposta == true) { 
		window.location.href = "excluir_procedimento.php?id="+id; 
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
                         		echo "<td><a href='novo_procedimento.php?id_edit=$id'><img title='Detalhes do Medicamento' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma($id)'><img title='Excluir Procedimento' border='0' src='icon_x2.png' width='15' height='10'>
					     	</a>
		                                		                                		
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

									<li class="menu-item-home"><a href="novo_medicamento.php"><span>Controle
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



			<div class="middle sidebarRight">

				<div class="container_12">
					<br>*Campos Obrigatórios</br>
					<!-- content -->
					<div class="grid_8 content">
						<div class="post-item">

							<div class="contact-form" align="left">

								<h1>
									<br />Cadastramento de Procedimentos
								</h1>
								<input value="Limpar Campos" title="send" class="button_styled"
									style="background: #474747; color: #ffffff; border: 1px solid #474747;"
									id="send" type="button" onclick="LimpaEditar()" />

								<form action="cadastro_procedimento_validar.php" method="post"
									name="novo_medicamento.php">

									<?php 
									if (empty($_GET['id_edit'])){
										$controle = 0;
										if (!empty($_SESSION['nome_procedimento']))
											$nome_procedimento1 = $_SESSION['nome_procedimento'];
										else
											$nome_procedimento1 = "";
										if (!empty($_SESSION['valor']))
											$valor1 = $_SESSION['valor'];
										else
											$valor1 = "";
									?>
									<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Procedimento*</strong> </label><br />
											<input name="nome_procedimento" id="nome_procedimento"
												value="<?php echo $nome_procedimento1;?>"
												class="inputtext input_middle required" value="" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<div class="row field_text">
										<p>
											<label><strong>Valor R$*</strong> </label><br /> <input
												name="valor" id="valor" 
												value="<?php echo $valor1;?>"
												onkeypress="return formatar_moeda(this,'.',',',event);"
												class="inputtext input_middle required" value=""
												maxlength="5" tabindex="20" type="text" />
										</p>
									</div>
									<?php 
									echo "<input type='hidden' name='controle' id='controle' value='$controle'>";
									}else{
										$controle = 1;
										$id_edit = $_GET['id_edit'];
										$query2 = "select nome_procedimento, valor_procedimento from procedimentos where id = $id_edit";
										$sql2 = mysql_query($query2);
										
										if($sql2){
											$nome_procedimento_edit = mysql_result($sql2, 0,'nome_procedimento');
											$valor_edit = mysql_result($sql2, 0,'valor_procedimento');
										}
										?>
										<div class="row field_text alignleft">
										<p>
											<label><strong>Nome do Procedimento*</strong> </label><br />
											<input name="nome_procedimento" id="nome_procedimento" 
											  value="<?php echo $nome_procedimento_edit;?>"
												class="inputtext input_middle required" value="" size="35"
												tabindex="10" type="text" />
										</p>
									</div>
									<div class="row field_text">
										<p>
											<label><strong>Valor R$*</strong> </label><br /> <input
												name="valor" id="valor"  value="<?php echo $valor_edit;?>"
												onkeypress="return formatar_moeda(this,'.',',',event);"
												class="inputtext input_middle required" value=""
												maxlength="5" tabindex="20" type="text" />
										</p>
									</div>
									<?php 
									echo "<input type='hidden' name='controle' id='controle' value='$controle'>";
									echo "<input type='hidden' name='id_edit' id='id_edit' value='$id_edit'>";
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
	</div>

	<div class="middle_bot"></div>

</body>
</html>

<?php

session_start();

$usuario = $_SESSION['usuario'];

include 'conecta_banco.php';
include 'funcoes.php';
	$query = "select * from pacientes where controle=0";
	$sql = mysql_query($query);
	if($sql)
		$count_sql = mysql_num_rows($sql);
		

if(!empty($_SESSION['nome_paciente'])){
	$nome_paciente_manter = $_SESSION['nome_paciente'];
}
else{
	$nome_paciente_manter = '';
}
if(!empty($_SESSION['data'])){
	$data_manter = $_SESSION['data'];
}
else{
	$data_manter = '';
}
if(!empty($_SESSION['hora'])){
	$hora_manter = $_SESSION['hora'];
}
else{
	$hora_manter = '';
}
if(!empty($_SESSION['hora_final'])){
	$hora_final_manter = $_SESSION['hora_final'];
}
else{
	$hora_final_manter = '';
}
if(!empty($_SESSION['dentista_nome'])){
	$dentista_nome_manter = $_SESSION['dentista_nome'];
}
else{
	$dentista_nome_manter = '';
}



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
<script>
$(function() {
	$( "#calen" ).datepicker({
		minDate: 'today',
		showOtherMonths: true,
		selectOtherMonths: true
		
	});
});
</script>


</head>

<body>
<script type="text/javascript">
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover esta consulta ?");   
	if (resposta == true) { 
		window.location.href = "excluir_consulta.php?id="+id; 
	} 
} 
</script>


<script type="text/javascript">
/* Mascara para horario */
function MascaraHora(objeto){
 
 if(objeto.value.length == 2)
 objeto.value = objeto.value + ':';
 
 if(objeto.value.length == 4)
 objeto.value = objeto.value;
}
</script>
<script language="Javascript"> 
function confirma(id,hora_inicio,hora_fim) { 
	var resposta = confirm("Tem certeza que deseja remover está consulta ?");   
	if (resposta == true) { 
		window.location.href = "excluir_consulta.php?id="+id; 
		} 
	} 
</script> 
<script type="text/javascript">
function LimpaEditar() {
	if(document.getElementById('nome_paciente').value!="") {
		document.getElementById('nome_paciente').value="";
		document.getElementById('hora').value="";
		document.getElementById('hora_final').value="";
		document.getElementById('calen').value="";
		
	}
}
</script>

<script type="text/javascript">
function handleSelect(elm)
{	var valor = elm.value;
	window.location = "agendar_consulta.php?dentista="+valor;
}
</script>



<div class="body_wrap">


	<div class="header" align="center"> 
     	
        <div class="header_top">
			<div class="container">
                <div class="logo"><a href="index.php"><img src="HTML/images/col_icon_2.png" width="210" height="80" alt="Medica" /></a></div>
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
                    <table id="tabela" width="40%" cellpadding="0" cellspacing="0" >
                        <thead>
                            <tr>
                                <th style="width:25%">Ação</th>
                                <th style="width:25%">Nome do Paciente</th>
                               
								
							</tr>
                        </thead>
                        <?php 
                        if ($sql){
	                        for($i=0;$i<$count_sql;$i++){
			                       $id = mysql_result($sql, $i, 'id');
			                       $nome_p = mysql_result($sql, $i,'nome');
						
		                       
		                       echo '<tbody>';
		                            echo '<tr>';
		                                echo "<td><a href='agendar_consulta.php?nome_p=$nome_p'><img title='Selecionar Paciente' border='0' src='icon_check2.png' width='15' height='10'></a>
		                                		                              		                                		
		                                </td>";
		                              
		                              	echo "<td>$nome_p</td>";
		                            
		                                
		                               
		                                
		                                
		                      
		                        echo '</tbody>';
	                        }
	                       
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
							<li class="menu-item-home parent current-menu-ancestor"><a href="agendar_consulta.php"><span>Agendamento</span> </a>
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
      </div>
<div class="middle sidebarRight">
    <div class="container_12">

        <!-- content -->        	
    	<div class="grid_8 content">
        	<div class="post-item">
        	
            <div class="contact-form">
            			
            	<h1><br>Agendamento de Consultas</br></h1>
            <a href='todas_consultas.php'>Ver todas as Consultas</a><br />
			
                 							
                      
            	<input value="Limpar Campos" title="send" class="button_styled" style="background:#474747;color:#ffffff;border:1px solid #474747;" id="send" type="button" onclick="LimpaEditar()" /> 
						
            	<form action="agendar_consulta_validar.php" method="post" name="agendar_consulta">
                        	
                        
	                      	
	                      	<div class="row field_select">
	                      	
								<label><strong>Escolha um Dentista</strong></label><br />
	                            <select class="select_styled" name="dentista_nome" onchange="javascript:handleSelect(this)" id="dentista_nome">
	                            	<?php 
	                            		if(!empty($_GET['dentista'])){
	                            			$dent = $_GET['dentista'];
		                            		if($dent == 'Andre' || $dent == 'André' || $dent == 'andre' || $dent == 'andré' ){
		                            				$dent_format = ucfirst($dent);
		                            				echo "<option value='andre'>Dr.$dent_format</option>";
		                            				echo "<option value='ricardo'>Dr.Ricardo</option>";
		                            				
		                            			}
		                            		else{
		                            				$dent_format = ucfirst($dent);
		                            				echo "<option value='ricardo'>Dr.$dent_format</option>";
		                            				echo "<option value='andre'>Dr. André</option>";
		                            			}
	                            			
		                            			
	                            		}else if (!empty($_SESSION['dentista_nome'])){
	                            			
	                            			//$_SESSION['dentista_nome'] = $dent_format;
	                            			$dentista_nome_manter = $_SESSION['dentista_nome'];
	                            			
	                            			if($dentista_nome_manter == 'Andre' || $dentista_nome_manter == 'André' || $dentista_nome_manter == 'andre' || $dentista_nome_manter == 'andré' ){
		                            				$dentista_nome_manter_format = ucfirst($dentista_nome_manter);	
	                            					echo "<option value='andre'>Dr.$dentista_nome_manter_format</option>";
		                            				echo "<option value='ricardo'>Dr. Ricardo</option>";
		                            				
		                            			}
		                            			else{
		                            				$dentista_nome_manter_format = ucfirst($dentista_nome_manter);
		                            				echo "<option value='ricardo'>Dr.$dentista_nome_manter_format</option>";
		                            				echo "<option value='andre'>Dr. André</option>";
		                            			}
	                            		}
	                            		
	                            		else{
	                            			
		                            			echo "<option value=''>--</option>";
		                            			echo "<option value='ricardo'>Dr. Ricardo</option>";
		                            			echo "<option value='andre'>Dr. André</option>";
		                            		}
	                            	?>
	                            	
								</select>
							</div>
						
                       		<?php 
                       			if(!empty($_GET['nome_p'])){
                       				$nome_paciente = $_GET['nome_p'];
                       				$_SESSION['nome_paciente'] = $nome_paciente;
                       				
                       		?>	
					
						<div class="row field_text alignleft">
                        <p><label><strong>Nome do Paciente</strong></label><br />
                        <input name="nome_paciente" id="nome_paciente" class="inputtext input_middle required" value="<?php echo $nome_paciente; ?>" size="35" tabindex="10" type="text"/></p>
                        </div>
                        
                     <?php 
                       			}else{
                       				
                       			
                     ?>
                     	
                     	<br />
                     	<div class="row field_text alignleft">
                        <p><label><strong>Nome do Paciente</strong></label><br />
                        <input name="nome_paciente" id="nome_paciente" class="inputtext input_middle required" value="<?php echo $nome_paciente_manter; ?>" size="35" tabindex="10" type="text"/></p>
                        </div>
                       
                     <?php 
                       			}
                     ?>
                        <div class="row field_text alignright">
						<p><label><strong>Hor&aacute;rio Início</strong></label><br />
                        <input name="hora" id="hora"  class="inputtext input_middle required" value="<?php echo $hora_manter; ?>" maxlength="5" onkeypress="MascaraHora(this);" tabindex="20" type="text"/></p>
                        </div>
                        
                        <div class="row field_text alignleft omega">
						<p><label><strong>Hor&aacute;rio Término</strong></label><br />
                        <input name="hora_final" id="hora_final" class="inputtext input_middle required" value="<?php echo $hora_final_manter; ?>" maxlength="5" onkeypress="MascaraHora(this);" maxlength="5" tabindex="4" type="text"/></p>
                        </div>
                        
                        <div class="row field_text alignright ">
						<p><label><strong>Data</strong></label><br />
                        <input name="calen" id="calen" class="inputtext input_middle required" value="<?php echo $data_manter; ?>" tabindex="4" type="text"/></p>
                        </div>
                        <div class="row field_text alignleft omega ">
                      	 <div class="row">
                      
                          <div class="entry">
                        	<input value="Enviar Dados" title="send" class="button_styled" style="background:#474747;color:#ffffff;border:1px solid #474747;" id="send"  type="submit" /> </div>
								
								
						
							</div>
							
                          
                        		
						
							
                        </div>  
                  </form>
        </div>
      </div>
        
      </div>
      
       <!-- sidebar -->        
      	<div class="grid_4 sidebar">
        	
            <div id="categories-5" class="widget-container widget_nav_menu">
				<ul>
				<?php 
				if(!empty($_GET['dentista']) || !empty($_SESSION['dentista_nome'])){
					if (!empty($_GET['dentista']))	
						$dentista_nome = $_GET['dentista'];
					else
						$dentista_nome = $_SESSION['dentista_nome'];
						
						$dentista_nome_format = ucfirst($dentista_nome);
						$_SESSION['dentista_nome'] = $dentista_nome_format;
						?>
						<br>Hor&aacute;rios Ocupados - Dr.<?php echo $dentista_nome_format?></br>
					<?php 
					}else{
							echo "<br>Hor&aacute;rios Ocupados</br>";
					
					}
				?>
					
					 <div class="styled_table table_turquoise" align="center">
                    	<table id="tabela" width="50%" cellpadding="0" cellspacing="110" >
                       	 <thead>
                          	  <tr>
                                
	                                <th width="10%">Nome do Paciente</th>
	                               	<th width="10%">Data</th>
	                               	<th width="30%">Horário</th>
								
								</tr>
                        </thead>
					
					<?php 
						if(!empty($dentista_nome)){
							//$data_hj = date('dd/mm/YY');
						$query2 ="SELECT a. * , b.nome
									FROM agenda a
									INNER JOIN pacientes b ON a.id_paciente = b.id
									WHERE data >= curdate( )
									AND data <= date_add( curdate( ) , INTERVAL 15
									DAY )
									AND dentista_nome = '$dentista_nome'";
						$sql2 = mysql_query($query2);
						if($sql2){
							$cont = mysql_num_rows($sql2);
							
							for($i=0;$i<$cont;$i++){
								
								$id_consulta = mysql_result($sql2, $i,'a.id_agenda');
								$data = mysql_result($sql2, $i,'a.data');
								$data_f = mostraData($data);
								$horario = mysql_result($sql2, $i,'a.horario');
								$horario_termino = mysql_result($sql2, $i,'a.horario_termino');
								$id_paciente = mysql_result($sql2, $i,'a.id_paciente');
								$nome_paciente = mysql_result($sql2, $i,'b.nome');
								
				
								  echo '<tbody>';
		                            echo '<tr>';
		                                	                              
		                              	echo "<td><a href='#' onClick=confirma($id_consulta)><img title='Excluir Consulta' border='0' src='icon_x2.png' width='15' height='10'></a>$nome_paciente</td>";
		                              	echo "<td>$data_f</td>";
		                              	echo "<td>I.$horario./T.$horario_termino</td>";
							}        
		                      
		                        echo '</tbody>';
							}
							
					
						}
					
					?>
					</table>
				</div>
                 
				</ul>
		  	</div>
            
                       
      	</div>     
        <!--/ sidebar -->                
      </div>
      <div class="clear"></div>            
      </div>
     
          </div>
           <div class="middle_bot"></div>
      
 </body>
</html>
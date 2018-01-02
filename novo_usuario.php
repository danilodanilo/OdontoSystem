<?php
session_start();


include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

//echo $_SESSION['perfil'];


//include 'conecta_banco.php';

if(!isset($_SESSION['usuario'])){
	header('Location:login.php');
}
else
	$usuario = $_SESSION['usuario'];

if(!empty($_SESSION['novo_usuario']))
	$novo_usuario = $_SESSION['novo_usuario'];
else
	$novo_usuario = "";
	
if(!empty($_SESSION['senha_novo_usuario']))
	$senha_novo_usuario = $_SESSION['senha_novo_usuario'];
else
	$senha_novo_usuario = "";
	
if(!empty($_SESSION['perfil_novo_usuario']))
	$perfil_novo_usuario = $_SESSION['perfil_novo_usuario'];
else
	$perfil_novo_usuario = "";
if(!empty($_SESSION['email_novo_usuario']))
	$email_novo_usuario = $_SESSION['email_novo_usuario'];
else
	$email_novo_usuario = "";

$qry = "select id, username, perfil, password, email from users where controle = 0 and username <> '$usuario'";
$sql = mysql_query($qry);
$count_sql = mysql_num_rows($sql);

if(!empty($_GET['id_edit']))
	$id_edit = $_GET['id_edit'];
if(!empty($_GET['nome']))
	$nome_edit = $_GET['nome'];
if(!empty($_GET['email']))
	$email_edit = $_GET['email'];
if(!empty($_GET['perfil']))
	$perfil_edit = $_GET['perfil'];
if(!empty($_GET['pass']))
	$senha_edit = $_GET['pass'];


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

<!-- sw showcase -->
<link href="HTML/css/aw-showcase.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="JavaScript" src="HTML/js/jquery.aw-showcase.min.js"></script>
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
<script language="Javascript"> 
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este usuário ?");   
	if (resposta == true) { 
		window.location.href = "excluir_usuario.php?id="+id; 
		} 
	} 
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
<?php 
if($_SESSION['perfil'] == 0){
	?>
	<script language="javascript">
		alert("Usuário sem permissão para tal ação");
		window.location.href = 'index.php';
	</script>
<?php 
}?>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
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
       
        	<h3 class="toggle box">
				Ver Todos os Usuários<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
        <div class="styled_table table_turquoise">
                    <table width="80%" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:25%">Ação</th>
                                <th style="width:25%">ID</th>
                                <th style="width:25%">Nome do Usuário</th>
                                <th style="width:25%">E-mail</th>
                                <th style="width:25%">Perfil</th>
                            </tr>
                        </thead>
                        <?php 
                        for($i=0;$i<$count_sql;$i++){
		                       $id = mysql_result($sql, $i, 'id');
		                       $user = mysql_result($sql, $i,'username');
		                       $perfil = mysql_result($sql, $i,'perfil');
		                       $email = mysql_result($sql, $i,'email');
		                       $pass = mysql_result($sql, $i, 'password');
		                       if($perfil == 5)
		                       		$perfil = 'dentista';
		                       	else
		                       		$perfil = 'secretária';
		                       echo '<tbody>';
		                            echo '<tr>';
		                                echo "<td><a href='novo_usuario.php?id_edit=$id&nome=$user&email=$email&perfil=$perfil&pass=$pass'><img title='Detalhes do Usuário' border='0' src='ico_edit.png' width='15' height='10'>
					       					
					     	</a>
		                                		<a href='#' onclick='confirma($id)'><img title='Excluír Usuário' border='0' src='icon_x2.png' width='15' height='10'></a>
		                                		                                		
		                                </td>";
		                                echo "<td>$id</td>";
		                              	echo "<td>$user</td>";
		                              	echo "<td>$email</td>";
		                              	echo "<td>$perfil</td>";
		                                
		                      
		                        echo '</tbody>';
		                        
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
									<li class="current-menu-item"><a href="novo_usuario.php"><span>Controle
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
        	
            <div class="contact-form" align="left">
            <br>*Campos Obrigatórios</br>
							
            	<h1><br>Controle de Usu&aacute;rios</br></h1>
            	<form action="cadastro_usuario_validar.php" method="post" name="cadastro_usuario">
            	<?php 
            		if(!empty($id_edit)){
            			//$id_edit = $_GET['id_edit'];
            			
            			?>
            			  <div class="row field_text alignleft">
                        <p><label><strong>Nome do Usu&aacute;rio*</strong></label><br />
                        <input name="nome_usuario_edit" id="nome_usuario_edit" class="inputtext input_middle required" value="<?php echo $nome_edit; ?>" size="35" tabindex="10" type="text"></p>
                        </div>
                     
                        <div class="row field_text alignleft omega">
						<p><label><strong>E-mail*</strong></label><br />
                        <input name="email_edit" id="email_edit" class="inputtext input_middle required" value="<?php echo $email_edit; ?>" size="20" tabindex="20" type="text"></p>
                        </div>
                      
                         <div class="row field_text alignleft">
                   		<p><label><strong>Senha*</strong></label><br />
                        <input class="inputtext input_middle required" name="senha_edit" value="<?php echo $senha_edit; ?>" id="senha_edit" size="20" tabindex="20" type="password" ></p>
                        </div>
                        
                        
                        <div class="row field_text alignleft omega">
	                      	<div class="row field_select">
								<label><strong>Perfil*</strong></label><br />
	                            <select class="select_styled" name="perfil_edit" value="" id="perfil_edit">
	                            	<?php 
	                            		if($perfil_edit == 'secretaria' || $perfil_edit == 'Secretaria' || $perfil_edit == 'secretária' ){
	                            			echo "<option value='secretaria'>$perfil_edit</option>";
	                            			echo "<option value='dentista'>dentista</option>";
											
	                            		}
	                            		else{
	                            			echo "<option value='dentista'>$perfil_edit</option>";
	                            			echo "<option value='secretaria'>secret&aacute;ria</option>";
											
	                            		}
	                            	?>
	                            	
								</select>
							</div>
						</div>
            		<?php 
            		
            		$var_controle=1;
            		echo "<input type='hidden' name='var_controle' id='var_controle' value='$var_controle'>";
            		echo "<input type='hidden' name='id_edit' id='id_edit' value='$id_edit'>";
            		}
            	else{
            	?>
                        <div class="row field_text alignleft">
                        <p><label><strong>Nome do Usu&aacute;rio*</strong></label><br />
                        <input name="nome_usuario" id="nome_usuario_edit" class="inputtext input_middle required" value="<?php $novo_usuario; ?>" size="35" tabindex="10" type="text"></p>
                        </div>
                     
                        <div class="row field_text alignleft omega">
						<p><label><strong>E-mail*</strong></label><br />
                        <input name="email" id="email_edit" class="inputtext input_middle required" value="<?php $email_novo_usuario; ?>" size="20" tabindex="20" type="text"></p>
                        </div>
                      
                         <div class="row field_text alignleft">
                   		<p><label><strong>Senha*</strong></label><br />
                        <input class="inputtext input_middle required" name="senha" value="<?php $senha_novo_usuario; ?>" id="senha_edit" size="20" tabindex="20" type="password" ></p>
                        </div>
                        
                        
                        <div class="row field_text alignleft omega">
	                      	<div class="row field_select">
								<label><strong>Perfil*</strong></label><br />
	                            <select class="select_styled" name="perfil" value="<?php $perfil_novo_usuario; ?>" id="perfil">
	                            	<option value="nd">--</option>
		                            <option value="dentista">Dentista</option>
									<option value="secretaria">Secret&aacute;ria</option>
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
                        	<input value="Enviar Dados" title="send" class="button_styled" style="background:#474747;color:#ffffff;border:1px solid #474747;" id="send"  type="submit" /> </div>
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
</div>
 </body>
</html>



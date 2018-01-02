<?php 
session_start();
include 'conecta_banco.php';
$usuario = $_SESSION['usuario'];
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

//$query = ;
$sql = mysql_query("select * from fornecedores where controle = 0");

$count = mysql_num_rows($sql);


/*essas verificacoes abaixo sao utilizadas para quando o usuario nao fizer algum cadastro de forma correta
 * ao voltar para a pagina manter nos campos anteriores os valores, sem necessidade de digitar td novamente. 
 * lembrar que em outras paginas como novo_paciente é feito da mesma forma*/
if(!empty($_SESSION['fornecedor'])){
	$nome_fornecedor = $_SESSION['fornecedor'];
	
}
else{
	$nome_fornecedor = "";
}
if(!empty($_SESSION['cnpj'])){
	$cnpj_1 = $_SESSION['cnpj'];
}
else{
	$cnpj_1="";
}
if(!empty($_SESSION['ie'])){
	$ie_1 = $_SESSION['ie'];
	
}
else{
	$ie_1 = "";
	
}
if(!empty($_SESSION['tel'])){
	$tel_1 = $_SESSION['tel'];
}
else{
	$tel_1="";
}
if(!empty($_SESSION['email'])){
	$email_1 = $_SESSION['email'];
}
else{
	$email_1="";
}
if(!empty($_SESSION['endereco'])){
	$endereco_1 = $_SESSION['endereco'];
}
else{
	$endereco_1="";
}
if(!empty($_SESSION['bairro'])){
	$bairro_1 = $_SESSION['bairro'];
}
else{
	$bairro_1="";
}
if(!empty($_SESSION['cidade'])){
	$cidade_1 = $_SESSION['cidade'];
}
else{
	$cidade_1="";
}
if(!empty($_SESSION['estado'])){
	$estado_1 = $_SESSION['estado'];
}
else{
	$estado_1="";
}
if(!empty($_SESSION['obs'])){
	$obs_1 = $_SESSION['obs'];
}
else{
	$obs_1="";
}

if(!empty($_GET['id_edit'])){
	$id_edit = $_GET['id_edit'];
	$sql2 = mysql_query("select * from fornecedores where id=$id_edit");
	//$id = mysql_result($sql, $i,'id');

	$nome_f_edit = mysql_result($sql2, 0, 'nomef');
    $ie_edit = mysql_result($sql2, 0, 'ie');
    $cnpj_edit = mysql_result($sql2, 0, 'cnpj');
    $tel_edit = mysql_result($sql2, 0, 'telefone');
    $email_edit = mysql_result($sql2, 0, 'email');
    $cidade_edit = mysql_result($sql2, 0, 'cidade');
    $bairro_edit = mysql_result($sql2, 0, 'bairro');	
    $end_edit = mysql_result($sql2, 0, 'endereco');
    $estado_edit =  mysql_result($sql2, 0, 'estado');
    $obs_edit = mysql_result($sql2, 0, 'observacoes');
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
function confirma(id) { 
	var resposta = confirm("Tem certeza que deseja remover este fornecedor ?");   
	if (resposta == true) { 
		window.location.href = "excluir_fornecedor.php?id="+id; 
	} 
} 
</script>


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
<script>
jQuery(function($){
   $("#cnpj").mask("99.999.999/9999-99");
   $("#cnpj_edit").mask("99.999.999/9999-99");
   $("#ie").mask("999.999.999.999");
   $("#ie_edit").mask("999.999.999.999");
   $("#tel").mask("(99)9999-9999");
   $("#tel_edit").mask("(99)9999-9999");
   
  
});
</script>

<script type="text/javascript" src="jquery/jquery.dataTables.min.js"></script>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript">
function LimpaEditar() {
	if(document.getElementById('nome_fornecedor_edit').value!="") {
		document.getElementById('nome_fornecedor_edit').value="";
		document.getElementById('cnpj_edit').value="";
		document.getElementById('ie_edit').value="";
		document.getElementById('endereco_edit').value="";
		document.getElementById('bairro_edit').value="";
		document.getElementById('cidade_edit').value="";
		document.getElementById('estado_edit').value="";
		document.getElementById('tel_edit').value="";
		document.getElementById('email_edit').value="";
		document.getElementById('observacoes_edit').value="";
		
		
		
	
	}
}
</script>
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
				Ver Todos os Fornecedores<span class="ico"></span>
			</h3>
			<div class="toggle_content highlighter">
				<pre class="brush: plain">
        <div class="styled_table table_turquoise" align="center">
                    <table id="tabela" width="70%" cellpadding="0" cellspacing="0" >
                        <thead>
                            <tr>
                                <th style="width:25%">Ação</th>
                                <th style="width:25%">Razão Social</th>
                                <th style="width:25%">I.E</th>
                                <th style="width:25%">CNPJ</th>
                                <th style="width:25%">Telefones</th>
                                <th style="width:25%">E-mail</th>
                                <th style="width:25%">Cidade</th>
								
							</tr>
                        </thead>
                         <tbody>
                      <?php 
                      if($sql && $count > 0){
                      	for($i=0; $i < $count; $i++){
                      		
                      		$id = mysql_result($sql, $i,'id');
                      		$nome_f = mysql_result($sql, $i, 'nomef');
                      		$ie = mysql_result($sql, $i, 'ie');
                      		$cnpj = mysql_result($sql, $i, 'cnpj');
                      		$tel = mysql_result($sql, $i, 'telefone');
                      		$email = mysql_result($sql, $i, 'email');
                      		$cidade = mysql_result($sql, $i, 'cidade');	
                      		
                      		
		                            echo '<tr>';
		                                echo "<td><a href='novo_fornecedor.php?id_edit=$id'><img title='Detalhes do Fornecedor' border='0' src='ico_edit.png' width='15' height='10'></a>
		                                		  <a href='#' onclick='confirma($id)'><img title='Excluir Fornecedor' border='0' src='icon_x2.png' width='15' height='10'>
					     	</a>
		                                		                                		
		                                </td>";
		                              
		                              	echo "<td>$nome_f</td>";
		                              	echo "<td>$ie</td>";
		                                echo "<td>$cnpj </td>";
		                                echo "<td>$tel</td>";
		                                echo "<td>$email</td>";
		                                echo "<td>$cidade</td>";
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

									<li class="current-menu-item"><a href="novo_fornecedor.php"><span>Controle
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
							
            			
            	<h1><br>Cadastramento de Fornecedores</br></h1>
            	<input value="Limpar Campos" title="send" class="button_styled" style="background:#474747;color:#ffffff;border:1px solid #474747;" id="send" type="button" onclick="LimpaEditar()" /> 
			
            	<form action="cadastro_fornecedores_validar.php" method="post" name="cadastro_fornecedores">
                    <?php 
                    	if(empty($_GET['id_edit'])){
                    
                    ?>
                        <div class="row field_text alignleft">
                        <p><label><strong>Nome do Fornecedor*</strong></label><br />
                        <input name="nome_fornecedor" id="nome_fornecedor" class="inputtext input_middle required" value="<?php echo $nome_fornecedor;?>"  size="35" tabindex="10" type="text" /></p>
                        </div>
                     
                        <div class="row field_text alignleft omega">
						<p><label><strong>CNPJ*</strong></label><br />
                        <input name="cnpj" id="cnpj" onkeypress="MascaraCNPJ(this)"; class="inputtext input_middle required" value="<?php echo $cnpj_1;?>" size="20" tabindex="20"  type="text"/></p>
                        </div>
                      
                         <div class="row field_text alignleft">
                   		<p><label><strong>I.E*</strong></label><br/>
                        <input class="inputtext input_middle required" name="ie" id="ie"  value="<?php echo $ie_1;?>" size="20" tabindex="20" type="text" /></p>
                        </div>
                        
                       
						
                        <div class="row field_text alignleft">
                        <p><label><strong>Telefone*</strong></label><br/>
                        <input class="inputtext input_middle required" name="tel" id="tel"  value="<?php echo $tel_1;?>" size="10" tabindex="20" type="text"/></p>
                      	</div>
                      	
                      	<div class="row field_text alignleft">
                        <p><label><strong>E-mail*</strong></label><br/>
                        <input class="inputtext input_middle required" name="email" id="email" value="<?php echo $email_1;?>" size="35" tabindex="20" type="text" /></p>
                        </div>
                          <div class="row field_text alignleft omega">
                        <p><label><strong>Endere&ccedil;o*</strong></label><br />
                        <input class="inputtext input_middle required" name="endereco" id="endereco"  value="<?php echo $endereco_1;?>" size="20" tabindex="20" type="text"/></p>
                        </div>
                       
                      
                       
                       	<div class="row field_text alignleft">
                        <p><label><strong>Bairro*</strong></label><br/>
                        <input class="inputtext input_middle required" name="bairro" id="bairro"  value="<?php echo $bairro_1;?>" size="20" tabindex="20" type="text"/></p>
                        </div>
                      
                       	
                       	
                        <div class="row field_text alignleft omega">
                        <p><label><strong>Cidade*</strong></label><br/>
                        <input class="inputtext input_middle required" align="left" name="cidade" id="cidade" value="<?php echo $cidade_1;?>"  size="20" tabindex="20" type="text" /></p>
                        </div>
                          	<div class="row field_text alignleft">
	                      	<div class="row field_select">
								<label><strong>Estado*</strong></label><br />
	                            <select class="select_styled" name="estado" id="estado">
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
	                  
                          <div class="row field_textarea alignleft">
                             <label><strong>Observações</strong></label><br />
                                    <textarea value="<?php echo $obs_1;?>" id="observacoes" name="observacoes"  class="textarea textarea_middle required" cols="40" rows="10"></textarea>
                                </div>
                    	<?php 
                    		$var_controle=0;//nao é uma edicao
		            		echo "<input type='hidden' name='var_controle' id='var_controle' value='$var_controle'>";
                    	}else{
                    		?>
                    	<div class="row field_text alignleft">
                        <p><label><strong>Nome do Fornecedor*</strong></label><br />
                        <input name="nome_fornecedor_edit" id="nome_fornecedor_edit" class="inputtext input_middle required" value="<?php echo $nome_f_edit;?>"  size="35" tabindex="10" type="text" /></p>
                        </div>
                     
                        <div class="row field_text alignleft omega">
						<p><label><strong>CNPJ*</strong></label><br />
                        <input name="cnpj_edit" id="cnpj_edit" onkeypress="MascaraCNPJ(this)"; class="inputtext input_middle required" value="<?php echo $cnpj_edit;?>" onblur="ValidarCNPJ(form1.cnpj)"; size="20" tabindex="20" type="text"/></p>
                        </div>
                      
                         <div class="row field_text alignleft">
                   		<p><label><strong>I.E*</strong></label><br/>
                        <input class="inputtext input_middle required" name="ie_edit" id="ie_edit" value="<?php echo $ie_edit;?>" size="20" tabindex="20" type="text" /></p>
                        </div>
                        
                       
						
                        <div class="row field_text alignleft">
                        <p><label><strong>Telefone*</strong></label><br/>
                        <input class="inputtext input_middle required" name="tel_edit" id="tel_edit"  value="<?php echo $tel_edit;?>" size="10" tabindex="20" type="text" /></p>
                      	</div>
                      	
                      	<div class="row field_text alignleft">
                        <p><label><strong>E-mail*</strong></label><br/>
                        <input class="inputtext input_middle required" name="email_edit" id="email_edit" value="<?php echo $email_edit;?>" size="35" tabindex="20" type="text" /></p>
                        </div>
                          <div class="row field_text alignleft omega">
                        <p><label><strong>Endere&ccedil;o*</strong></label><br />
                        <input class="inputtext input_middle required" name="endereco_edit" id="endereco_edit"  value="<?php echo $end_edit;?>" size="20" tabindex="20" type="text"/></p>
                        </div>
                       
                      
                       
                       	<div class="row field_text alignleft">
                        <p><label><strong>Bairro*</strong></label><br/>
                        <input class="inputtext input_middle required" name="bairro_edit" id="bairro_edit"  value="<?php echo $bairro_edit;?>" size="20" tabindex="20" type="text"/></p>
                        </div>
                      
                       	
                       	
                        <div class="row field_text alignleft omega">
                        <p><label><strong>Cidade*</strong></label><br/>
                        <input class="inputtext input_middle required" align="left" name="cidade_edit" id="cidade_edit" value="<?php echo $cidade_edit;?>"  size="20" tabindex="20" type="text" /></p>
                        </div>
                          	<div class="row field_text alignleft">
	                      	<div class="row field_select">
								<label><strong>Estado*</strong></label><br />
	                            <select class="select_styled" name="estado_edit" id="estado_edit">
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
	                  
                          <div class="row field_textarea alignleft">
                             <label><strong>Observações</strong></label><br />
                                    <textarea id="observacoes_edit" name="observacoes_edit" value="<?php echo $obs_edit;?>" class="textarea textarea_middle required" cols="40" rows="10"></textarea>
                                </div>
                    	
                    	<?php 
                    		$var_controle=1;
		            		echo "<input type='hidden' name='var_controle' id='var_controle' value='$var_controle'>";
		            		echo "<input type='hidden' name='id_edit' id='id_edit' value='$id_edit'>";
                    	}
                    	?>
                      	<div class="row field_text alignleft">
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
</body>
</html>

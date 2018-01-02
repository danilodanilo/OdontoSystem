<?php 
session_start();

$usuario = $_SESSION['usuario'];
$id = $_SESSION['id'];
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

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="HTML/css/ie.css" />
<![endif]-->
<link href="HTML/custom.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="body_wrap">

	<div class="header">   
     	
        <div class="header_top">
			<div class="container">
                <div class="logo"><a href="#"><img src="HTML/images/col_icon_2.png" width="210" height="80" alt="Medica" /></a></div>
                <div class="header_contacts">
                </div>
            </div>
        </div>
 </div>

<div class="aligncenter" align="center">
                        
                    <!-- login widget -->
                    <div class="widget-container widget_login" align="left">
                    	<h3 align="center">Cadastramento de nova Senha</h3>
                        <p><label>Sua senha foi resetada. Cadastre uma nova senha para continuar</label><br/>
                      <form action="valida_nova_senha.php" method="post" id="loginform" class="loginform">
                        
                        <p><label>Usu&aacute;rio</label><br/>
                        <?php 
                        echo "<input name='usuario' id='usuario' class='input' value=$usuario size='20' tabindex='10' type='text'></p>";
                        
                        ?>
						<p><label>Senha</label><br />
                        <input name="senha" id="senha" class="input" value="" size="20" tabindex="20" type="password"></p>
                        <p><label>Repita a Senha</label><br />
                        <input name="repita_senha" id="repita_senha" class="input" value="" size="20" tabindex="20" type="password"></p>
                        
                        <p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /><label>Remember Me</label></p>
                        <p class="submit">
                            <input type="submit" name="wp-submit" id="wp-submit" class="btn-submit" value="Entrar" tabindex="100" />
                            <input type="hidden" name="redirect_to" value="" />
                            <input type="hidden" name="testcookie" value="1" />
                        </p>                        
                        
                      </form>
                    </div>
                    <!--/ login widget --> 
      
                        
					</div>
					
</body>
</html>
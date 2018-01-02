<?php
//session_start();
include ('conecta_banco.php');
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_cript = md5($senha);

$sql_logar = "SELECT id, perfil, controle FROM users WHERE username = '$usuario' and password = '$senha_cript'";
$exe_logar = mysql_query($sql_logar) or die (mysql_error());


$num_logar = mysql_num_rows($exe_logar);

//Verifica se n existe uma linha com o login e a senha digitado
if ($num_logar == 0){
	?>
			<script language="javascript">
				alert("Login ou senha inválido");
				window.location.href = 'login.php';
			</script>
	<?php
  
} 
else{
   //Cria a sessão e manda pra pagina principal.php
   //ob_start();
   session_start();
   $id = mysql_result($exe_logar, 0, 'id');
   $perfil = mysql_result($exe_logar, 0, 'perfil');
   $controle = mysql_result($exe_logar, 0,'controle');
   $_SESSION['usuario'] = $usuario;
   $_SESSION['senha'] = $senha;
   $_SESSION['id'] = $id;
   $_SESSION['perfil'] = $perfil;
   
   if($controle==1) {
		header('Location:usuario_nova_senha.php');
   }
   else{
	   header('Location:index.php');
   }
}
?>
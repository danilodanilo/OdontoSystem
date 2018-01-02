<?php
session_start();
unset($_SESSION['nome_paciente']);
unset($_SESSION['email']);
unset($_SESSION['dt_nasc']);
unset($_SESSION['cpf']);
unset($_SESSION['rg']);
unset($_SESSION['endereco']);
unset($_SESSION['bairro']);
unset($_SESSION['cidade']);
unset($_SESSION['tel']);
unset($_SESSION['cel']);
unset($_SESSION['profissao']);
//if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])){
	//echo "<font color='#000000'><b> Bye '$_SESSION['usuario']' </font>";
	//session_unset();
	unset($_SESSION['usuario']);
	session_destroy();
	//ob_end_flush();
	header('Location:login.php');
//}
?>
<?php
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
include 'conecta_banco.php';
include 'funcoes.php';

$email		= $_POST["email"];	// Pega o valor do campo Email
// Vari�vel que junta os valores acima e monta o corpo do email

if (validaEmail($email)){
	
	$sql = "Select id from users where email='$email'";
	$exec_qry=mysql_query($sql) or die();
	$resul = mysql_num_rows($exec_qry);
	
	if($resul != 0){
		$id = mysql_result($exec_qry, 0, 'id');
		
		$Vai = "Sua senha foi alterada para a senha padr�o. \n No pr�ximo login, utilize a nova senha\n Nova Senha: 12345";
		
		require_once("phpmailer/class.phpmailer.php");
	
		define('GUSER', 'danilo.dan4@gmail.com');	// <-- Insira aqui o seu GMail
		define('GPWD', '07364847');		// <-- Insira aqui a senha do seu GMail
		$senha = '12345';
		$senha_crpt=md5($senha);
		
		// Insira abaixo o email que ir� receber a mensagem, o email que ir� enviar (o mesmo da vari�vel GUSER), 
		//o nome do email que envia a mensagem, o Assunto da mensagem e por �ltimo a vari�vel com o corpo do email.
		if (smtpmailer($email, 'danilo.dan4@gmail.com', 'OdontoSystem', 'Recupera��o de Senha', $Vai)) {
			
			
			//$sql2 = "Update users set password='12345' where id='$id'";
			mysql_query("Update users set password='$senha_crpt', controle='1' where id='$id'") or die();
			?>
				<script language="javascript">
					alert("A senha foi enviada para o e-mail informado");
					window.location.href = 'login.php';
				</script>
			<?php
		}
		if (!empty($error)) 
			echo $error;
	}
	else{
		?>
		<script language="javascript">
			alert("E-mail n�o encontrado na base de dados");
			window.location.href = 'esqueceu_senha.php';
		</script>
		<?php
	}
}
else{
	?>
	<script language="javascript">
		alert("Digite um endere�o de e-mail valido");
		window.location.href = 'esqueceu_senha.php';
	</script>
	<?php
}
?>

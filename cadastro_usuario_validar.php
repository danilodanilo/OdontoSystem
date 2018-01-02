<?php

session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
include ('conecta_banco.php');
include 'funcoes.php';


$var_controle = $_POST['var_controle'];


if($var_controle==0){//nao é editar
	$novo_usuario = $_POST['nome_usuario'];
	$_SESSION['novo_usuario'] = $_POST['nome_usuario'];
	$senha = $_POST['senha'];
	$_SESSION['senha_novo_usuario'] = $_POST['senha'];
	$perfil = $_POST['perfil'];
	$_SESSION['perfil_novo_usuario'] = $_POST['perfil'];
	$email = $_POST['email'];
	$_SESSION['email_novo_usuario'] = $_POST['email'];
	//verifca se usuario nao esta cadastrado
	$sql = "Select id from users where username='$novo_usuario' ";
	$sql_exec = mysql_query($sql) or die(mysql_error());
	$result = mysql_num_rows($sql_exec);
	if($result > 0){
		?>
		<script language="javascript">
			alert("Usuário já cadastrado");
			window.location.href = 'novo_usuario.php';
		</script>
	<?php
}
else{
	$senha_cript = md5($senha);
	
	if($perfil == 'dentista')
		$perfil_valor = 5;
	else if($perfil == 'secretaria')
		$perfil_valor = 0;
		
	if(!empty($novo_usuario)&& !empty($senha) && !empty($email)){
		$ret_email = validaEmail($email);
		if($ret_email == false){
						?>
								<script language="javascript">
								alert("Preencha o campo email no formato abcdef@abcdef.com.xx");
								window.location.href = 'novo_usuario.php';
								</script>
						<?php
		}
		else{
				$sql_insert = "INSERT INTO USERS VALUES (' ', '$novo_usuario', '$senha_cript', '$email','$perfil_valor','0')";
				$exe_busca = mysql_query($sql_insert) or die (mysql_error());
		}
		
	}
	else {
	?>
		<script language="javascript">
			alert("Preencha corretamente os campos");
			window.location.href = 'novo_usuario.php';
		</script>
	<?php
	}
	
	if($exe_busca){
	?>
		<script language="javascript">
			alert("Usuário Cadastrado");
			window.location.href = 'novo_usuario.php';
		</script>
	<?php }
}
}else{
	$id_edit = $_POST['id_edit'];
	$nome_edit = $_POST['nome_usuario_edit'];
	$email_edit = $_POST['email_edit'];
	$senha_edit = $_POST['senha_edit'];
	$perfil_edit = $_POST['perfil_edit'];
	
	if($perfil_edit == 'secretaria' || $perfil_edit == 'Secretaria' || $perfil_edit == 'secretária' ){
	       $perfil_valor = 0; 
	}
	else{
	        $perfil_valor = 5;                    			
	}
	
	$senha_edit_crpt = md5($senha_edit);
	
	$query = "update users set username='$nome_edit', password='$senha_edit_crpt', email='$email_edit', perfil='$perfil_valor' where id=$id_edit";
	
	$sql_edit = mysql_query($query) or die();	
	if($sql_edit){
	
	?>
	<script language="javascript">
			alert("Informações salvas com sucesso");
			window.location.href = 'novo_usuario.php';
		</script>
		<?php 
	}else{
			?>
	<script language="javascript">
			alert("Erro na edição");
			window.location.href = 'novo_usuario.php';
		</script>
		<?php 
	}
}
?>
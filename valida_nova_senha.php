<?php
session_start();
include 'conecta_banco.php';


$id = $_SESSION['id'];
$senha = $_POST['senha'];
$repita_senha = $_POST['repita_senha'];

if($senha != $repita_senha){
	?>
			<script language="javascript">
				alert("Repita a senha corretamente");
				window.location.href = 'usuario_nova_senha.php';
			</script>
		<?php
}

else{
	$senha_crpt = md5($senha);
	$sql = "Update users set password = '$senha_crpt', controle = '0' where id = '$id'";
	$qry = mysql_query($sql) or die();

	if($qry){
		?>
			<script language="javascript">
				alert("Senha alterada com sucesso");
				window.location.href = 'index.php';
			</script>
		<?php
	}
}
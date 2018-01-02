<?php
session_start();
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$id = $_GET['id'];

$query = "update table users where id=$id set controle = 1";
$sql = mysql_query($query);

if($sql){
		?>
		<script language="javascript">
			alert("Usuário deletado do sistema");
			window.location.href = 'novo_usuario.php';
		</script>
	<?php
}else{
		?>
		<script language="javascript">
			alert("Problema durante a deleção");
			window.location.href = 'novo_usuario.php';
		</script>
	<?php
}

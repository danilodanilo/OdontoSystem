<?php

session_start();
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$id = $_GET['id'];
$sql = mysql_query("delete from medicamentos where id=$id");

if($sql){
	unset($_SESSION['nome_medicamento']);
	unset($_SESSION['estoque']);
	
?>
			<script language="javascript">
			alert("Medicamento Excluído");
			window.location.href = "novo_medicamento.php"; 
			</script>
<?php
}else{
	?>
	<script language="javascript">
			alert("Erro na Exclusão");
			window.history.go(-1);
	</script>
	<?php
}

?>
<?php

session_start();
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$id = $_GET['id'];
$sql = mysql_query("update fornecedores set controle=1 where id=$id");

if($sql){
	//echo 'entrei aqui'
?>
			<script language="javascript">
			alert("Fornecedor Exclu�do");
			window.location.href = "novo_fornecedor.php"; 
			</script>
<?php
}else{
	?>
	<script language="javascript">
			alert("Erro na Exclus�o");
			window.history.go(-1);
	</script>
	<?php
}

?>
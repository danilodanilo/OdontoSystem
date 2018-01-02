<?php
session_start();
include 'conecta_banco.php';
$id = $_GET['id'];

if (!empty($id)){
	
	$qry = "update pag_pagar set controle = 1 where id=$id";
	$sql = mysql_query($qry);
	
	if($sql){
		?>
		<script language="javascript">
				alert("Pagamento Excluído");
				window.history.go(-1);
				</script>
		<?php 
	}else{
		?>
		<script language="javascript">
				alert("Erro ao Excluír");
				window.history.go(-1);
				</script>
		<?php 
	}
	
}
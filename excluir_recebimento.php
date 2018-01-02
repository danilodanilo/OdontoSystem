<?php
include 'conecta_banco.php';

if(!empty($_GET['id'])){
	$id = $_GET['id'];
	
}

$query = "UPDATE `pag_receber` SET controle=1 where id=$id";
//echo $query;
$sql = mysql_query($query);

if($sql){
	?>
				<script language="javascript">
				alert("Recebimento Excluído");
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

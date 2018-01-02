<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$id = $_GET['id'];

$query = "delete from procedimentos where id=$id";
$sql = mysql_query($query);

if($sql){

	?>
<script language="javascript">
				alert("Procedimento excluído com Sucesso");
				window.location.href = 'novo_procedimento.php';
</script>
	<?php
}else{
	?>
<script language="javascript">
				alert("Erro no SQL");
				window.location.href = 'novo_procedimento.php';
</script>
	<?php
}

<?php
include 'conecta_banco.php';
$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = '';
$dbname = 'consultoriomysql';

$backup_file = $dbname . date("dmY") . '.gz';
$command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ".
           "test_db | gzip > $backup_file";

$ret=system($command);
if($ret){
	?>
		<script language="javascript">
			alert("Backup realizado com sucesso");
			window.location.href = 'index.php';
		</script>
	<?php
}
else{
	?>
		<script language="javascript">
			alert("Ocorreu um erro");
			window.location.href = 'index.php';
		</script>
	<?php
}
?>
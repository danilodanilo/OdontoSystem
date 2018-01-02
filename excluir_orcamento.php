<?php
session_start();
include 'conecta_banco.php';
include 'funcoes.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if (!empty($_GET['id_orcamento'])){
	$id_orcamento = $_GET['id_orcamento'];
	//echo $id_orcamento;
}else
echo "ERRO";
if (!empty($_GET['id_procedimento'])){
	$id_procedimento = $_GET['id_procedimento'];
	//echo $id_procedimento;
}else
echo "ERRO";


$query = "delete from orcamento_procedimento where id_orcamento=$id_orcamento and id_procedimento=$id_procedimento";
$result = mysql_query($query);

if($result){


	$query2 = "select count(id_orcamento) as total from orcamento_procedimento where id_orcamento=$id_orcamento";
	$result2 = mysql_query($query2);
	if($result2)
		$total= mysql_result($result2, 0, 'total');	
	//$count = mysql_num_rows($result2);

	if($total > 0){
//		echo $count;


		?>
<script language="javascript">
									alert("Item Deletado do Orçamento");
									id_orcamento = <?php echo $id_orcamento;?>;
									window.location.href="orcamento_finalizar.php?id_orcamento="+id_orcamento;
									</script>


		<?php
			
	}else{
		$query3 = "delete from orcamento where id=$id_orcamento";
		$result3 = mysql_query($query3);
		
		if($result3){
				?>
<script language="javascript">
									alert("Orcamento Deletado");
									id_orcamento = <?php echo $id_orcamento;?>;
									window.location.href="index.php";
									</script>


		<?php
			
		}
		else{
		?>
			<script language="javascript">
									alert("ERRO SQL Delete Orçamento");
									window.location.href="orcamento.php";
									</script>
									<?php 
		}
	}
	
}
else{
		?>
<script language="javascript">
									alert("ERRO SQL Delete");
									window.location.href="orcamento.php";
									</script>
		<?php
}

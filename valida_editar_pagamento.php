<?php

session_start();
include 'conecta_banco.php';
include 'funcoes.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

if (!empty($_GET['id'])){
	$id = $_GET['id'];
}


if(!empty($_GET['nome_recebedor'])){
	$nome_recebedor = $_GET['nome_recebedor'];
	if (!empty($_GET['data'])){
		$data = $_GET['data'];
		$data_format = formatarData($data);
		if (!empty($_GET['valor'])){
			$valor = $_GET['valor'];
			$parcelas = $_GET['parcelas'];
			if($parcelas=="")
			$parcelas="";

			$descricao = $_GET['descricao'];
			if($descricao=="")
			$descricao="";
			if (!empty($_GET['status'])){
				$status = $_GET['status'];

				$query = "update pag_pagar set pag_descricao='$descricao', pag_n_parcelas='$parcelas',pag_valor='$valor',
				controle=0,status='$status',data='$data_format', nome_recebedor='$nome_recebedor' where id=$id
				";
				//	echo $query;
				$sql = mysql_query($query);

				if($sql){
					?>
<script language="javascript">
										alert("Informações salvas com Sucesso");
										window.location.href = "pagamentos.php"; 
										</script>
					<?php
				}else{
					?>
<script language="javascript">
										alert("Erro SQL!");
										window.history.go(-1);
										</script>
					<?php
				}
			}else{
				?>
<script language="javascript">
										alert("Preencha o campo Status");
										window.history.go(-1);
										</script>
				<?php
			}
		}else {
			?>
<script language="javascript">
										alert("Preencha o campo Valor");
										window.history.go(-1);
										</script>
			<?php
		}
	}else{
		?>
<script language="javascript">
										alert("Preencha o campo Data");
										window.history.go(-1);
										</script>
		<?php
	}
}else{
	?>
<script language="javascript">
										alert("Preencha o campo Nome do Recebedor");
										window.history.go(-1);
										</script>
	<?php
}






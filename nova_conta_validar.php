<?php
include 'conecta_banco.php';
include 'funcoes.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if(!empty($_GET['nome_paciente'])){
	$nome_paciente = $_GET['nome_paciente'];
	$_SESSION['nome_paciente'] = $nome_paciente;
	$query = "select id from pacientes where nome='$nome_paciente' " or die();
	$sql = mysql_query($query);
	echo $nome_paciente;


	if($sql){
		$id = mysql_result($sql, 0,'id');
		if(!empty($_GET['valor'])){
			
			$valor = $_GET['valor'];
			$_SESSION['valor'] = $valor;
			//$data_format = formatarData($data);
			if(!empty($_GET['data'])){
				$data = $_GET['data'];
				$data_format = formatarData($data);
				$_SESSION['data'] = $data;
				$status = $_GET['status'];
				if (!empty($_GET['parcelas'])){
					$parcelas = $_GET['parcelas'];
				}else{
					//$descricao="";
					$parcelas = "";
					//$query_1 = "insert into pag_receber values ('',$id, '$descricao','$data', '',$valor,0)";
				}
				if (!empty($_GET['descricao'])){
					$descricao = $_GET['descricao'];


				}else{
					$descricao = "";
					//$query_1 = "insert into pag_receber values ('',$id, '','$data', '$parcelas',$valor,0)";
				}

				$query_1 = "insert into pag_receber values ('',$id, '$descricao','$parcelas','$valor',0,'$status','$data_format')";
				$sql2 = mysql_query($query_1);

				if($sql2){
					?>
<script language="javascript">
				alert("Conta Cadastrada com Sucesso");
				window.location.href = "pagamentos.php";
				</script>
					<?php
				}else{
					?>
<script language="javascript">
				alert("Erro SQL");
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
				alert("Preencha o campo Valor R$");
				window.history.go(-1);
				</script>
			<?php
		}


	}else{
		?>
<script language="javascript">
				alert("Paciente não Encontrado");
				window.history.go(-1);
				</script>
		<?php
	}

}else{
	?>
<script language="javascript">
				alert("Preencha o campo Nome do Paciente");
				window.history.go(-1);
				</script>
	<?php
}


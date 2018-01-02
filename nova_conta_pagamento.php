<?php
session_start();
include 'conecta_banco.php';
include 'funcoes.php';
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
if(!empty($_GET['nome_recebedor'])){
	$nome_recebedor = $_GET['nome_recebedor'];
	$_SESSION['nome_recebedor'] = $nome_recebedor;

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
				$_SESSION['parcelas'] = $parcelas;
			}else{
				//$descricao="";
				$parcelas = "";
				//$query_1 = "insert into pag_receber values ('',$id, '$descricao','$data', '',$valor,0)";
			}
			if (!empty($_GET['descricao'])){
				$descricao = $_GET['descricao'];
				$_SESSION['descricao'] = $descricao;


			}else{
				$descricao = "";
				//$query_1 = "insert into pag_receber values ('',$id, '','$data', '$parcelas',$valor,0)";
			}

			$query_1 = "insert into pag_pagar values ('','$descricao','$parcelas','$valor',0,'$status','$data_format','$nome_recebedor')";
			//echo $query_1;
			$sql2 = mysql_query($query_1);
			
			unset($_SESSION['nome_recebedor']);
			unset($_SESSION['valor']);
			unset($_SESSION['data']);
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
				alert("Preencha o campo Nome do Paciente");
				window.history.go(-1);
				</script>
	<?php
}
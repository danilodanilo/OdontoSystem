<?php
session_start();

include 'funcoes.php';
include 'conecta_banco.php';
$controle = $_POST['controle'];

if (!empty($_POST['nome_procedimento']))
	$_SESSION['nome_procedimento'] = $_POST['nome_procedimento'];
if (!empty($_POST['valor']))
	$_SESSION['valor'] = $_POST['valor'];

if ($controle==0){

	if (!empty($_POST['nome_procedimento'])){
		$nome_procedimento = $_POST['nome_procedimento'];
		if (!empty($_POST['valor'])){
			$valor = $_POST['valor'];
			$cod_proc = rand(100,999);
			$query = "insert into procedimentos values('','$cod_proc','$nome_procedimento','$valor')";
			//echo $query;
			$sql = mysql_query($query);
			if($sql){
				unset($_SESSION['nome_procedimento']);
				unset($_SESSION['valor']);
				?>
			
<script language="javascript">
				alert("Procedimento Cadastrado com Sucesso");
				window.location.href = 'novo_procedimento.php';
</script>
			<?php
			}else{
				?>
<script language="javascript">
				alert("Erro no SQL");
				window.history.go(-1);
				</script>
				<?php
			}
		}else{?>
<script language="javascript">
				alert("Preencha o campo Valor");
				window.history.go(-1);
</script>
		<?php
		}
	}

	else{?>
<script language="javascript">
				alert("Preencha o campo Nome do Procedimento");
				window.history.go(-1);
</script>
	<?php
	}
}else{
	$id_edit = $_POST['id_edit'];
	if (!empty($_POST['nome_procedimento'])){
		$nome_procedimento = $_POST['nome_procedimento'];
		if (!empty($_POST['valor'])){
			$valor = $_POST['valor'];
			//$cod_proc = rand(100,999);
			$query = "update procedimentos set nome_procedimento='$nome_procedimento', valor_procedimento='$valor' where id=$id_edit";
			//echo $query;
			$sql = mysql_query($query);
			if($sql){?>
<script language="javascript">
				alert("Procedimento Alterado com Sucesso");
				window.location.href = 'novo_procedimento.php';
</script>
			<?php
			}else{
				?>
<script language="javascript">
				alert("Erro no SQL");
				window.history.go(-1);
				</script>
				<?php
			}
		}else{?>
<script language="javascript">
				alert("Preencha o campo Valor");
				window.history.go(-1);
</script>
		<?php
		}
	}

	else{?>
<script language="javascript">
				alert("Preencha o campo Nome do Procedimento");
				window.history.go(-1);
</script>
	<?php
	}
}
?>
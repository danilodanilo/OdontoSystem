<?php
session_start();
include 'conecta_banco.php';
$controle = $_POST['controle'];

if ($controle == 0){//nao é editar
	if(empty($_POST['nome_medicamento'])){
		?>
<script language="javascript">
				alert("Preencha o campo Nome do Medicamento");
				window.history.go(-1);
				</script>
		<?php
	}else{
		$nome_medicamento = $_POST['nome_medicamento'];
		$_SESSION['nome_medicamento'] = $nome_medicamento;
	}

	if (empty($_POST['estoque'])){
		?>
<script language="javascript">
				alert("Preencha o campo Quantidade em Estoque");
				window.history.go(-1);
				</script>
		<?php
	}else{
		$estoque = $_POST['estoque'];
		$_SESSION['estoque'] = $estoque;
	}
	if(empty($_POST['dados_ad']) && !empty($estoque) && !empty($nome_medicamento)){
		$query = "insert into medicamentos values ('','$nome_medicamento','$estoque','vazio')";

		$sql = mysql_query($query);

		if($sql){
			unset($_SESSION['nome_medicamento']);
			unset($_SESSION['estoque']);
			?>
<script language="javascript">
				alert("Medicamento Cadastrado");
				window.history.go(-1);
				</script>
			<?php
		}else{
			if(!empty($_SESSION['dados']))
			$_SESSION['dados'] = $dados_adicionais;
			?>
<script language="javascript">
				alert("Erro SQL");
				window.history.go(-1);
				</script>
			<?php

		}
	}else{
		if(!empty($nome_medicamento) && !empty($estoque)){
			$dados_adicionais = $_POST['dados_ad'];
			$query = "insert into medicamentos values ('','$nome_medicamento','$estoque','$dados_adicionais')";
			//echo $query;
			$sql = mysql_query($query);

			if($sql){
				unset($_SESSION['nome_medicamento']);
				unset($_SESSION['estoque']);
				unset($_SESSION['dados_ad']);
				?>
<script language="javascript">
				alert("Medicamento Cadastrado");
				window.history.go(-1);
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
		}
	}
}else{
	$id_edit = $_POST['id_edit'];
	if(empty($_POST['nome_medicamento'])){
		?>
<script language="javascript">
				alert("Preencha o campo Nome do Medicamento Edit");
				window.history.go(-1);
				</script>
		<?php
	}else{
		$nome_medicamento_edit = $_POST['nome_medicamento'];
		$_SESSION['nome_medicamento'] = $nome_medicamento_edit;
	}

	if (empty($_POST['estoque'])){
		?>
<script language="javascript">
				alert("Preencha o campo Quantidade em Estoque");
				window.history.go(-1);
				</script>
		<?php
	}else{
		$estoque_edit = $_POST['estoque'];
		$_SESSION['estoque'] = $estoque_edit;
	}
	if(empty($_POST['dados_ad']) && !empty($estoque) && !empty($nome_medicamento)){
		
		$query = $query = "update medicamentos set nome_medicamento='$nome_medicamento_edit',qtd_medicamento = '$estoque_edit' where id=$id_edit";
		

		$sql = mysql_query($query);

		if($sql){
			unset($_SESSION['nome_medicamento']);
			unset($_SESSION['estoque']);
			?>
			
<script language="javascript">
				alert("Medicamento Editado");
				window.location.href = "novo_medicamento.php"; 
				</script>
			<?php
		}else{
			if(!empty($_SESSION['dados']))
			$_SESSION['dados'] = $dados_adicionais;
			?>
<script language="javascript">
				alert("Erro SQL Edit");
				window.history.go(-1);
				</script>
			<?php

		}
	}else{
		if(!empty($nome_medicamento_edit) && !empty($estoque_edit)){
			$dados_adicionais_edit = $_POST['dados_ad'];
			$query = "update medicamentos set nome_medicamento='$nome_medicamento_edit',qtd_medicamento = '$estoque_edit',dados_adicionais = '$dados_adicionais_edit' where id='$id_edit'";
			//echo $query;
			$sql = mysql_query($query);

			if($sql){
				unset($_SESSION['nome_medicamento']);
			unset($_SESSION['estoque']);
				?>
			
<script language="javascript">
				alert("Medicamento Editado ");
				window.location.href = "novo_medicamento.php";
				</script>
				<?php
			}else{
				?>
<script language="javascript">
				alert("Erro SQL Edit ");
				window.history.go(-1);
				</script>
				<?php

			}
		}
	}
}

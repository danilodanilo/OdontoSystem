<?php
session_start();
include 'funcoes.php';
include 'conecta_banco.php';
$paciente= $_GET['paciente'];
$quadrante = $_GET['quadrante'];
$procedimento = $_GET['procedimento'];
$n_dente = $_GET['n_dente'];
$descricao = $_GET['descricao'];
$parcelas = $_GET['parcelas'];
$_SESSION['nome_paciente_fk'] = $paciente;

if(!empty($_SESSION['ultimo_inserido'])){
	$ultimo = $_SESSION['ultimo_inserido'];
	$query3 = "select id from procedimentos where nome_procedimento = '$procedimento'";
	$result3 = mysql_query($query3);
	if ($result3)
		$id_proc = mysql_result($result3, 0);
		
	
	$sql_orcamento = "insert into orcamento_procedimento values($ultimo,$id_proc)";
	$result_orcamento = mysql_query($sql_orcamento);
	
	if($result_orcamento){
		$consulta = "select MAX(id_orcamento) from orcamento_procedimento";
		$roda = mysql_query($consulta);
		
		$ultimo_inserido = mysql_result($roda, 0)
		?>
		<script language="javascript">
									alert("Orçamento Inserido");
									var resposta = confirm("Inserir outro item de Orçamento para este Paciente ?"); 
									//var valor = null;  
									var id_orcamento = <?php echo $ultimo;?>;
									if (resposta) { 
										var conteudo = <?php echo $ultimo_inserido;?>;
										
										
										
										window.location.href="orcamento.php?ultimo="+conteudo;
										
									}
									else{
										<?php 
										//unset($_SESSION['nome_paciente_fk']);
									//	unset($_SESSION['id_paciente_fk']);
										unset($_SESSION['ultimo_inserido']);
										
										?>
										window.location.href="orcamento_finalizar.php?id_orcamento="+id_orcamento;
									
									}
										
									
									
									</script>
										<?php
		
		
	}
	else{
		?>
		<script language="javascript">
									alert("ERRO SQL");
									window.location.href="orcamento.php";
									</script>
		<?php
	}
}
else{
	$data = date("d/m/Y");
	$data_format = formatarData($data);
	if ($descricao == "")
	$descricao = "Sem Descrição";
	if($parcelas=="")
	$parcelas = "0";

	$query = "select id from pacientes where nome = '$paciente' and controle=0" ;
	//echo $query;

	$result = mysql_query($query);

	if ($result)
		$id_paciente = mysql_result($result, 0);
		//echo $id_paciente;
		
		$_SESSION['id_paciente_fk'] = $id_paciente;
		$query3 = "select id from procedimentos where nome_procedimento = '$procedimento'";
		$result3 = mysql_query($query3);
	if ($result3)
		$id_proc = mysql_result($result3, 0);

	$query2 = "insert into orcamento values ('','$data_format','$parcelas','$procedimento','$n_dente','$descricao',$id_paciente, $id_proc)";
	//echo $query2;
	$result2 = mysql_query($query2);

	if ($result2){
		$ultimo_inserido = mysql_insert_id();
			$sql_orcamento = "insert into orcamento_procedimento values($ultimo_inserido,$id_proc)";
			$result_orcamento = mysql_query($sql_orcamento);
			//if()
		
		?>
								<script language="javascript">
									alert("Orçamento Inserido");
									var resposta = confirm("Inserir outro item de Orçamento para este Paciente ?"); 
									//var valor = null;  
									var id_orcamento = <?php echo $ultimo_inserido;?>;
									if (resposta) { 
										var conteudo = <?php echo $ultimo_inserido;?>;
										
										window.location.href="orcamento.php?ultimo="+id_orcamento;
									}
									else{
										<?php 
						//				unset($_SESSION['nome_paciente_fk']);
										//unset($_SESSION['id_paciente_fk']);
										unset($_SESSION['ultimo_inserido']);
										?>
										window.location.href="orcamento_finalizar.php?id_orcamento="+id_orcamento;
									
									}
										
									
									
									</script>
										<?php

	}else{
		?>
<script language="javascript">
									alert("ERRO SQL");
									window.location.href="orcamento.php";
									</script>
		<?php
	}


}
//	echo $id_paciente;
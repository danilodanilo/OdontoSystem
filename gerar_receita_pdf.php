<?php

if (!empty($_GET['nome'])){
	$nome_paciente = $_GET['nome']; 
}else{
	?>
				<script language="javascript">
				alert("Preencha o campo Nome do Paciente");
				window.history.go(-1);
				</script>
				<?php
}
if (!empty($_GET['receita'])){
	$receita = $_GET['receita']; 
}else{
	?>
				<script language="javascript">
				alert("Preencha o campo Receita");
				window.history.go(-1);
				</script>
				<?php
}

$html = "
<h1>Receita</h1>
<h2>Paciente: $nome_paciente</h2>

<hr />

<div lang='pt-BR'>$receita</div>
<hr />
<address>Endereço: Rua Sto Antônio, nº 1232 - Morungaba São Paulo.</address>
<address>Telefone 11 4141111.</address>

";


//==============================================================
//==============================================================
//==============================================================

include("MPDF57/mpdf.php");

$mpdf=new mPDF('ISO-8859-9'); 
$html = iconv("ISO-8859-9","UTF-8",$html);
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetWatermarkImage('HTML/images/col_icon_2.png', 1, '', array(160,10));
$mpdf->showWatermarkImage = true;

$mpdf->WriteHTML('<h2>Cl&iacute;nica MDN</h2>');
$mpdf->WriteHTML($html);

$mpdf->Output($nome_paciente,'D');
exit;

//==============================================================
//==============================================================
//==============================================================


?>
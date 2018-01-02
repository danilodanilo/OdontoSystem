<?php
include 'conecta_banco.php';
include 'funcoes.php';

$id = $_GET['id_orcamento'];
	 
$sql = "SELECT a.id_orcamento, a.id_procedimento, c.valor_procedimento, c.nome_procedimento, d.nome
														FROM orcamento_procedimento a
														INNER JOIN orcamento b ON a.id_orcamento = b.id
														INNER JOIN procedimentos c ON a.id_procedimento = c.id
														inner join pacientes d on d.id=b.fk_pacientes
														WHERE a.id_orcamento =$id";
$result = mysql_query($sql);
$count = mysql_num_rows($result);
$orcamento_numero = $id;
$valor_total = 0;

$html='';

$html =  "<h3>Procedimentos:</h3>";
//$valor=1;
if ($sql){
	//echo $sql;
	
	$nome_paciente = mysql_result($result, 0,'d.nome');
	$html2 = '';
	$valor2 = '';
	for ($i=0; $i<$count; $i++){
		//echo 'entrei';
		$nome_procedimento = mysql_result($result, $i, 'c.nome_procedimento');
		$valor = mysql_result($result, $i, 'c.valor_procedimento');
		
		$valor_total = $valor_total + $valor;
		
		$html2 .= "<br>$nome_procedimento"."_________________________________________________________________________________"."$valor"."</br>";
		//$valor2 .= "$valor";
		
	}
	
}
$valor_total_format = number_format($valor_total, 2, ',', '.');
$html .= $html2;
//echo $html.$html2;

$html = "<h1>Orçamento</h1>
		<h2>Paciente: $nome_paciente</h2>
		<h2>Orçamento Nº: $id </h2>";

$html .= "

<hr>

<div lang='pt-BR' align='right'> $html2</div>
<br><div lang='pt-BR' align='right'>Valor Total_________________________________________________________________________________$valor_total_format</div></br>
<hr />
<address align='center'>Endereço: Rua Sto Antônio, nº 1232 - Morungaba São Paulo.</address>
<address align='center'>Telefone 11 4141111.</address>";


//==============================================================
//==============================================================
//==============================================================

include("MPDF57/mpdf.php");

$mpdf=new mPDF('ISO-8859-9'); 
$html = iconv("ISO-8859-9","UTF-8",$html);
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetWatermarkImage('HTML/images/col_icon_2.png', 1, '', array(160,10));
$mpdf->showWatermarkImage = true;

$mpdf->WriteHTML('<h2>Cl&iacute;nica MDN</h2>',1);
$mpdf->WriteHTML($html,2);
//$arquivo = $nome_paciente.'.pdf';
$mpdf->Output($nome_paciente, 'I');
exit;





?>
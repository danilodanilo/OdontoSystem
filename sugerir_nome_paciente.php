<?php

include 'conecta_banco.php';

//echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
//require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;
 
$sql = "Select nome from pacientes where nome like '$q%' and controle = 0";
$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
    $cname = $rs['nome'];
    echo "$cname\n";
}

?>

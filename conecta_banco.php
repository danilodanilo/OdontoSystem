<?php

$dbname='consultoriomysql'; // Indique o nome do banco de dados que

//$usuario=� �; // Indique o nome do usu�rio que tem
//acesso
//$password=� �; // Indique a senha do usu�rio
//1� passo � Conecta ao servidor MySQL
mysql_connect("localhost","root","") or die(mysql_error());
//2� passo � Seleciona o Banco de Dados
$con=mysql_select_db($dbname) or die(mysql_error());
?>
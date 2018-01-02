<?php
session_start();


/*
 * Criamos a inst�ncia de nosso cliente de webservice.
 * Especificamos a localiza��o e o namespace do servidor de
 * webservice. 
 * Passando null no primeiro par�metro do construtor indicamos
 * que o webservice ir� trabalhar no modo n�o WSDL.
 */
$options = array(
	'location' => 'http://messias.zz.mu/teste_sd.php',
	'uri' => 'http://127.0.0.1/soap/server/'
);

$client = new SoapClient(null, $options);
//ao inves de mensagem, ser� o algoritmo de backtracking
$valor = 12;
echo $client->mensagem('teste') . "<br />";

//echo $client->soma(3, 5) . "<br />";


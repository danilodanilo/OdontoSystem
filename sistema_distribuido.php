<?php
session_start();


/*
 * Criamos a instância de nosso cliente de webservice.
 * Especificamos a localização e o namespace do servidor de
 * webservice. 
 * Passando null no primeiro parâmetro do construtor indicamos
 * que o webservice irá trabalhar no modo não WSDL.
 */
$options = array(
	'location' => 'http://messias.zz.mu/teste_sd.php',
	'uri' => 'http://127.0.0.1/soap/server/'
);

$client = new SoapClient(null, $options);
//ao inves de mensagem, será o algoritmo de backtracking
$valor = 12;
echo $client->mensagem('teste') . "<br />";

//echo $client->soma(3, 5) . "<br />";


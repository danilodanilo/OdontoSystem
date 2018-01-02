<?php

// Constantes - Valores obtidos no menu Ferramentas -> Gateway do Mister Postman
$UserID = '7b454be3-635e-4acc-8c6c-3e99241b6179';
$Token = '17705486';

// numero destino -  2 digitos codigo pais ( Brasil = 55 ) + 2 digitos codigo de area + numero do celular
$destino = '5511963370101';

// mensagem a ser enviada
$mensagem = 'Testando o gateway !';

// Codifica a mensagem - URLEncode
$mensagem = urlencode($mensagem);

// Monta a URL para acionar o Gateway
$URLGateway = 'http://www.misterpostman.com.br/gateway.aspx?UserID='.$UserID.'&Token='.$Token.'&NroDestino='.$destino.'&Mensagem='.$mensagem.'';

// Aciona o Gateway  - Opção ideal para PHP 4.3.x ou superior 
$Content = file_get_contents($URLGateway);

// Coloca no video a resposta do gateway
echo $Content; 

?>
                      
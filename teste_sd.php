<?php
/* Criamos a inst�ncia do SoapServer.
 * A op��o uri indica o namespace do webservice no servidor.
 * O primeiro par�metro null indica que estamos trabalhando 
 * com um webservice no modo n�o WSDL.  
 */
$options = array('uri' => 'http://messias.zz.mu/teste_sd.php');
$server = new SoapServer(null, $options);

/* 
 * Informamos a classe em que o webservice ir� se basear.
 * Podemos usar tamb�m o m�todo addFunction() para adicionar 
 * fun��es em nosso webservice. 
 */
$server->setClass('SoapServerExemplo');
/*
 * O m�todo handle() processa a requisi��o SOAP e envia uma resposta 
 * para o cliente.
 */
$server->handle();

/*
 * A classe SoapServerExemplo ser� disponibilizada em nosso 
 * webservice. Portanto temos dispon�veis no webservice os m�todos 
 * mensagem e soma.
 */
class SoapServerExemplo {
	//aqui vai minha funcao backtracking
	public function mensagem($nome)
	{
		if($nome > 10)
			return "Recebi o Nome $nome !";
		else
			return 'menor';
	}

	
}
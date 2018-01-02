<?php
/* Criamos a instância do SoapServer.
 * A opção uri indica o namespace do webservice no servidor.
 * O primeiro parâmetro null indica que estamos trabalhando 
 * com um webservice no modo não WSDL.  
 */
$options = array('uri' => 'http://messias.zz.mu/teste_sd.php');
$server = new SoapServer(null, $options);

/* 
 * Informamos a classe em que o webservice irá se basear.
 * Podemos usar também o método addFunction() para adicionar 
 * funções em nosso webservice. 
 */
$server->setClass('SoapServerExemplo');
/*
 * O método handle() processa a requisição SOAP e envia uma resposta 
 * para o cliente.
 */
$server->handle();

/*
 * A classe SoapServerExemplo será disponibilizada em nosso 
 * webservice. Portanto temos disponíveis no webservice os métodos 
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
<?php
include 'conecta_banco.php';
error_reporting(0);
ini_set(“display_errors”, 0 );


function back (array $remarcar, array $indiponiveis, array $solucoes, array $preferencias_dias, $preferencia_hora, $id_consulta ){

	/*
	 * Recebe lista com as consultas que devem ser remarcadas como parâmetro
	 Recebe lista de horários indisponíveis (inicialmente vazia) como parâmetro
	 Recebe lista de possíveis soluções (inicialmente vazia) como parâmetro
	 Para cada dia do período selecionado
		Para cada horário do dia
		Para cada consulta selecionada
		Se a lista de consultas que devem ser remarcadas está vazia
		Remarcar consultas baseando-se na lista de possíveis soluções
		Retorna sucesso do algoritmo
		Senão
		Para cada preferência de dia e horário do paciente relacionado à consulta
		Se preferência é igual ao dia e horário e horário não está na lista de horários indisponíveis
		Adiciona dia, horário e consulta na lista de possíveis soluções
		Retira consulta da lista de consultas que devem ser remarcadas
		Adiciona dia e horário em uma lista de horários indisponíveis
		Ocorre a recursão do algoritmo com os novos valores das listas de horários indisponíveis, consultas que devem ser remarcadas e possíveis soluções
		Se o retorno da recursão do algoritmo é sucesso
		Retorna sucesso do algoritmo
		Senão
		Retorna falha do algoritmo
		Senão
		Próxima consulta
		Próximo horário
		Próximo dia
		Retorna falha do algoritmo
		*/
	for($i=0; $i<30; $i++){
		$current_day_week = date("w", strtotime("+$i days"));//o dia da semana que estamos testando (0 para domingo até 6 para sabado)
		//echo $current_day_week;
		$current_date = date("Y-m-d", strtotime("+$i days"));
		//echo $current_date;

		for($horario=8; $horario < 19; $horario+=0.5){//horarios de um dia de trabalho = 10 hrs dia
			//print_r($remarcar);
			//echo $horario;
			if(empty($remarcar)){//condicao de saida
				//echo 'entrei';
				remarcar_consultas($solucoes);
				return;
			}
			foreach($remarcar as $key => $consulta){
				//print_r($preferencias_dias);
				//foreach($preferencias as $preferencias_dias){
				//echo "aqui";
				//print_r("aqui".$preferencias);
				if(in_array($current_day_week, $preferencias_dias) && $preferencia_hora == $horario){
					//echo 'entrei*';
					//print_r($indiponiveis);
					if(!empty($indiponiveis)){
						if(!array_key_exists($current_date, $indiponiveis)){//if que funciona
							//if abaixo é o "correto"
							//if(array_key_exists($current_date, $indiponiveis)){//existem horarios indisponeis na data atual
							//verificar se o horario desejado esta disponivel ou nao
							if(!array_key_exists($preferencia_hora, $indisponiveis[$current_date])){//checando hora inicial
								//echo 'entrei3';
								$duracao = $consulta["duracao"];
								$disponivel = true;
								for($j=0.5;  $j<$duracao; $j+=0.5){
									//print_r($indiponiveis);
									if(array_key_exists($preferencia_hora + $j, $indisponiveis[$current_date])){//checando hora inicial

										//echo 'entrei4';
										$disponivel = false;
									}
								}
								if($disponivel){
									//echo 'entrei5';
									$solucoes[$consulta["id"]] = sprintf("%s_%s_%s", $current_date, $preferencia_hora, $preferencia_hora+$duracao);
									$indiponiveis[$current_date][$horario] = 1;
									unset($remarcar[$key]);
									//print_r("aqui".$remarcar);
									back($remarcar, $indiponiveis, $solucoes, $preferencias_dias, $preferencia_hora);
								}

							}
						}
					}

				}
				//}
			}
		}
	}
}


function remarcar_consultas(array $consultas, $id_consulta) {

	foreach ($consultas as $id_consulta => $consulta){
		$dados_consulta = explode("_", $consulta);
		$data = $dados_consulta[0];
		$hora_inicio = $dados_consulta[1];
		$hora_termino = $dados_consulta[2];
		str_replace(".5", ":30", $hora_inicio);
		str_replace(".5", ":30", $hora_termino);

		//$hora_concat = $hora_termino .":00";


		$query = "update agenda set horario = '$hora_inicio', horario_termino = '$hora_termino', data= '$data' where id_agenda='$id_consulta'";

		$sql = mysql_query($query);
		if($sql){
			//reagendar_calendar($id_consulta);
			?>
<script language="javascript">
		
			window.location.href = "reagendar_consulta_validar.php?id=<?php echo $id_consulta;?>"; 
			</script>
			<?php
		}
			
		else{

			?>
<script language="javascript">
			alert("Erro Backtracking");
			
				</script>
			<?php
		}

	}
}
function backtracking ($id_consulta,array $preferencias,$hora){

	//colocando as data em um array

	//print_r($preferencias);
	//echo $id_consulta;
	//echo $hora;
	//consulta a ser remarcada vem no parametro
	$query = "select horario, horario_termino from agenda where id_agenda=$id_consulta";
	//echo $query;
	$sql = mysql_query($query);

	if($sql){

		$hora_inicio = mysql_result($sql, 0,'horario');
		$hora_termino = mysql_result($sql, 0,'horario_termino');

		str_replace(":30", ".5", $hora_inicio);
		str_replace(":30", ".5", $hora_termino);

		$duracao = $hora_termino - $hora_inicio;
		$remarcar = array(array('id' => $id_consulta,'duracao' => $duracao));


	}
	$query2 = "select * from agenda where data >= curdate()";
	$result = mysql_query($query2);
	$count = mysql_num_rows($result);
	$array_datas_indisponiveis = array();

	//preencher vetor com datas e horas indisponiveis

	if ($result){
		for ($i=0; $i<$count; $i++){
			$current_date = mysql_result($result, $i, 'data');
			//$array_datas_indisponiveis[$i] = mysql_result($result, $i, 'data');
			$hora_inicio = mysql_result($result, 0,'horario');
			$hora_termino = mysql_result($result, 0,'horario_termino');
			str_replace(":30", ".5", $hora_inicio);
			str_replace(":30", ".5", $hora_termino);

			$duracao = $hora_termino - $hora_inicio;

			for($j=0; $j<$duracao; $j+=0.5){
				$array_datas_indisponiveis[$current_date][$hora_inicio+$j] = 1;
				//print_r($array_datas_indisponiveis);
					
			}

		}
	}
	//print_r($remarcar);
	//print_r($array_datas_indisponiveis);
	//print_r($preferencias);
	back($remarcar, $array_datas_indisponiveis, array(), $preferencias, $hora, $id_consulta);





}
function compara_hora($hora_inicial, $hora_final){
	$hora_i = strtotime($hora_inicial);
	$hora_f = strtotime($hora_final);

	if($hora_f < $hora_i)
	return false;

	else
	return true;


}
function formatarData($data){
	$rData = implode("-", array_reverse(explode("/", trim($data))));
	return $rData;
}

function mostraData ($data) {
	if ($data!='') {
		return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
	}
	else { return ''; }
}
function formatar_data_contrario($d)//utilizado pelo google calendar
{
	$d1 = explode("/", $d);
	return $d1[2]."-".$d1[1]."-".$d1[0];
}


function isCNPJ($cnpj) {
	//$cnpj = "11.111.111/1111-11";
	if (preg_match('/^[0-9+\/.-]{18}$/i', $cnpj)) {
		return true;
	} else {
		return false;
	}
}

function validaCPF($cpf){
	//$cpf = "999.999.999-99";
	if (preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $cpf)){
		return true;
	} else {
		return false;
	}
}

function validaData($dat){
	$data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
	$d = $data[0];
	$m = $data[1];
	$y = $data[2];

	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 1){
		return true;
	} else {
		return false;
	}
}
function validaTelefone($tel){
	// VALIDAR TELEFONE NO SEGUINTE FORMATO: (DDD) 3333-3333
	//$tel = $telefone;
	if(!preg_match('^\(+[0-9]{2,3}\) [0-9]{4}-[0-9]{4}$^', $tel)){
		return false;
	}
	else
	return true;


}
function validaEmail($mail){
	if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $mail)) {
		return true;
	}
	else{
		return false;
	}
}

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {

	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 465 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}
function formata_data($data)
{
	//recebe o parâmetro e armazena em um array separado por -
	$data = explode('-', $data);
	//armazena na variavel data os valores do vetor data e concatena /
	$data = $data[2].'/'.$data[1].'/'.$data[0];

	//retorna a string da ordem correta, formatada
	return $data;
}
?>
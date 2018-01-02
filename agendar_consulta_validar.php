<?php

session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . 'ZendGdata-1.12.3/library/');
//set_include_path(get_include_path() . PATH_SEPARATOR . 'ZendGdata-1.12.3/library/');

require_once 'ZendGdata-1.12.3/library/Zend/Loader.php';
require_once 'ZendGdata-1.12.3/library/Zend/Gdata.php';
require_once 'ZendGdata-1.12.3/library/Zend/Exception.php';
//Zend_Loader::loadClass('Zend_Gdata');
//Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
//Zend_Loader::loadClass('Zend_Gdata_Calendar');
$classes = array('Zend_Gdata','Zend_Gdata_Query','Zend_Gdata_ClientLogin','Zend_Gdata_Calendar');
foreach($classes as $class) {
	Zend_Loader::loadClass($class);
}
//include 'GoogleCalendarWrapper.php';
//include 'mycurl.class.php';
include 'conecta_banco.php';
//include 'teste.php';
include 'funcoes.php';



//$gc = new GoogleCalendarWrapper($user, $pass);
echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
$user = 'dmessias@gmail.com';
$pass = '07364847d';

// Create an authenticated HTTP client
$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

// Create an instance of the Calendar service
$service = new Zend_Gdata_Calendar($client);

$nome_paciente = $_POST['nome_paciente'];
$_SESSION['nome_paciente'] = $nome_paciente;
$data = $_POST['calen'];
$_SESSION['data'] = $data;
$hora = $_POST['hora'];
$_SESSION['hora'] = $hora;
$hora_final = $_POST['hora_final'];
$_SESSION['hora_final'] = $hora_final;
$dentista_nome = $_POST['dentista_nome'];
$_SESSION['dentista_nome'] = $dentista_nome;
$data_hj = date('d/m/Y');

$ret = compara_hora($hora, $hora_final);

if(!$ret){
	?>
<script language="javascript">
					alert("Horário Inválido");
					window.location = 'agendar_consulta.php';
					</script>
	<?php
}

$dentista = ucfirst($dentista_nome);

if(!empty($data))
	$data_contrario = formatar_data_contrario($data);

if(!empty($dentista_nome)){
	//if($data >= $data_hj){


	if(!empty($nome_paciente)){
		$query = "select id from pacientes where nome='$nome_paciente' and controle=0";
		$sql = mysql_query($query) or die();
		$count =  mysql_num_rows($sql);
		if($count > 0){
			if($sql)
			$id_paciente = mysql_result($sql, 0, 'id');

		}

		else{
			?>
<script language="javascript">
					alert("Paciente não Encontrado");
					window.location = 'agendar_consulta.php';
					</script>
			<?php
		}




		//if (!empty($data)){//fazer verificações para data. não deixar marcar datas no passado


		if(!empty($hora)){
			//echo $hora;
			if(!empty($hora_final)){
				if(!empty($data)){
					//if($data >= $data_hj){
					$data_invertida = formatarData($data);
					$query3 = "select * from agenda where dentista_nome = '$dentista_nome' and data = '$data_invertida' ";
					//echo $query3;
					$sql3 = mysql_query($query3);
					
					if ($sql3){
						$conta = mysql_num_rows($sql3);
						
						for($i=0; $i<$conta; $i++){
							$date = mysql_result($sql3, $i, 'data');
							$h_inicio = mysql_result($sql3, $i, 'horario');
							$h_termino = mysql_result($sql3, $i, 'horario_termino');
							
							if(strtotime($date) == strtotime($data_invertida)){
								if(strtotime($hora) >= strtotime($h_inicio) && strtotime($hora) < strtotime($h_termino) 
								|| strtotime($hora_final) >= strtotime($h_inicio) && strtotime($hora_final) < strtotime($h_termino)){
									
												?>
								<script language="javascript">
								alert("Horário já Ocupado ");
								window.location = 'agendar_consulta.php';
								</script>
						<?php
							die();
							}	
								
						}
					}
					}
					
					
					$event= $service->newEventEntry();
						
					// Populate the event with the desired information
					// Note that each attribute is crated as an instance of a matching class
					$event->title = $service->newTitle($nome_paciente);
					$event->where = array($service->newWhere("Clinica MDN"));
					$event->content =
					$service->newContent('Dr.'.$dentista.'-'.$nome_paciente);


					// Set the date using RFC 3339 format.
					$startDate = $data_contrario;
					$startTime = $hora;
					$endDate = $data_contrario;
					$endTime = $hora_final;
					$tzOffset = "-03";
						
					$when = $service->newWhen();
					$when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
					$when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
					$event->when = array($when);
					// date_default_timezone_set('America/Sao_Paulo');

					// Upload the event to the calendar server
					// A copy of the event as it is recorded on the server is returned
					$newEvent = $service->insertEvent($event);
					$link = $newEvent->getId();
					$data_format = formatarData($data);
				//	echo $data_format;
					$query2 = "insert into agenda values ('', '$id_paciente', '$hora', '$hora_final','$dentista_nome','$link','$data_format')";
					//echo $query2;
					$sql2 = mysql_query($query2) or die();

					if($sql2){
						// Create a new entry using the calendar service's magic factory method

						unset($_SESSION['nome_paciente']);
						unset($_SESSION['dentista_nome']);
						unset($_SESSION['data']);
						unset($_SESSION['hora']);
						unset($_SESSION['hora_final']);
						//unset($_SESSION['dentista_nome']);
						?>
<script language="javascript">
								alert("Consulta Agendada");
								window.location = 'agendar_consulta.php';
								</script>
						<?php
					}else{
						?>
<script language="javascript">
							alert("Ocorreu um Erro (SQL)");
							window.history.go(-1);
							</script>
						<?php
					}
					/*}else{
						?>
						<script language="javascript">
						alert("Data informada Inválida");
						window.history.go(-1);
						</script>
						<?php
						}*/
				}else{
					?>
<script language="javascript">
			alert("Preencha o campo Data");
			window.location = 'agendar_consulta.php';
			</script>
					<?php
				}
			}else{
				?>
<script language="javascript">
									alert("Preencha o campo Horário Término");
									window.history.go(-1);
									</script>
				<?php
			}


		}else{
			?>
<script language="javascript">
							alert("Preencha o campo Horário Início");
							window.history.go(-1);
							</script>
			<?php
		}

		/*}else{
			?>
			<script language="javascript">
			alert("Preencha o campo Data");
			window.history.go(-1);
			</script>
			<?php
			}*/
	}else{
		?>
<script language="javascript">
							alert("Preencha o campo Nome do Paciente");
							window.history.go(-1);
							</script>
		<?php
	}



	/*else{
		?>
		<script language="javascript">
		alert("Data informada Inválida");
		window.location = 'agendar_consulta.php';
		</script>
		<?php

		}*/
}
else{
	?>
<script language="javascript">
						alert("Selecione um Dentista");
						window.location = 'agendar_consulta.php';
						</script>
	<?php
}


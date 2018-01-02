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
$id_consulta = $_GET['id'];
// Create an authenticated HTTP client
$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
$query = "select a.*, b.nome from agenda a inner join pacientes b on b.id=a.id_paciente where id_agenda = $id_consulta";
$result = mysql_query($query);

if($result){
	$data = mysql_result($result, 0,'a.data');
	$nome_paciente = mysql_result($result, 0,'b.nome');
	$dentista = mysql_result($result, 0, 'dentista_nome');
	$hora = mysql_result($result, 0, 'a.horario');
	$hora_final = mysql_result($result, 0, 'a.horario_termino');
}

if (!strpos($hora_finalo, ":"))
	$hora_final .= ":00";

$dent = ucfirst($dentista);
// Create an instance of the Calendar service
$service = new Zend_Gdata_Calendar($client);

//$data_contrario = formatar_data_contrario($data);
$data_normal = formata_data($data);
//echo $data_normal;
$data_format = formatar_data_contrario($data_normal);

$event= $service->newEventEntry();

// Populate the event with the desired information
// Note that each attribute is crated as an instance of a matching class
$event->title = $service->newTitle($nome_paciente);
$event->where = array($service->newWhere("Clinica MDN"));
$event->content =
$service->newContent('Dr.'.$dent.'-'.$nome_paciente);


// Set the date using RFC 3339 format.
//echo $data_format;
$startDate = $data_format;
$startTime = "$hora";
$endDate = $data_format;
$endTime = "$hora_final";
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

$updat = "update agenda set link='$link' where id_agenda='$id_consulta'";
$exec = mysql_query($updat);

if ($exec){
	?>
<script language="javascript">
			alert("Consulta Reagendada com Sucesso");
			window.location.href = "todas_consultas.php"; 
			</script>
	<?php
}

else{
	echo "ERRO Update";
}

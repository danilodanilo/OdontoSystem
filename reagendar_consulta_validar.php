<?php
session_start();
$id_consulta = $_GET['id'];
set_include_path(get_include_path() . PATH_SEPARATOR . 'ZendGdata-1.12.3/library/');
//set_include_path(get_include_path() . PATH_SEPARATOR . 'ZendGdata-1.12.3/library/');
error_reporting(0);
ini_set(“display_errors”, 0 );
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

echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';

$id_consulta = $_GET['id'];

$qry = "select link from agenda where id_agenda=$id_consulta";


$sql_ = mysql_query($qry) or die();

if($sql_){
	$link = mysql_result($sql_, 0,'link');
}
else{
	echo 'Erro SQL';
}
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
$user = 'dmessias@gmail.com';
$pass = '07364847d';

// Create an authenticated HTTP client
$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
 
// Create an instance of the Calendar service
$service = new Zend_Gdata_Calendar($client);
$event = $service->getCalendarEventEntry($link);

//secho $event;
/*criar uma nova coluna no BD com a URL de cada consulta inserida. A partir da URL
 * utilizar o metodo delete para excluir uma determinada consulta. Passar a URL dentro do metodo delete*/
//$service->delete('DELETE',$link);
$event->delete('DELETE', $link);
$query = "update agenda set link='' where id_agenda='$id_consulta'";
$result = mysql_query($query);
if($result){
	?>
			<script language="javascript">
			
			window.location.href = "reagendar_consulta_calendario.php?id=<?php echo $id_consulta;?>";
			</script>
<?php
}
else{
	echo "Erro SQl";
}
// 
//}

?>
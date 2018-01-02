<?php 
set_include_path(get_include_path() . PATH_SEPARATOR . 'ZendGdata-1.12.3/library/');

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
// User whose calendars you want to access
$user = 'dmessias@gmail.com';
$pass = '07364847d';
$service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
 
$client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$service);
$service = new Zend_Gdata_Calendar($client);

try{
    $listFeed = $service->getCalendarListFeed();
}
catch (Zend_Gdata_App_Exception $e){
    echo "Error: " . $e->getMessage();
}
// echo it back so you can see the id
echo "<ul>";
foreach($listFeed as $listEntry) {     echo "<li> . $listEntry->title . '(Event Feed: ' . $listEntry->id . ')'</li>";
} echo "</ul>
";
//daqui pra baixo pau




?>
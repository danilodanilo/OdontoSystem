<?

include "MyCurl.php"; //MyCurl class is required (http://a4.users.phpclasses.org/browse/package/3547.html)
include 'mycurl.class.php';

class GoogleCalendarWrapper extends MyCurl
{
  public $email;
  public $password;
  public $feed_url = "http://www.google.com/calendar/feeds/default/private/full";

  private $fAuth;
  private $isLogged = false;
  private $feed_url_prepared;
  
  function GoogleCalendarWrapper($email, $password)
  {
    $this->email = $email;
    $this->password = $password;
    $this->feed_url_prepared = $this->feed_url;
    parent::MyCurl();
  }
  
  //login with Google's technology of "ClientLogin"
  //check here: http://code.google.com/apis/accounts/AuthForInstalledApps.html
  function login()
  {
    $post_data = array();
    $post_data['Email']  = $this->email;
    $post_data['Passwd'] = $this->password;
    $post_data['source'] = "exampleCo-exampleApp-1";
    $post_data['service'] = "cl";
    $post_data['accountType'] = "GOOGLE";

    $this->getHeaders = true;
    $this->getContent = true;

    $response = $this->post("https://www.google.com/accounts/ClientLogin", $post_data, null, $http_code);

    if(200==$http_code)
    {
      $this->fAuth = parent::get_parsed($response, "Auth=");
      $this->isLogged = true;

      return 1;
    }
    $this->isLogged = false;
    return 0;
  }
  
  //to make the feed URL writable, it should be ended with "private/full"
  //check this: http://code.google.com/apis/gdata/calendar.html#get_feed
  function prepare_feed_url()
  {
    $url = parse_url($this->feed_url);
    $path = explode("/", $url["path"]);
    $size = sizeof($path);
    if($size>4)
    {
      $path[$size-1] = "full";
      $path[$size-2] = "private";
      $path = implode("/", $path);
    }
    $this->feed_url_prepared = $url["scheme"]."://".$url["host"].$path;
  }
  
  //adds new event into calendar
  //filled $settings array should be provided
  function add_event($settings)
  {
    if(!$this->isLogged)
      $this->login();
    
    if($this->isLogged)
    {
      $_entry = "<entry xmlns='http://www.w3.org/2005/Atom' xmlns:gd='http://schemas.google.com/g/2005'>
        <category scheme='http://schemas.google.com/g/2005#kind' term='http://schemas.google.com/g/2005#event'></category>
        <title type='text'>".$settings["title"]."</title>
        <content type='text'>".$settings["content"]."</content>
        <author>
          <name>".$this->email."</name>
          <email>".$this->email."</email>
        </author>
        <gd:transparency
          value='http://schemas.google.com/g/2005#event.opaque'>
        </gd:transparency>
        <gd:eventStatus
          value='http://schemas.google.com/g/2005#event.confirmed'>
        </gd:eventStatus>
        <gd:where valueString='".$settings["where"]."'></gd:where>
        <gd:when startTime='".$settings["startDay"]."T".$settings["startTime"].".000Z'
          endTime='".$settings["endDay"]."T".$settings["endTime"].".000Z'></gd:when>
      </entry>";
      
      $this->prepare_feed_url();
      
      $header = array();
      $header[] = "Host: www.google.com";
      $header[] = "MIME-Version: 1.0";
      $header[] = "Accept: text/xml";
      $header[] = "Authorization: GoogleLogin auth=".$this->fAuth;
      $header[] = "Content-length: ".strlen($_entry);
      $header[] = "Content-type: application/atom+xml";
      $header[] = "Cache-Control: no-cache";
      $header[] = "Connection: close \r\n";
      $header[] = $_entry;
      
      $this->post($this->feed_url_prepared, null, $header, $http_code);
      if(201==$http_code)
        return true;
     
    }
    else
      echo "cannot login with '".$this->email."' email and '<font color=\"lightgray\">".$this->password."</font>' password<br/>";
     return false;
  }
}

?>
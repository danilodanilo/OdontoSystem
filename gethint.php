<?php
include 'conecta_banco.php';

//get the q parameter from URL
$q=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0)
  {
  $hint="";
  $sql="Select nome from pacientes where nome like '$q%'";
  $ret_sql = mysql_query($sql);
  $count_sql = mysql_num_rows($ret_sql);
  for($i=0; $i<$count_sql; $i++)
    {
    	
    //if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
      //{
      if ($hint=="")
      {
        	$hint = mysql_result($ret_sql, $i, 'nome');
      }
      else
       {
        	$a = mysql_result($ret_sql, $i, 'nome');      	
        	$hint=$hint." , ".$a;
       }
      //}
    }
  }

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  $response="Paciente n&atilde;o encontrado";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?>
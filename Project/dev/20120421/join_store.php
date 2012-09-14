<?php

function getAbsoluteBaseURL() 
{ 
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.dirname($_SERVER['REQUEST_URI']); 
} 

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

session_start();
require 'facebook.php';
require 'credentials.php';
require 'mysql.php';
$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

db_connect();

$event_id = (isset($_GET['id'])) ? $_GET['id'] : 3; 
$user_id = (isset($_GET['uid'])) ? $_GET['uid'] : 100000246990252; 
$sql = "INSERT INTO event_participant(userid,eventid) VALUES('$user_id','$event_id')";
 $rs=mysql_query($sql);
 
$url=getAbsoluteBaseURL() . '/event.php?id='.$event_id;
$result = $facebook->api('/me/volteer:join', 'post', array('event'=> $url));
header( 'Location: event.php?id=' . $_GET['id'] ) ;
 //echo "<br>  Can redirect to the person page , which can show the list of events the user is attending .";
?>

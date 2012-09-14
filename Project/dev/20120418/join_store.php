<?php

$event_id = (isset($_GET['id'])) ? $_GET['id'] : 3; 
$user_id = (isset($_GET['uid'])) ? $_GET['uid'] : 100000246990252; 
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
$sql = "INSERT INTO event_participant(userid,eventid) VALUES('$user_id','$event_id')";
 $rs=mysql_query($sql);
header( 'Location: http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/Volteer_ram/mine/join.php' ) ;
 //echo "<br>  Can redirect to the person page , which can show the list of events the user is attending .";
?>

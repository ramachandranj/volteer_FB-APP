<?php

$a=23 ;
$u="asd";
echo $u;
$q="SELECT DISTINCT * from events WHERE location LIKE '%$u' order by date limit 3";
$location ="highland park,new jersey";
//$location=$loc['location']['name'];
  $location=explode(",",$location);
$qu="SELECT DISTINCT * from events WHERE location LIKE '%$location[0]' OR location LIKE '%$location[1]' order by date limit 3";
echo $qu;
?>
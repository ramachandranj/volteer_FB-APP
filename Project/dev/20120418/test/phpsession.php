<?php 
session_start();
	 $_SESSION['test'] = 1 ;

$var = 1;
if($var){
echo "does it ? "; }
echo $var;
?>
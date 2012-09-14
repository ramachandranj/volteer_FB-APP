<?php

include_once("../credentials.php");
include_once("../mysql.php");

db_connect();

if (!$_GET['entity']) {
	return;
}

if ($_GET['entity'] == 'person') {
	db_update_user_property($_GET['id'], $_POST['id'], stripslashes($_POST['value']));
}

print $_POST['value']; 
?>
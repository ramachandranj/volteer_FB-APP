<?php

function db_connect() {
   mysql_connect("localhost", MYSQL_USER, MYSQL_PASS) or die(mysql_error());
   //echo "Connection to the server was successful!<br/>";
 
   mysql_select_db(MYSQL_DATABASE) or die(mysql_error());
   //echo "Database was selected!<br/>";
}

function db_check_id($id) {
	$result = mysql_query("SELECT * FROM Users WHERE ID = $id");
	if(!$result) {
		// echo "Could not successfully run query from DB: " . mysql_error();
		return False;
	}
		
	if (mysql_num_rows($result) == 0) {
 	   	// echo "No rows found";
    	return False;
    }
		
	$row = mysql_fetch_assoc($result);
	echo $row['id'] . " ";
	echo $row['access_code'] . "<br/>";
	return True;
}

function db_get_users() {
	$result = mysql_query("SELECT * FROM Users");
	if(!$result) {
		// echo "Could not successfully run query from DB: " . mysql_error();
		return False;
	}
		
	if (mysql_num_rows($result) == 0) {
 	   	// echo "No rows found";
    	return False;
    }
	return $result;
}	


function db_insert_id($id, $name, $access_code) {
	$sql = "INSERT INTO Users(id, name, access_code) VALUES ('$id', '$name', '$access_code')";
	$result = mysql_query($sql);
	// Some error checking
}

function db_update_token($id, $access_code) { 
	$result = mysql_query("UPDATE Users SET access_code = '$access_code' WHERE id = '$id'");
	// Some error checking
}
	
?>

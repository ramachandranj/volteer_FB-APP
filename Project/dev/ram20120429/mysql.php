<?php

function db_connect() {
   mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
   //echo "Connection to the server was successful!<br/>";
 
   mysql_select_db("class-2012-1-16-198-675-01_bshankar") or die(mysql_error());
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
	//echo $row['id'] . " ";
	//echo $row['access_code'] . "<br/>";
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

function db_get_maxevent() {
	$result = mysql_query("SELECT events.* FROM events INNER JOIN ( SELECT MAX(eventid) AS MaxEventId FROM events) grouped_events ON events.eventid = grouped_events.MaxEventId");
	if(!$result) {
		// echo "Could not successfully run query from DB: " . mysql_error();
		return False;
	}
		
	if (mysql_num_rows($result) == 0) {
 	   	// echo "No rows found";
    	return False;
    }
	return mysql_fetch_assoc($result);
}

function db_get_next_events() {
	$result = mysql_query("SELECT * from events WHERE date > CURDATE() order by date limit 3");
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

function db_get_next_events_user($loc) {
  $location=$loc['location']['name'];
  $location=explode(",",$location);
	$result = mysql_query("SELECT DISTINCT * from events WHERE date > CURDATE() AND (location LIKE '%$location[0]%' OR location LIKE '%$location[1]%') order by date limit 3");
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

function db_getuserid($id,$eid)
{
$result=mysql_query("SELECT userid from event_participant WHERE userid='$id' and eventid='$eid'");
if(mysql_num_rows($result)==0)
return False;
else
return True;
}
?>

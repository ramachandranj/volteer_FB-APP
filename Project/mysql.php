<?php

function db_connect() {
   mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
   //echo "Connection to the server was successful!<br/>";
 
   mysql_select_db("class-2012-1-16-198-675-01_bshankar") or die(mysql_error());
   //echo "Database was selected!<br/>";
}

function db_get_event($id) {
	$result = mysql_query("SELECT * FROM events WHERE eventid = $id");
	if(!$result) {
		// echo "Could not successfully run query from DB: " . mysql_error();
		return False;
	}
		
	if (mysql_num_rows($result) == 0) {
 	   	// echo "No rows found";
    	return False;
    }
		
	$row = mysql_fetch_assoc($result);
	return $row;
}

function db_get_user_joinable_events($userid) {
	$result = mysql_query("SELECT  DISTINCT * FROM events WHERE date > CURDATE() AND (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid)");
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

function db_get_user_joinable_events_for_location($userid, $loc) {
	$result = mysql_query("SELECT  DISTINCT * FROM events WHERE date > CURDATE() AND location LIKE '%$loc%' and (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid)");
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

function db_get_user_joinable_events_for_category($userid, $category) {
	$result = mysql_query("SELECT  DISTINCT * FROM events WHERE category='$category' AND  date > CURDATE() AND (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid)");
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

function db_get_user($id) {
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
	return $row;
}

function db_get_user_events_organizing($id) {
	$result = mysql_query("select *, ADDTIME(events.date, events.time) as datetime from events where events.userid = $id order by datetime desc limit 5");
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

function db_get_user_past_events_organized($id) {
	$result = mysql_query("select *, ADDTIME(events.date, events.time) as datetime from events where events.userid = $id and ADDTIME(events.date, events.time) <= NOW() order by datetime desc limit 5");
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

function db_get_user_future_events_organizing($id) {
	$result = mysql_query("select *, ADDTIME(events.date, events.time) as datetime from events where events.userid = $id and ADDTIME(events.date, events.time) > NOW() order by datetime desc limit 5");
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

function db_get_user_events_joined($id) {
	$result = mysql_query("select events.* from event_participant join events on event_participant.eventid = events.eventid where event_participant.userid = $id order by event_participant.time desc limit 10");
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

function db_get_event_participants($eventid)
{
	$result = mysql_query("select * from Users where id in (SELECT event_participant.userid from event_participant join events on event_participant.eventid = events.eventid WHERE event_participant.eventid='$eventid' and events.userid!=event_participant.userid) limit 8");
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

function db_is_event_participant($userid, $eventid)
{
	$result = mysql_query("SELECT event_participant.userid from event_participant WHERE event_participant.eventid='$eventid' and event_participant.userid='$userid' limit 8");
	if(!$result) {
		// echo "Could not successfully run query from DB: " . mysql_error();
		return False;
	}
		
	return (mysql_num_rows($result) == 1);
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

function db_update_user_property($id, $property, $value) { 
	$result = mysql_query("UPDATE Users SET $property = '$value' WHERE id = '$id'");
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
	$result = mysql_query("SELECT * from events order by date limit 3");
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
	//$result = mysql_query("SELECT DISTINCT * from events WHERE location LIKE '%$location[0]%' OR location LIKE '%$location[1]%' order by date limit 3");
	$result = mysql_query("SELECT *, ADDTIME(events.date, events.time) as datetime FROM events WHERE ADDTIME(events.date, events.time) > NOW() and (POW(lat - {$loc['lat']},2) + POW(longi - {$loc['long']},2)) < .02 order by datetime limit 3");
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
?>

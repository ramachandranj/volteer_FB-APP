<?php

require 'facebook.php';
require 'credentials.php';
require 'mysql.php';


$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

db_connect();

$users = db_get_users();
if ($users!=False) {
	while($user = mysql_fetch_assoc($users)){
		$token =  array(
		    'access_token' => $user['access_code']
		);
	
		$friends = $facebook->api('/me/FRIENDS', 'GET', $token); // May need to iterate!
	
		$count = 0;
	
		foreach ($friends['data'] as $friend) {
			$id = $friend['id'];
			$name = $friend['name'];
						
			$checkins = $facebook->api('/' . $id . '/checkins', 'GET', $token);
			$checkin_count = 0;//count($checkins['data']);
			$friend_checkin_stats = array();
			
			foreach ($checkins['data'] as $checkin) {
				if (array_key_exists('place', $checkin) && array_key_exists('location', $checkin['place'])) {
					$location = $checkin['place']['location'];
					if ( array_key_exists('country', $location) && array_key_exists('state', $location) && array_key_exists('city', $location) ) {
						$location_text = $location['country'] . ', ' . $location['state'] . ', ' . $location['city'];
						$checkin_count++;
						
						if ( array_key_exists($location_text, $friend_checkin_stats) ) {
							$friend_checkin_stats[$location_text]++;
						}
						else {
							$friend_checkin_stats[$location_text] = 1;
						}
						//print $location_text;
					}
				}
			}
			
			if ($checkin_count > 0) {
				print "$name has $checkin_count geo-located checkins<br>";
				foreach($friend_checkin_stats as $loc=>$loc_count) {
					print $loc . ' has ' . $loc_count . ' checkins.<br>';
				}
			}
		}
	}
}

?>

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
			print "$id\n";
			$friend_object = $facebook->api('/' . $id, 'GET', $token); 
			print_r( $facebook->api('/' . $id . '/checkins', 'GET', $token) );
			if(array_key_exists('hometown', $friend_object)) {
				if (strpos($friend_object['hometown']['name'], 'New Jersey') != False) {
					$count++;
				}
			}
		}
		print "Number of friends of " . $user['name'] . " who came from NJ: $count.\n";
	}
}

?>

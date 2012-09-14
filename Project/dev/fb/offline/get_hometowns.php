<?php

require 'facebook.php';
require 'credentials.php';


$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));


$token =  array(
    'access_token' => 'AAABl9RuqZCvwBABTjCQNE8BqiAdpCPWg6p4BJY3CNXJEJZAqiOx0e426tzaWWGj786r37HtDnUhFgoZCvRxbLRYGzMbZC3nBmdRxQwTcPQZDZD'
);

//$userdata = $facebook->api('/me', 'GET', $token);
$friends = $facebook->api('/me/FRIENDS', 'GET', $token); // May need to iterate!

print_r ($friends);
$count = 0;

foreach ($friends['data'] as $friend) {
	$id = $friend['id'];
	print "$id\n";
	$friend_object = $facebook->api('/' . $id, 'GET', $token); 
	if(array_key_exists('hometown', $friend_object)) {
		if (strpos($friend_object['hometown']['name'], 'New Jersey') != False) {
			$count++;
		}
	}
}
print "Number of friends who came from NJ: $count.\n";
?>

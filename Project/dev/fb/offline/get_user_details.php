<?php

define('YOUR_APP_ID', '112103405584124');

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => YOUR_APP_ID,
  'secret' => '4343d7e696b5947682298a3d27c33053',
));

$userId = $facebook->getUser();

echo $facebook->getAccessToken();

$token = array(
	'access_token' => 'AAABl9RuqZCvwBABTjCQNE8BqiAdpCPWg6p4BJY3CNXJEJZAqiOx0e426tzaWWGj786r37HtDnUhFgoZCvRxbLRYGzMbZC3nBmdRxQwTcPQZDZD'
);

$userdata = $facebook->api('/me', 'GET', $token);
print_r ($userdata);

?>

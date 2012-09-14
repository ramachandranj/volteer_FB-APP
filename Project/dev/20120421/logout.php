<?php

require("facebook.php");
include_once("credentials.php");

$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

try
{
    //$facebook->expire_session();
	$facebook->destroySession();
	//_killFacebookCookies();
}
catch (FacebookRestClientException $e)
{
    //you'll want to catch this
    //it fails all the time
}
header( 'Location: index.php' ) ;

?>
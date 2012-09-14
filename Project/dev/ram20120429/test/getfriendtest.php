<?php

// gets user's friend ids and puts in an array . 
require 'facebook.php';
require 'credentials.php';
require 'mysql.php';

$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

$user_exist = $facebook->getUser();
if($user_exist)
$userinfo = $facebook->api('/' + $user_exist); 
$access_token = $facebook->getAccessToken();
db_connect();

$friends= $facebook->api('/me/friends?token='.$access_token.'&fields=id');
$len=count($friends['data']);
$friendlist=array($len);
//echo " count is ".$len."<br>";
for($i=1;$i<$len;$i++)
$friendlist[$i]=$friends['data'][$i-1]['id'];
//echo "<br>Friend ids are :<br>";
/*
$object = $facebook->api('/'.$friendlist[1]);
echo $object['name'];   // prints name using id .
print_r($object); 
echo "<br>";
print_r($friendlist);  */


?>
<!DOCTYPE html>
<html lang="en">
  <head></head>
  <body>
 <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '347912545229392',
          status     : true,
          cookie     : true,
          xfbml      : true,
          oauth      : true,
        });

        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
      };

      (function(d){
         var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         d.getElementsByTagName('head')[0].appendChild(js);
       }(document));
    </script>
 </body>
</html>
<?php
$eventname=$_GET['name'];
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => 347912545229392,
  'secret' => '6d852bf3d9bf5962721a217ed472d6ff',
));
$user_exist = $facebook->getUser();
if($user_exist)
$userinfo = $facebook->api('/' + $user_exist); 

$event_id = (isset($_GET['id'])) ? $_GET['id'] : 3; 
$user_id = (isset($_GET['uid'])) ? $_GET['uid'] : 100000246990252; 

$url='http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/event_detail.php?id='.$event_id;
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
$sql = "INSERT INTO event_participant(userid,eventid) VALUES('$user_id','$event_id')";
 $rs=mysql_query($sql);
 $attachment = array(
    'message' => 'has joined a volunteering event',
    'name' => $eventname,
    'link' => $url
                         );
						 
    $result = $facebook->api('/me/feed/', 'post', $attachment);
header( 'Location: http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/event_detail.php?id='.$event_id ) ;
 //echo "<br>  Can redirect to the person page , which can show the list of events the user is attending .";
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
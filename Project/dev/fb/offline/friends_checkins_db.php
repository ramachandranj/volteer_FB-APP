<?php

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
require 'facebook.php';
require 'credentials.php';
require 'mysql.php';

$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

$userId = $facebook->getUser();
db_connect();

if ($userId) { 
      $userInfo = $facebook->api('/' + $userId); 
      //echo "Welcome " . $userInfo['name'] . "<br>";
	  if (db_check_id($userId) == False) {
		 	db_insert_id($userId,  $userInfo['name'], $facebook->getAccessToken());
	  } else { // Update the access token just in case
	  		db_update_token($userId, $facebook->getAccessToken());
	  }
	  header("Location: get_friend_checkin_db.php");	
}

?>

<html>
  <body>
    <div id="fb-root"></div>
      <div class="fb-login-button" data-scope="email,user_checkins,friends_checkins,friends_status,offline_access">
        Login with Facebook
      </div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo FB_APP_ID ?>',
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

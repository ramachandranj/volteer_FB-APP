<?php

define('YOUR_APP_ID', '347912545229392');

//uses the PHP SDK.  Download from //https://github.com/facebook/php-sdk
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => 347912545229392,
  'secret' => '6d852bf3d9bf5962721a217ed472d6ff',
));
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div id="fb-root"></div>
      <div class="fb-login-button" data-scope="email,user_checkins,offline_access,user_about_me">
        Login with Facebook
      </div>
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

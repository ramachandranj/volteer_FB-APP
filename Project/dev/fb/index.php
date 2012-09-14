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

?>

<html>
  <head></head>
  <body>
    <div id="fb-root"><title>Hello</title></div>	
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo YOUR_APP_ID ?>',
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
    <?php if ($userId) { 
      $userInfo = $facebook->api('/' + $userId); ?>
      Welcome <?php echo $userInfo['name'] ?>
    <?php } else { ?>
      <div class="fb-login-button" data-scope="email,user_checkins,friends_checkins,offline_access">
        Login with Facebook
      </div>
    <?php } ?>
  </body>
</html>

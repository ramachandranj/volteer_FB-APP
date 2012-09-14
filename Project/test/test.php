<?php

require 'facebook.php';
require 'credentials.php';
require 'mysql.php';


$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));

db_connect();

$userId = $facebook->getUser();

?>

<html>
  <body>
    <?php if ($userId) { 
    $userInfo = $facebook->api('/' + $userId); 
    print "Welcome" . $userInfo['name'];
	//$token = $facebook->getAccessToken();
	$token = array(
		'access_token' => 'AAABl9RuqZCvwBAKgn22wFJPjs0lMmfiUInlEMxPpYP545qCHIiqIoyU7b1U4lVF3j66xmHX6htU5CrKlSCvy8ttvY6kkHGuNAPbQDTgZDZD'
	);
	
	print "Token this:" . $token['access_token']; 
	print "\n";
	print "bla\n";
	
	$userdata = $facebook->api('/me');
	print_r ($userdata);

	//$userPicURL = $facebook->api('/100003508208556/picture', 'GET', $token); 
	//var_dump($userPicURL);
	$users = db_get_users(); 
	if ($users!=False) {
		while($user = mysql_fetch_assoc($users)){
		?>
		<img src="<?php print("https://graph.facebook.com/{$user['id']}/picture?type=large"); ?>"> 
		<?php 
			//$token =  array(
			//	'access_token' => $user['access_code']
			//);
			//$userPicURL = $facebook->api('/' + $user['id'] + '/picture?type=large', 'GET', $facebook->getAccessToken()); 
			//$userPicURL = $facebook->api('/100003508208556/picture?type=large', 'GET', $facebook->getAccessToken()); 
			//var_dump($userPicURL);
		}
	}
	?>
    <?php } else { ?>
    <div id="fb-root"></div>
      <div class="fb-login-button" data-scope="email,user_status,user_hometown,user_location,user_birthday,user_about_me,user_checkins,friends_checkins,friends_status,friends_hometown,offline_access">
        Login with Facebook
      </div>
    <?php } ?>
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

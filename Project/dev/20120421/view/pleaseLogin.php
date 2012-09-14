<?php

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
include_once("credentials.php");
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<link href="assets/css/bootstrap_ram.css" rel="stylesheet">   
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
   <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"> 
     <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>

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

<body>
<div id="fb-root"></div>
<?php include 'view/toolbarView.php'; ?>
	
 <!-- so this is for when user is not set . -->
<div class="container">  
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <p> please log in to continue</p>
		    
        <div class="fb-login-button" data-scope="email,user_checkins,offline_access">
        Login with Facebook
      </div>
</div>
 
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
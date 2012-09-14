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
	<title>About Volteer</title>
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
	
	<div class="container">
          <div class="hero-unit">
            <h1>Who are we? </h1>
            
          </div>
		  
          <div class="well">
			It all started on a rainy day at the Sub-Sahara desert...
		  </div> <!-- of well -->
	</div> <!-- of container -->	
  </body>
</html>
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

$maxevent = db_get_maxevent()

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Volteer!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Volteer</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="join.php"> Join an event</a></li>
              <li><a href="create_event.php">Create Event</a></li>

            </ul>
			<form class="navbar-search pull-left" action="search.html" method="get">
				  <input type="text" class="search-query" placeholder="Search">
			</form>
			<ul class="nav pull-right">
			  <li class="pull-right">
<!-- inserting fb login here -->
<?php 
if ($userId){ 
	$userInfo = $facebook->api('/' + $userId); 
	if (db_check_id($userId) == False) {
		db_insert_id($userId,  $userInfo['name'], $facebook->getAccessToken());
	} else { // Update the access token just in case
		db_update_token($userId, $facebook->getAccessToken());
	}
	print "<a href=\"logged.html\">{$userInfo['name']}</a></li>";
} else { 
?>
      <div class="fb-login-button" data-scope="email,user_checkins,offline_access">
        Login with Facebook
      </div></li> 
<?php 
}  
?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
		<div id="fb-root"></div>
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Welcome to Volteer!</h1>
        <p>Volunteer with your peers, friends and family to do local good. Whether you're organizing events and looking for volunteers or looking to take part in local events in the community, Volteer is the right place for you. </p>
        <p><a href="#about" class="btn btn-info btn-large">Learn more &raquo;</a></p>
      </div>
	  
	<!-- stats section -->
	<div class="row">
		<div class="span3 btn-primary" style="border-radius: 5px">
			<p></p><center><h1>Our <br>Reach</h1></center><p></p>			
		</div>
		<div class="span3">
			<h2>50,000 Members</h2>
			<p>Already registered and what about you?</p>
			<p><a class="btn btn-primary" href="#">Join now &raquo;</a></p>
		</div>
		<div class="span3">
			<h2>1,000 Events</h2>
			<p>Are taking place</p>
			<p><a class="btn btn-primary" href="search.html">Find an Event &raquo;</a></p>
		</div>
		<div class="span3">
			<h2>40,000 Volunteers</h2>
			<p>Are looking to contribute...</p>
			<p><a class="btn btn-primary" href="search.html">Find Volunteers &raquo;</a></p>
		</div>
	</div>

	<hr>
     
	<!-- todays content + featured stuff -->	
	<div class="row-fluid">
		<div class="span12">
			<p><font style="font-size: xx-large">Here is what's happening <strong>today</strong>:</font><br></p>
			<div class="row-fluid">
				<div class="span9">
					<!-- todays content -->
					<div class="row-fluid">
						<div class="span4">
							<p><h6>Painting our Church</h6>
							<a href="event.html" class="thumbnail">
								<img src="images/church2.jpg" alt="">
							</a>
							<div class="caption">
								We're painting our beautiful Abyssinian Baptist Church on Sat, Match 30th at 10am. Sign up to...
								<p><a class="btn" href="#">Learn more &raquo;</a></p>
							</div>
						</div>
						<div class="span4">
							<p><h6>Charity book fair</h6>
							<a href="event.html" class="thumbnail">
								<img src="images/bookfair2.jpg" alt="">
							</a>
							<div class="caption">
								Come help up run the biggest book fair in union square. And it all goes to charity! The event will take place...
								<p><a class="btn" href="#">Learn more &raquo;</a></p>
							</div>
						</div>
						<div class="span4">
							<p><h6><?php ($maxevent==False) ? print("Today's event #3"): print("{$maxevent['name']}"); ?></h6>
							<a href="event.html" class="thumbnail">
								<img src="<?php ($maxevent==False) ? print("http://placehold.it/260x180") : print("picscript.php?id={$maxevent['eventid']}"); ?>" alt="">
							</a>
							<div class="caption">
								<?php ($maxevent==False) ? print("Events description <br> The event will take place..."): print("{$maxevent['descr']}"); ?>
								
								<p><a class="btn" href="#">Learn more &raquo;</a></p>
							</div>
						</div>						
						<!--<div class="span4">
							<a href="#" class="thumbnail">
								<img src="http://placehold.it/260x180" alt="">
							</a>
						</div>-->
					</div>
				</div>
				<div class="span3">
					<!-- featured content -->
					<h2>Featured content</h2>
					<div class="row-fluid">
						<div class="span12 thumbnail">
							<a href="#" class="">
								<img src="http://placehold.it/100x65" alt="" hspace="6" align="left">
							
								<div class="caption">
									<h6>Item 1</h6>
									Placeholder for featured item #1...
								</div>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12 thumbnail">
							<a href="#" class="">
								<img src="http://placehold.it/100x65" alt="" hspace="6" align="left">
							
								<div class="caption">
									<h6>Item 2</h6>
									Placeholder for featured item #2...
								</div>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12 thumbnail">
							<a href="#" class="">
								<img src="http://placehold.it/100x65" alt="" hspace="6" align="left">
							
								<div class="caption">
									<h6>Item 3</h6>
									Placeholder for featured item #3...
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<footer>
		<p>&copy; Volteer 2012</p>
	</footer>

    </div> <!-- /container -->

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












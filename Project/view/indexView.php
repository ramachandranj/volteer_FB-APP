<? php
function getAbsoluteBaseURL() 
{ 
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.dirname($_SERVER['REQUEST_URI']); 
} 

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Volteer!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta property="og:title" content="Volteer - the social volunteering website" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php print(getAbsoluteBaseURL() . '/index.php'); ?>" />
	<meta property="og:image" content="<?php print(getAbsoluteBaseURL() . '/images/Volunteers.jpg'); ?>" />
	<meta property="og:site_name" content="Volteer" />

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
	   
	   (function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=347912545229392";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
    </script>  
  
  <body>
	<div id="fb-root"></div>
	<?php include 'view/toolbarView.php'; ?>

    <div class="container">
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <div class="fb-like pull-right" data-href="<?php print(getAbsoluteBaseURL() . '/index.php'); ?>" data-send="true" data-width="450" data-show-faces="false" data-font="arial"></div>
		<h1><?php ($person == Null) ? print("Welcome to Volteer!") : print("Welcome " . $person->first_name); ?></h1>
		<p>Volunteer with your peers, friends and family to do local good. Whether you're organizing events and looking for volunteers or looking to take part in local events in the community, Volteer is the right place for you. </p>
        <p><a href="about.php" class="btn btn-info btn-large">Learn more &raquo;</a></p>
      </div>
	  
	<!-- stats section -->
	<div class="row">
		<div class="span3 btn-primary" style="border-radius: 5px">
			<p></p><center><h1>Our <br>Reach</h1></center><p></p>			
		</div>
		<div class="span3">
			<h2>50,000 Members</h2>
			<p>Already registered and what about you?</p>
			<p><a class="btn btn-primary" href="about.php">Join us &raquo;</a></p>
		</div>
		<div class="span3">
			<h2>1,000 Events</h2>
			<p>Are taking place</p>
			<p><a class="btn btn-primary" href="join.php">Join an Event &raquo;</a></p>
		</div>
		<div class="span3">
			<h2>40,000 Volunteers</h2>
			<p>Are looking to contribute...</p>
			<p><a class="btn btn-primary" href="event.php">Recruit them &raquo;</a></p>
		</div>
	</div>

	<hr>
     
	<!-- todays content + featured stuff -->	
	<div class="row-fluid">
		<div class="span12">
			
			<div class="row-fluid">
				<div class="span9">
					<!-- todays content -->
					<p><font style="font-size: x-large"> Events that are coming up <strong>soon</strong>:</font><br></p>
					<div class="row-fluid">
					<?php
						foreach($nextEvents as $event)
						{
					?>
							<div class="span4">
								<p><h6><?php print($event->name); ?></h6>
								<a href="<?php print($event->getEventURL()); ?>" class="thumbnail">
									<img src="<?php print($event->getPicURL()); ?>" alt="" > 
								</a>
								<div class="caption">
									<?php print($event->descr); ?>
									<p> Date :<?php print($event->date); ?></p>
								</div>
							</div>
					<?php 
						}  // for loop
					?>
					</div>
				</div>
				<div class="span3">
					<!-- featured content -->
					<div>
						<p><font style="font-size: x-large">Recent Activity</font><br></p>
						<div class="fb-activity" data-site="http://studentweb.comminfo.rutgers.edu" data-app-id="347912545229392" data-action="like,volteer:create,volteer:join" data-width="250" data-height="300" data-header="false" data-recommendations="true"></div>
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
  </body>
</html>












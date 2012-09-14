<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
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

  <script type="text/javascript" charset="utf-8">
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
		
		<div class="row">
            <!-- sidebar -->
			<div class="span3">
                <div style="border-right-style: solid; border-right-width: thin; border-right-color: #F2F2F2; min-height: 55em">
				    <div class="profile_photo box">
						<a href="<?php print($user->fb_link); ?>">
							<img alt="<?php print($user->name); ?>" data-size="large"  src="<?php print($user->getLargePicURL()); ?>" width="224" />
						</a>
				    </div>
                    
                    <br />
                    <p>
                        <h3>Past Events: </h3>
                        <ul>
							<?php 
								foreach ($userPastEventsOrganized as $key => $event) {
							?>
							<li>
                            <p><a href="<?php print($event->getEventURL()); ?>"><h4><?php print($event->name); ?></h4></a> </p> 
                            </li>
							<?php
								} // closing for loop	
							?>
                        </ul>
                    </p>
                </div>
			</div>
            <!-- main content -->
			<div class="span9">
                <!-- name and top part -->
				<p>
                    <h1>
						<?php print($user->name); ?>&nbsp;
					</h1>
					<a href="<?php print($user->fb_link); ?>">Facebook profile &raquo;</a>
                </p>
                
				<font style="font-size: x-large">&bdquo;</font><font style="font-size: x-large"><div id="motto" style="display: inline"><?php print($user->motto != Null ? $user->motto : "no volunteering motto yet..."); ?></div></font><font style="font-size: x-large">&rdquo;</font>
                <br />
				
				<br/>
				<p>
					Interested in volunteering with <span class="label label-important" id="category1" style="display: inline"><?php print(strlen($user->category1)>1 ? $user->category1 : 'Anyone'); ?></span>, <span class="label label-warning" id="category2" style="display: inline"><?php print(strlen($user->category2)>1 ? $user->category2 : 'Anywhere'); ?></span> and <span class="label label-success" id="category3" style="display: inline"><?php print(strlen($user->category3)>1 ? $user->category3 : 'Anytime'); ?></span>
				</p>
				<br />
				
                <!-- Organizing content -->
				<h2><?php print($user->first_name); ?> is Organizing:</h2>
				<?php 
					foreach ($userFutureEventsOrganizing as $key => $event) {
				?>
				<div class="row-fluid">
					<div class="span12 thumbnail">
						<a href="<?php print($event->getEventURL()); ?>" class="">
							<img src="<?php print($event->getPicURL()); ?>" alt="" width="100" height="65" hspace="6" align="left">					
						</a>
						<div class="caption">
							<a href="<?php print($event->getEventURL()); ?>" class="">
								<h4><?php print($event->name); ?></h4>
							</a>
							<h6><?php print($event->location . ", " . $event->date . " @" . $event->time); ?></h6>
							<?php print($event->descr); ?>
						</div>
					</div>
				</div>
				<?php
					} // closing for loop	
				?>
				
				<!-- Joined events content -->
				<h2><?php print($user->first_name); ?> has Joined:</h2>
				<?php 
					foreach ($userEventsJoined as $key => $event) {
				?>
				<div class="row-fluid">
					<div class="span12 thumbnail">
						<a href="<?php print($event->getEventURL()); ?>" class="">
							<img src="<?php print($event->getPicURL()); ?>" alt="" width="100" height="65" hspace="6" align="left">					
						</a>
						<div class="caption">
							<a href="<?php print($event->getEventURL()); ?>" class="">
								<h4><?php print($event->name); ?></h4>
							</a>
							<h6><?php print($event->location . ", " . $event->date . " @" . $event->time); ?></h6>
							<?php print($event->descr); ?>
						</div>
					</div>
				</div>
				<?php
					} // closing for loop	
				?>
				<!--<div class="fb-activity" data-site="http://studentweb.comminfo.rutgers.edu" data-app-id="347912545229392" data-action="volteer:create" data-width="300" data-height="300" data-header="false" data-recommendations="true"></div>-->
			</div>
		</div>
	
	</div> <!-- container -->
	
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

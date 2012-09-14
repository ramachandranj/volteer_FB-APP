<!DOCTYPE html>
<html>
 <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# volteer: http://ogp.me/ns/fb/volteer#">
  <meta property="fb:app_id"    content="<?php echo FB_APP_ID ?>" /> 
  <meta property="og:type"      content="volteer:event" /> 
  <meta property="og:url"       content="<?php print(getAbsoluteBaseURL() . '/event.php?id=' . $event->id); ?>" /> 
  <meta property="og:title"     content="<?php print($event->name); ?>" /> 
  <meta property="og:image"     content="<?php print(getAbsoluteBaseURL() . '/' . $event->getPicURL()); ?>" /> 
  <meta property="og:description"     content="<?php print($event->descr); ?>" /> 
  <title><?php print($event->name); ?></title>


    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .tinyimggrid {
          float: left; margin-right: 2px; margin-bottom: 2px;
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
		
		<div class="row">
            <!-- sidebar -->
			<div class="span3">
                <div style="border-right-style: solid; border-right-width: thin; border-right-color: #F2F2F2; min-height: 55em; padding-right: 40px">
				    <div class="profile_photo box">
					  <img alt="Event_ALT_TEXT" data-size="large"  src="<?php print($event->getPicURL()); ?>" width="224" />
				    </div>
                    
                    <hr />
                    <p class="clearfix"> </p>

					<p>
						Organizer 
						<div class="tinyimggrid">
                            <a href="person.php?id=<?php print($event_organizer->id); ?>"><img src="<?php print($event_organizer->getSquarePicUrl()); ?>" alt=""></a>
                        </div>
					</p>
					<p class="clearfix"> </p>
					
                    <p>
                        Participants (<?php echo count($event_participants); ?>) <!-- to get pics ,looping over each row displaying the pic. -->
                        <?php
						if ((count($event_participants) < 1) && ($is_user_a_participant == False)) {
						?>
							<p>Be the first to <a href="<?php if ($person != Null) { print($event->getUserJoinURL($person->id)); }?>">join!</a></p>
						<?php
						} else {
							foreach($event_participants as $participant)
							{
							
							?>
							<div class="tinyimggrid">
								<a href="person.php?id=<?php print($participant->id); ?>"><img src="<?php print($participant->getSquarePicUrl()); ?>" alt=""></a>
							</div>
                        <?php 
							}
						}	
						?>
                    </p>
                </div>
			</div>
            <!-- main content -->
			<div class="span9">
                <p>
                    <div class="pull-right">
						<?php 
						if ($person != Null) {
							// if the user is the organizer or participant
							if (($person->id == $event_organizer->id) || ($is_user_a_participant == True)) {
							?>
								<a class="btn btn-success"><i class="icon-ok icon-white"></i> Yep , I'm Going!</a>
							<?php
							} else {
							?>
								<a class="btn btn-primary btn-large" href="<?php print($event->getUserJoinURL($person->id)); ?>"><i class="icon-chevron-right icon-white"></i> Join!</a>
							<?php
							}
						}							
						?>
                    </div>
                    <h1><?php print($event->name); ?></h1>
                </p>
                <p class="well">
                    <b>When: </b><?php print($event->date); ?> at <b> TIME:</b><?php print($event->time); ?> <b>for </b><?php print($event->duration); ?> hrs<br /><br />
                    <b>Where: </b><?php print($event->location); ?> (<a href="<?php echo "http://maps.google.com/maps?f=q&q=".$event->location; ?>" >map</a>)<br /><br />
                    <b>Description: </b><?php print($event->descr); ?><br />
                     
                </p>
               
				<div class="fb-like" data-href="<?php print(getAbsoluteBaseURL() . '/event.php?id=' . $event->id); ?>" data-send="true" data-width="450" data-show-faces="false" data-font="arial"></div>
				<div class="fb-comments" data-href="<?php print(getAbsoluteBaseURL() . '/event.php?id=' . $event->id); ?>" data-num-posts="5"></div>
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
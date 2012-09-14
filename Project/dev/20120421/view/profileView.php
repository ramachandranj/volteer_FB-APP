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

	$(function() {
	  /*$(".editable_select").editable("model/editPerson.php?id=<?php print($person->id); ?>&entity=person", { 
		indicator : "<img src='assets/img/indicator.gif'>",
		data   : "{'Short-term': 'Short-term','Health and disability' : 'Health and disability'}",
		type   : "select",
		submit : "OK",
		style  : "inherit"
	  });*/
	  var cat_data = {'Shortterm': 'Short-term','HealthNdisability' : 'Health and disability','Animals': 'Animals','ArtsNCulture' : 'Arts and Culture','Politics': 'Politics','ChildrenNAdolescents' : 'Children and Adolescents','Fundraising' : 'Fundraising','Legal' : 'Legal aid','Office' : 'Office-based work','Olderpeople' : 'Older people','Physicalwork' : 'Physical work','SportsNrecreation' : 'Sports and recreation','Computers': 'Computers','Religion' : 'Religion','' : 'Anything', 'selected':''};
	  $(".editable_select").editable("model/editPerson.php?id=<?php print($person->id); ?>&entity=person", { 
		indicator : "<img src='assets/img/indicator.gif'>",
		data   : cat_data,    
		type   : "select",
		tooltip   : 'Click to edit...',
		submit : "OK",
		onblur : 'submit',
		callback: function(value, settings) {
			$(this).html(cat_data[value]);
		},
		style  : "inherit"
	  });   
	  $(".editable_textarea").editable("model/editPerson.php?id=<?php print($person->id); ?>&entity=person", { 
		  indicator : "<img src='assets/img/indicator.gif'>",
		  type   : 'textarea',
		  tooltip   : 'Click to edit...',
		  //submitdata: { _method: "put" },
		  select : true,
		  submit : 'OK',
		  cancel : 'cancel',
		  onblur : 'submit',
		  width : 270,
		  style : 'inherit',
		  cssclass : ''
	  });
	});
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
						<a href="">
							<img alt="<?php print($person->name); ?>" data-size="large"  src="<?php print($person->getLargePicURL()); ?>" width="224" />
						</a>
				    </div>
                    
                    <br />
                    <p>
                        <h3>Past Events: </h3>
							<?php
								if (count($personPastEventsOrganized) < 1) {
									print("never organized an event? no worries...<br/><a href=\"event.php\">start here &raquo;</a>");
								} else {
									foreach ($personPastEventsOrganized as $key => $event) {
							?>
						<ul>
							<li>
                            <p><a href="<?php print($event->getEventURL()); ?>"><h4><?php print($event->name); ?></h4></a> </p> 
                            </li>
						</ul>
							<?php
									} // closing for loop	
								} // closing of if
							?>
                    </p>
                </div>
			</div>
            <!-- main content -->
			<div class="span9">
                <!-- name and top part -->
				<p>
                    <h1>
						<?php print($person->name); ?>&nbsp;
					</h1>
					<a href="<?php print($person->fb_link); ?>">Facebook profile &raquo;</a>
				</p>
				
				<font style="font-size: x-large">&bdquo;</font><i style="font-size: x-large"><div class="editable_textarea" id="motto" style="display: inline"><?php print($person->motto != Null ? $person->motto : "your volunteering motto here"); ?></div></i><font style="font-size: x-large">&rdquo;</font>&nbsp;<i class="icon-pencil" onclick="$('#motto').click();"></i>
                <br />
				
				<br/>
				<p>
					Interested in volunteering with <span class="editable_select label label-important" id="category1" style="display: inline"><?php print($person->category1); ?></span>&nbsp;<i class="icon-pencil" onclick="$('#category1').click();"></i>, <span class="editable_select label label-warning" id="category2" style="display: inline"><?php print($person->category2); ?></span>&nbsp;<i class="icon-pencil" onclick="$('#category2').click();"></i> and <span class="editable_select label label-success" id="category3" style="display: inline"><?php print($person->category3); ?></span>&nbsp;<i class="icon-pencil" onclick="$('#category1').click();"></i>
				</p>
				<br />

				<div class="row-fluid">
					<div class="span8">
						<!-- Organizing content -->
						<h2>Your coming events:</h2>
						<?php 
							if (count($personFutureEventsOrganizing) < 1) {
								print("never organized an event? no worries... <a href=\"event.php\">start here &raquo;</a>");
							} else {
								foreach ($personFutureEventsOrganizing as $key => $event) {
						?>
						<div class="row-fluid">
							<div class="span12 thumbnail">
								<a href="<?php print($event->getEventURL()); ?>" class="">
									<img src="<?php print($event->getPicURL()); ?>" alt="" width="173" height="120" hspace="6" align="left">					
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
							} // closing if
						?>
					</div>
					<div class="span4">
						<h2>Recent Activity</h2>
						<div class="fb-activity" data-site="http://studentweb.comminfo.rutgers.edu" data-app-id="347912545229392" data-action="like,volteer:create,volteer:join" data-width="300" data-height="300" data-header="false" data-recommendations="true"></div>
					</div>
                </div>
				
				<!-- Joined events content -->
				<h2>Events joined:</h2>
				<?php 
					foreach ($personEventsJoined as $key => $event) {
				?>
				<div class="row-fluid">
					<div class="span12 thumbnail">
						<a href="<?php print($event->getEventURL()); ?>" class="">
							<img src="<?php print($event->getPicURL()); ?>" alt="" width="173" height="120" hspace="6" align="left">					
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
			</div>
		</div>
	
	</div> <!-- container -->
	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery.jeditable.js"></script>
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

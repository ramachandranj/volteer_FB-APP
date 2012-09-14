<?php 

$eventid = (isset($_GET['id'])) ? $_GET['id'] : 2; 
 
require 'facebook.php';
require 'mysql.php';
$facebook = new Facebook(array(
  'appId'  => 347912545229392,
  'secret' => '6d852bf3d9bf5962721a217ed472d6ff',
));
$user_exist = $facebook->getUser();
if($user_exist) {
$userinfo = $facebook->api('/' + $user_exist); 
	 } 
	 
db_connect();

 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Event</title>
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
              <li><a href="index_fblogin.php">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li><a href="create_events.php">Create Event</a></li>

            </ul>
			<form class="navbar-search pull-left" action="search.html" method="get">
				  <input type="text" class="search-query" placeholder="Search">
			</form>
			<ul class="nav pull-right">
			  <li class="pull-right"> <?php if($user_exist) 
			  echo "Hello ".$userinfo['name']."<br>"; 
			  //echo "User id is ".$userinfo['id'] ?>
			  </li>
			  </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	<?php 

 if (!$user_exist)
 {
 ?>
 <!-- so this is for when user is not set . -->
 <div class="container">
     
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <p> please log in to continue</p>
		    <div id="fb-root"></div>
        <div class="fb-login-button" data-scope="email,user_checkins,offline_access">
        Login with Facebook
      </div>
      </div>
 
 <?php } else
 {  
   		$sql = "SELECT * FROM events  where eventid = $eventid ";
		$rs=mysql_query($sql);
		if (mysql_num_rows($rs) == 0) 
		{
 	   	echo "<br> no rows found !!! .<br>";
		}
		
 ?>
    
	<div class="container">
		
		<div class="row">
            <!-- sidebar -->
			<div class="span3">
                <div style="border-right-style: solid; border-right-width: thin; border-right-color: #F2F2F2; min-height: 55em; padding-right: 40px">
				    <div class="profile_photo box">
					  <img alt="Event_ALT_TEXT" data-size="large"  src="<?php print("picscript.php?id={$eventid}"); ?>" width="224" />
				    </div>
                    
                    <hr />
                    <p class="clearfix"> </p>

                    <p>
                        Participants (23) <!-- to get pics , go to event participant db , loop over each row displaying the pic. -->
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <div class="tinyimggrid">
                            <a href="#"><img src="http://placehold.it/44x44" alt=""></a>
                        </div>
                        <br style="clear: both"/>
                        <a href="#">View all &raquo;</a>
                    </p>
                </div>
			</div>
            <!-- main content -->
			<div class="span9">
                <p>
                    <div class="pull-right">
						<?php $userid=$userinfo['id']; ?>
                        <a class="btn btn-info" href="<?php print("join_store.php?id={$eventid}&uid={$userid}"); ?>"><i class="icon-ok icon-white"></i> Yep , I'am Going !</a>
                    </div>
					<?php $row = mysql_fetch_assoc($rs) ;
					 ?>
                    <h1><?php echo $row['name']; ?></h1>
                </p>
                <p class="well">
                    <b>When: </b><?php echo $row['date']; ?> at <?php echo $row['time']; ?> for <?php echo $row['duration']; ?><br />
                    <b>Where: </b><?php echo $row['location']; ?> (<a href="<?php echo "http://maps.google.com/maps?f=q&q=".$row['location']; ?>" >map</a>)<br />
                    <b>Description: </b><?php echo $row['descr']; ?>
                     
                </p>
                <p>
                    <h3>Recent Activity</h3>
                    <div class="row-fluid">
			            <div class="span1"><center><a href="#" class="thumbnail"><img src="http://placehold.it/44x44" alt=""></a></center></div>
                        <div class="span11">
                            <div class="well">
                                Highfived Kasthuri on joining this event.
                            </div>
                        </div>
                    </div><br />
                    <div class="row-fluid">
			            <div class="span1"><center><a href="#" class="thumbnail"><img src="http://placehold.it/44x44" alt=""></a></center></div>
                        <div class="span11">
                            <div class="well">
                                John Smith joined this event.
                            </div>
                        </div>
                    </div><br />
                </p>
			</div>
		</div>
	
	</div> <!-- container -->
	<?php } //else ends here     ?>
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
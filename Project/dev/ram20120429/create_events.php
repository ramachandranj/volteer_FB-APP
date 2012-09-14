<?php 
	 session_start();
require 'facebook.php';
require 'credentials.php';
require 'mysql.php';
$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/val.js"></script>       

    <meta charset="utf-8">
    <title>Welcome to Volteer!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- DATE CSS style  -->
<!--   -->
<link href="assets/js/datepicker/css/datepicker.css" rel="stylesheet">  

<!-- css , jquery needed for the date picker Dl from jqueryui site  
<link type="text/css" href="assets/jqueryui/css/flick/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />	 
<script type="text/javascript" src="assets/jqueryui/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/js/jquery-ui-1.8.19.custom.min.js"></script>  -->

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
		  var userFBAccessToken  =  response.authResponse.accessToken;
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

<?php
$user_exist = $facebook->getUser();
if($user_exist) {
$userinfo = $facebook->api('/' + $user_exist); 

	 } 
	 ?>
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
              <li><a href="index.php">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="join.php">Join an Event</a></li>
              <li class="active"><a href="create_events.php">Create Event</a></li>

            </ul>
			
			<ul class="nav pull-right">
			  <li class="pull-right"> <?php if($user_exist) 
			  echo "Hello ".$userinfo['name']; ?>
			  </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<?php 
 //if(!isset($_SESSION['userid']))
 if (!$user_exist)
 {
 ?>
 <!-- so this is for when user is not set . -->
 <div class="container">
     
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <p> please log in to continue</p>
		    <div id="fb-root"></div>
        <div class="fb-login-button" data-scope="email,user_checkins,offline_access,read_stream,publish_stream">
        Login with Facebook
      </div>
      </div>
 
 <?php } else
 {  ?>
    <div class="container">
     
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Create your event</h1>
        <p> Create your event by filling in these details.</p>
        
      </div>
	
<form  method="post" enctype="multipart/form-data" action="event_store.php" class="well" id="myform" >
<!-- <input name="MAX_FILE_SIZE" value="102400" type="hidden">  -->
  <label>Event name</label>
  <input type="text" name="name1" class="span3" placeholder="enter your event name" id="eventname" rel="popover" data-content="Use action verbs such as Save, Help, Create, Support, or Stop. Make sure the title of your cause is understandable and attention-grabbing to someone who isnt familiar with the issue.">
  <span id="nameinfo" > </span>

<label>Why ?</label>
  <input type="text" name="whyn" class="span3" placeholder="enter your event goal" id="why" rel="popover" data-content="Focus on why this cause exists and what you hope to accomplish in one sentence.">  
<span id="whyinfo" > </span>

<label> When ? </label>
<input type="text"  name="when_n" class="span3"  value="03/29/12" data-date-format="mm/dd/yy" id="dp1" >
<span id="wheninfo"></span>

<label> What time ?</label>
<select id="time" name="time_n" class="span3">
				<option></option>
                <option>00:00</option>
                <option>01:00</option>
                <option>02:00</option>
                <option>03:00</option>
                <option>04:00</option>
				<option>05:00</option>
				<option>06:00</option>
				<option>07:00</option>
				<option>08:00</option>
				<option>09:00</option>
				<option>10:00</option>
				<option>11:00</option>
				<option>12:00</option>
				<option>13:00</option>
				<option>14:00</option>
				<option>15:00</option>
				<option>16:00</option>
				<option>17:00</option>
				<option>18:00</option>
				<option>19:00</option>
				<option>20:00</option>
				<option>21:00</option>
				<option>22:00</option>
				<option>23:00</option>
				
				
</select>
<span id="timeinfo" > </span>

<label>How long ?</label>
<input type="text" name="longn" class="span3" placeholder="enter your event duration" id="long" >  
<span id="longinfo" > </span>


<label> Where ?</label>
<input type="text" name="where_n" class="span3" placeholder="enter your event location" id="where" rel="popover" data-content="People tend to take interest in events that occur in their area .">
<span id="whereinfo"></span>

<label>Upload a picture </label>
  <input class="span3" name="image" id="fileinput" accept="image/*" type="file" rel="popover" data-content="Dont use a logo, post a picture that captures the meaning, purpose, or impact of your cause. When people see it, they should feel compelled to take action now!">

<label>Category </label>
<select id="select" name="select_n" class="span3">
                <option></option>
                <option>Animals</option>
                <option value="ArtsNCulture">Arts and Culture</option>
				<option>Campaign</option>
                <option>Education </option>
				<option>Environment </option>
				<option>Fundraising</option>
				<option value="HealthNdisability">Health and disablity</option>
				<option value="Olderpeople">Older People</option>
				<option value="Physicalwork">Physical work</option>
                <option>Politics</option>
				<option>Recreation</option>
				<option>Religion</option>
				</select>
<span id="selectinfo" > </span>


<label>Decription </label>
  <textarea class="input-xlarge" name="desc" id="textarea" placeholder="enter a brief description of your event" rows="3" rel="popover" data-content="Provide a quick but relevant background: what you have done, what you are trying to do, and what is at stake."> </textarea>
  
<!--
  <label class="checkbox">
    <input type="checkbox"> Check me out
  </label>   -->
<center> 
  <input type="submit" value="Submit" class="btn" name="sub" /></center>
</form>
<?php } // closing the else part of fb login here .  
?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
<script src="assets/js/datepicker/js/bootstrap-datepicker.js"></script>

<script>  
$(function ()  
{ $("#eventname").popover();  
$("#why").popover();  
$("#where").popover(); 
$("#fileinput").popover();  
$("#textarea").popover();  
 

});  
 
</script>  



  </body>
</html>


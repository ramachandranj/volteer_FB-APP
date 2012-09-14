<!DOCTYPE html>
<html lang="en">
  <head>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/val.js"></script>       

    <meta charset="utf-8">
    <title>Create a new Volunteering event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!-- DATE CSS style  -->

	<link href="assets/js/datepicker/css/datepicker.css" rel="stylesheet">

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
	$(function ()  
	{ $("#eventname").popover();  
	$("#why").popover();  
	$("#where").popover(); 
	$("#fileinput").popover();  
	$("#textarea").popover();  
	$('#dp1').datepicker();
	});  
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
     
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1>Create your event</h1>
        <p> Create your event easily by filling out this form</p>
        
      </div>
	  
	<!-- stats section -->
	
	<!--
	<form action="event_store.php">
  First name: <input type="text" name="fname" value="Mickey" /><br />
  Last name:<input type="text" name="lname" value="Mouse" /><br />
  <input type="submit" value="Submit" />
</form>
-->
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
                <option value="Shortterm">Short-term</option>
				<option value="HealthNdisability">Health and disability</option>
				<option value="Animals">Animals</option>
				<option value="ArtsNCulture">Arts &amp; Culture</option>
				<option value="Politics">Politics</option>
				<option value="ChildrenNAdolescents">Children and Adolescents</option>
				<option value="Fundraising">Fundraising </option>
				<option value="Legal">Legal aid</option>
				<option value="Office">Office-based work </option>
				<option value="Olderpeople">Older people</option>
				<option value="Physicalwork">Physical work </option>
				<option value="SportsNrecreation">Sports and recreation </option>
				<option value="Computers">Computers</option>
				<option value="Religion">Religion</option>
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



  </body>
</html>


<?php
$category=1;
$loc=-1;
if(isset($_POST['area']))
$loc=$_POST['area'];
if(isset($_GET['category'])) 
$category =$_GET['category']; 
$norows=1;

require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => 347912545229392,
  'secret' => '6d852bf3d9bf5962721a217ed472d6ff',
));
$user_exist = $facebook->getUser();
if($user_exist) {
$userinfo = $facebook->api('/' + $user_exist); 
	 } 
	mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
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
              <li class="active"><a href="join.php">Join an event</a></li>
              <li><a href="create_events.php">Create Event</a></li>

            </ul>
			
			<ul class="nav pull-right">
			  <li class="pull-right"> <?php if($user_exist) 
			  echo "Hello ".$userinfo['name']."<br>"; 
			  //echo "User locale is ".$userinfo['location'] ; ?>
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
        <div class="fb-login-button" data-scope="email,user_checkins,offline_access,read_stream,publish_stream">
        Login with Facebook
      </div>
      </div>
 
 <?php } else
 { 		$userid=$userinfo['id']; ?>
	<div class="container">
          <div class="hero-unit">
            <h1>Make a difference now </h1>
            
          </div>
		  </div>
		  
<div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
		  <p>
		  <form  method="post" enctype="multipart/form-data" action="join.php" >
				<input type="text" class="input-medium search-query" name="area" placeholder="Refine by area">
				<button type="submit" class="btn" name="area_val">Search</button></form>
		   </p>
            <ul class="nav nav-list">
			 <li class="nav-header">Categories</li>
			  <li><a href="join.php">All </a></li>
			  <li><a href="join.php?category=Animals">Animals </a></li>
			  <li><a href="join.php?category=ArtsNCulture">Arts and Culture</a></li>
			  <li><a href="join.php?category=Campaign">Campaign</a></li>
              <li><a href="join.php?category=Education ">Education</a></li>
              <li><a href="join.php?category=Environment ">Environment </a></li>
			  <li><a href="join.php?category=Fundraising">Fundraising </a></li>
			  <li><a href="join.php?category=Health ">Health </a></li>
			   <li><a href="join.php?category=Olderpeople">Older people</a></li>
			   <li><a href="join.php?category=Physicalwork">Physical work </a></li>
			   <li><a href="join.php?category=Politics">Politics</a></li>
			   <li><a href="join.php?category=Recreation">Recreation</a></li>
			   <li><a href="join.php?category=Religion">Religion</a></li>
			   
			  
			</ul> 
			</div><!--/.well -->
        </div><!--/span-->
		
		<div class="span9">
		<div class="well">
		<?php 
		if($loc==-1)    // refine by area not set by user
		{if($category==1)
		$result= mysql_query("SELECT  DISTINCT * FROM events WHERE date > CURDATE() AND (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid) " ) ;
		else
		$result= mysql_query("SELECT  DISTINCT * FROM events WHERE category='$category' AND  date > CURDATE() AND (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid) " ) ;
		}
		else   // user has typed some area , this has been sent as post to this page. , overriding -1 loc value. phew!!
		$result=mysql_query("SELECT DISTINCT * from events WHERE location LIKE '%$loc%' AND date > CURDATE() AND (userid) NOT IN (SELECT userid FROM  events where userid= $userid) AND eventid NOT IN (Select eventid from event_participant where userid=$userid) ");
		$count=1;
		if($loc==-1)
			{if($category==1) echo "<h4> Category:All </h4><br/>" ; 
			else
			echo "<h4> Category : ".$category."</h4><br/>"; }
		 else
		 echo "<h4> Area : ".$loc."</h4><br/>"; 
		if(mysql_num_rows($result)==0){   ?>
		<h4><?php echo "There are no events currently available , please check back later "; }  else { ?></h4>
		<?php
		while($row = mysql_fetch_assoc($result)) {
					
		if($count % 2 == 1) { ?>
			<div class="row-fluid">  <!-- left element -->
				<div class="span6">
					<ul class="thumbnails">
						<li class="span3">
							<div class="thumbnail">
								<a href="<?php print("event_detail.php?id={$row['eventid']}"); ?>" >
								<img src="<?php print("picscript.php?id={$row['eventid']}"); ?>" alt="" height="300"> 
								<h5>Event Name :<?php echo $row['name']; ?></h5>
								<p><?php echo $row['location'] ;?>	</p>  </a>
							</div>
						</li>
  
					</ul>
				</div>
			
			
		<?php } // if ends 
     		else { ?>	
			 <!-- right element -->
				<div class="span6">
					<ul class="thumbnails">
						<li class="span3">
							<div class="thumbnail">
								<a href="<?php print("event_detail.php?id={$row['eventid']}"); ?>" >
								<img src="<?php print("picscript.php?id={$row['eventid']}"); ?>" alt="">  
								<h5>Event Name : <?php echo $row['name']; ?></h5>
								<p>Location : <?php echo $row['location'] ;?>	</p>  </a> 
							</div>
						</li>
  
					</ul>
				</div>
			</div> <?php } //else ends 
			$count=$count+1 ; } // while ends 
			} // else of norows ends ?>	
			</div>  
		</div>	
		</div> 
		</div>
		</div>
		<?php  } // this ends php else part of the login .   ?>
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
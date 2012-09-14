    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">Volteer</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="join.php"> Join an event</a></li>
              <li><a href="event.php">Create Event</a></li>

            </ul>
			<ul class="nav pull-right">		  
<?php 
if ($person){ 
?>
			  <li class="dropdown pull-right" id="menu1">
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1">
					<?php print($person->name);?>
					<b class="caret"></b>
				  </a>
				  <ul class="dropdown-menu">
				    <li><a href="profile.php">Profile</a></li>
					<li><a href="<?php print($person->fb_logoutURL); ?>">Log Out</a></li>
				  </ul>
			  </li>
<?php
} else { 
?>
			  <li class="pull-right">
			  <div class="fb-login-button" data-scope="email,user_status,user_hometown,user_location,user_birthday,user_about_me,user_checkins,friends_checkins,friends_status,friends_hometown,read_stream,publish_stream,offline_access">
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
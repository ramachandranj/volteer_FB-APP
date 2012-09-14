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
<body>
	<div id="fb-root"></div>
    <?php include 'view/toolbarView.php'; ?>
	
	<div class="container">
          <div class="hero-unit">
            <h1>Make a difference now </h1>
            
          </div>
		  
	<div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
		    <p>
				<form  method="post" enctype="multipart/form-data" action="join.php" >
					<input type="text" class="input-small search-query" name="area" placeholder="Refine by area">
					<button type="submit" class="btn" name="area_val">Search</button>
				</form>
		    </p>
            <ul class="nav nav-list">
				<li class="nav-header">Categories</li>
				<li><a href="join.php">All</a></li>
				<li><a href="join.php?category=Shortterm">Short-term</a></li>
				<li><a href="join.php?category=HealthNdisability">Health and disability</a></li>
				<li><a href="join.php?category=Animals">Animals</a></li>
				<li><a href="join.php?category=ArtsNCulture">Arts and Culture</a></li>
				<li><a href="join.php?category=Politics">Politics</a></li>
				<li><a href="join.php?category=ChildrenNAdolescents">Children and Adolescents</a></li>
				<li><a href="join.php?category=Fundraising">Fundraising </a></li>
				<li><a href="join.php?category=Legal">Legal aid</a></li>
				<li><a href="join.php?category=Office">Office-based work </a></li>
				<li><a href="join.php?category=Olderpeople">Older people</a></li>
				<li><a href="join.php?category=Physicalwork">Physical work </a></li>
				<li><a href="join.php?category=SportsNrecreation">Sports and recreation</a></li>
				<li><a href="join.php?category=Computers">Computers</a></li>
				<li><a href="join.php?category=Religion">Religion</a></li>
			  
			</ul> 
			</div><!--/.well -->
        </div><!--/span-->
		
		<div class="span9">
		<div class="well">
		<?php 
		if(count($events)==1) 
		{ ?> 
			<h4> Looks like you have joined all the events !! </h4> 
		<?php 
		}  else { 
			print("<ul class=\"thumbnails\">");
			foreach($events as $event)
			//for($i = 0; $i < count($events); ++$i)
			{
			?>
				<li class="span3">
					<div class="thumbnail">
						<a href="<?php print($event->getEventURL()); ?>" >
						<img src="<?php print($event->getPicURL()); ?>" alt="" height="180" width="260"> 
						<h5><?php print($event->name); ?></h5></a>
						<p><?php print($event->location); ?></p>  
					</div>
				</li>
			<?php 
			}
			print("</ul>");
		}
		?>	
		</div> <!-- of well -->
		</div> <!-- of span -->	
		</div> 
		</div>
		</div>
	</div>
  </body>
</html>
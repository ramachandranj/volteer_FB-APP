<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to Volteer!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
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
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
			<form class="navbar-search pull-left" action="search.html" method="get">
				  <input type="text" class="search-query" placeholder="Search">
			</form>
			<ul class="nav pull-right">
			  <li class="pull-right"><a href="#login">Log in</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
	<i class="icon-search icon-white"></i>
	<form class="well form-horizontal">
		<label>Label name</label>
		<p>
			<font style="font-size: x-large">&bdquo;</font><i class="editable_textarea " id="paragraph_1" style="display: inline">asdf</i><font style="font-size: x-large">&bdquo;</font>&nbsp;<i class="icon-pencil" onclick="$('#paragraph_1').click();"></i>
		</p>
		<input type="text" class="span3" placeholder="Type something...">
		<span class="help-block">Example block-level help text here.</span>
		<label class="checkbox">
		<input type="checkbox"> Check me out
		</label>
		<button type="submit" class="btn">Submit</button>
	</form>
	
	<hr>

	<footer>
		<p>&copy; Company 2012</p>
	</footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
	<script src="../assets/js/jquery.jeditable.js"></script>
	<script type="text/javascript" charset="utf-8">

$(function() {
   
  $(".editable_textarea").editable("http://www.appelsiini.net/projects/jeditable/php/save.php", { 
      indicator : "<img src='../assets/img/indicator.gif'>",
      type   : 'textarea',
	  tooltip   : 'Click to edit...',
      //submitdata: { _method: "put" },
      select : true,
      submit : 'OK',
      cancel : 'cancel',
	  width : 270,
	  style : 'inherit',
	  cssclass : ''
  });
});
	</script>

  </body>
</html>
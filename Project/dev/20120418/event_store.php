<?php 
	 session_start();
		 require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => 347912545229392,
  'secret' => '6d852bf3d9bf5962721a217ed472d6ff',
));
//if(!isset($_SESSION['userid']))
//{
$user_exist = $facebook->getUser();
if($user_exist) {
$userinfo = $facebook->api('/' + $user_exist); 
//echo "name is ".$userinfo['name'];
$userid=$userinfo['id'];	
//echo "<br> aiyo user id <br>".$userid;
	} 
	 else 
	 {echo "No user does not exist<br>";}
$eventname= $_POST['name1'];
$why= $_POST['whyn'];
$when= $_POST['when_n'];
$where= $_POST['where_n'];
$timing= $_POST['time_n'];
$timing=$timing.":00";
$longn= $_POST['longn'];
//$file= $_POST['filepic'];
$select= $_POST['select_n'];
$desc= $_POST['desc'];
$mm =$when[0].$when[1];
$dd =$when[3].$when[4];
$yy =$when[6].$when[7];
$date1="20".$yy."-".$mm."-".$dd ;

// geo coding starts here. 
//$where="178 b cedar lane , highland Park , NJ 08904";
$where1=explode(",",$where);
$st=$where1[0];
$city=$where1[1];

$final="+USA&sensor=false" ;

$st1=str_replace(" ", "+", $st);
$city1=str_replace(" ", "+", $city);
$zip=str_replace(" ", "+", $where1[2]);
$add=$st1.",".$city1.",".$zip.",".$final;

echo "<br> address is : " .$add;
$var='178+b+cedar+lane,highland+park+,nj+08901,+USA&sensor=false';
//$map_data='http://maps.google.com/maps/api/geocode/json?address='.$var1;
//$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address=178+b,+cedar+lane,+highland+park,+NJ,+08904,+USA&sensor=false');
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add);

$output= json_decode($geocode);

$lat = $output->results[0]->geometry->location->lat;
$longi = $output->results[0]->geometry->location->lng;


if(!isset($_FILES['image']))
    {
    echo '<b>Please select a file</b><br>';
    }
else
    {
	echo "<b> pic is sent</b><br>";
	}
/*
echo "User id is ".$userid;
echo "the event is".$eventname;
echo "<br> why is".$why;
echo "<br> when is ".$when;
echo "<br> Add  is".$add;
echo "<br> time is".$timing;
echo "<br> duration  is".$longn;

echo "<br> select is ".$select;
echo "<br> desc is ".$desc ;   */
//echo "last line";    
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");



/*
if (isset($_FILES['image']) && $_FILES['image']['size'] > 0)
  {
 // Temporary file name stored on the server
      $tmpName  = $_FILES['image']['tmp_name'];  
       
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
	  //echo"<br> data is : $data<br>";
	  mysql_query("INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES('$eventname','$why','$where','$when','$data','$select','$desc') ");
	  

      echo "<br> ok , img shud be inserted<br>";
  }
else
  {
  //mysql_query("INSERT INTO events (name,reason,location,date,pic,category,descr) VALUES ('sweami','xxx','xxxx',null,null,null) ");
  mysql_query("INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES('$eventname','$why','$where','2012-08-09',NULL,'$select',NULL) ");
  

  echo "<br> ok , img NOT inserted<br>";
  }
 */ 
 // Temporary file name stored on the server
      $tmpName  = $_FILES['image']['tmp_name'];  
       
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
//mysql_query("INSERT INTO events(name,reason,location,date,time,duration,pic,category,descr) VALUES ('$eventname','$why','$where','$date1','$timing','$longn','$data','$select','$desc')");

 mysql_query("INSERT INTO events(userid,name,reason,location,lat,longi,date,time,duration,pic,category,descr) VALUES ('$userid','$eventname','$why','$where','$lat','$longi','$date1','$timing','$longn','$data','$select','$desc')");	

 //echo '<img  src="picscript.php" width="100" height="110">';
 

//while($row = mysql_fetch_assoc($result))
//	$output[]=$row;
	//echo $output;
/*
$i=0;
while ($i < $num) {
$name=mysql_result($result,$i,"name");
i++;
}*/

mysql_close();
?>

<!DOCTYPE html>
<html lang="en">
  <head></head>
  <body>
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

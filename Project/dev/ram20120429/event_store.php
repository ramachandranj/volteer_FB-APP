<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
      xmlns:fb="https://www.facebook.com/2008/fbml"> 
  
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# volteer: http://ogp.me/ns/fb/volteer#">
  <meta property="fb:app_id"      content="347912545229392" /> 
  <meta property="og:type"        content="volteer:event" /> 
  <meta property="og:url"         content="http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/event_store.php" /> 
  <meta property="og:title"       content="Sample Event" /> 
  <meta property="og:description" content="Some Arbitrary String" /> 
  <meta property="og:image"       content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" /> 
  <meta property="volteer:when"   content="2012-04-27T00:00:00-07:00" /> 

<?php 
session_start();
require 'facebook.php';
require 'credentials.php';
require 'mysql.php';
$facebook = new Facebook(array(
  'appId'  => FB_APP_ID,
  'secret' => FB_APP_SECRET,
));
$access_token = $facebook->getAccessToken();
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


$var='178+b+cedar+lane,highland+park+,nj+08901,+USA&sensor=false';

$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add);

$output= json_decode($geocode);

$lat = $output->results[0]->geometry->location->lat;
$longi = $output->results[0]->geometry->location->lng;


if(!isset($_FILES['image']))
    {
 //   echo '<b>Please select a file</b><br>';
    }
else
    {
//	echo "<b> pic is sent</b><br>";
	}
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");

 // Temporary file name stored on the server
      $tmpName  = $_FILES['image']['tmp_name'];  
       
      // Read the file 
      $fp      = fopen($tmpName, 'r');
      $data = fread($fp, filesize($tmpName));
      $data = addslashes($data);
      fclose($fp);
 mysql_query("INSERT INTO events(userid,name,reason,location,lat,longi,date,time,duration,pic,category,descr) VALUES ('$userid','$eventname','$why','$where','$lat','$longi','$date1','$timing','$longn','$data','$select','$desc')");	
 // getting eventid
 $result=mysql_query("SELECT eventid FROM events WHERE userid='$userid' AND name='$eventname' AND date='$date1' ");
 $row = mysql_fetch_assoc($result);
 //posting on user wall 
 $url='http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/event_detail.php?id='.$row['eventid'];
 $attachment = array(
    'message' => 'has created a volunteering event',
    'name' => $eventname,
    'link' => $url
                         );
						 
   $result = $facebook->api('/me/feed/', 'post', $attachment);
	

;
/*
$ch = curl_init();
$url="https://graph.facebook.com/me/volteer:create" ;
$post_data="event=http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/event_store.php&access_token=".$access_token;
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$result = curl_exec($ch);
if(curl_error($ch))
  {
   // echo 'error:' . curl_error($ch) . "<br/>";
  }
 
  
  curl_close ($ch); */
//echo "return code= " . $result . "<br/>";
mysql_close();
header( 'Location: http://studentweb.comminfo.rutgers.edu/class-2012-1-16-198-675-01/bshankar/volteer_ram/mine/index.php' ) ;
?>

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

<?php
$lat = $_POST['lat'];
$lon= $_POST['lon'];

$lat1=-74.437377;
$lon1=40.4878730;
$userid=100000246990252;
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
//echo "Connection to the server was successful!<br/>";
   mysql_select_db("class-2012-1-16-198-675-01_bshankar");
  
//mysql_query("INSERT INTO ram_test(ID,name) VALUES('$userID', '$name' ) ") 
//or die(mysql_error());  

//$r=mysql_query("SELECT tag,title,bus1,bus2,bus3,bus4,bus5, ( 3959 * acos( cos( radians($lon1) ) * cos( radians( lat ) ) * cos( radians( longi ) - radians($lat1) ) + sin( radians($lon1) ) * sin( radians( lat ) ) ) ) AS distance FROM routes HAVING distance < 2 ORDER BY distance LIMIT 0 , 3");
//$result = mysql_query("SELECT * FROM ram_test WHERE ID = '$userID' ");
$r1 = mysql_query("INSERT INTO coord_test(lati,loni) VALUES('$lat','$lon') ");
//$r=mysql_query("SELECT * FROM coord_test");

//$r= mysql_query("SELECT   * FROM events WHERE (userid) NOT IN (SELECT userid FROM  events where userid= $userid) " );

	if(!$r) {
		echo "Could not successfully run query from DB: " ;
		return False;
	}
		
	if (mysql_num_rows($r) == 0) 
	{
 	   	echo "No rows found";
    }
	while($row = mysql_fetch_assoc($r))
	
		$output[]=$row;
	
$testt=json_encode($output);
echo "<br>".$testt;
   
	mysql_close()

?>
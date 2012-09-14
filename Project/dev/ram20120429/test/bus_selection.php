<?php
$lon = $_POST['lat'];
$lat= $_POST['lon'];

$lat1_d=40.521984;   // 40.521984 hill  ; 40.51985931 - quad
$lon1_d=-74.462703;  //  -74.462703 hill  ; -74.43357086 - quads

$lon=-74.425614;    // -74.425614 - henders ; -74.437351 - livi stu center
$lat=40.484523;   //40.484523 - henders ;  40.523749 - livi stu ;
$continue=1;
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
//echo "Connection to the server was successful!<br/>";
   mysql_select_db("class-2012-1-16-198-675-01_bshankar");
  

$r=mysql_query("SELECT tag,title,bus1,bus2,bus3,bus4,bus5, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( longi ) - radians($lon) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM routes HAVING distance < 2 ORDER BY distance LIMIT 0 , 1");
$r1=mysql_query("SELECT tag,title,bus1,bus2,bus3,bus4,bus5, ( 3959 * acos( cos( radians($lat1_d) ) * cos( radians( lat ) ) * cos( radians( longi ) - radians($lon1_d) ) + sin( radians($lat1_d) ) * sin( radians( lat ) ) ) ) AS distance FROM routes HAVING distance < 2 ORDER BY distance LIMIT 0 , 1");
	if(!$r ) {
		echo "Could not successfully run query from DB: " ;
		return False;
	}
		
	if (mysql_num_rows($r) == 0) 
	{
 	   	echo "No rows found";
    }

$row = mysql_fetch_assoc($r);
//echo "<br> Origin bus stop <br>". $row['tag'];
$bus_ori=array();	
$bus_ori[1]=$row['bus1'];	
$bus_ori[2]=$row['bus2'];	
$bus_ori[3]=$row['bus3'];	
$bus_ori[4]=$row['bus4'];	
$bus_ori[5]=$row['bus5'];	 

$taag=$row['tag'];
$row1 = mysql_fetch_assoc($r1);
//echo "<br> Destination bus stop <br>". $row1['tag']."<br>";
$bus_des=array();
$bus_des[1]=$row1['bus1'];	
$bus_des[2]=$row1['bus2'];	
$bus_des[3]=$row1['bus3'];
$bus_des[4]=$row1['bus4'];  
$len1=count($bus_ori);
$len2=count($bus_des); 
//echo "<br>";
//print_r($bus_ori);
//echo "<br>";
//print_r($bus_des);
$ans=array();
$ans[1]=100;
// checking to see if the same bus goes to origin and destn. 
for($i=1;$i<=$len1 && $bus_ori[$i]!=null;$i=$i+1)
{
	for($j=1;$j<=$len2 && $bus_des[$j]!=null;$j=$j+1)
		{
			if( $bus_ori[$i]==$bus_des[$j])
				{
					$ans[1]=0;
					$ans[2]=$taag;
					$ans[3]=$bus_ori[$i];
					$ans[4]=$bus_des[$j];
					$continue=2;
					break 2;
				}
		}
}
//echo "<br> the ans content is <br>";
//print_r($ans);
if($continue==1)    // else i am checking for a stop match in ori and dest bus .
{
for($i=1;$i<=$len1 && $bus_ori[$i]!=null;$i=$i+1)
{
	//echo "<br>origin bus is ".$bus_ori[$i]."<br>" ;
	for($j=1;$j<=$len2 && $bus_des[$j]!=null;$j=$j+1)
	{
	
	//echo "taag :".$taag;
	//echo "bus ori tag". $bus_ori[$i].tag;
	//echo "bus des tag". $bus_des[$j].tag;	
		$result=mysql_query("select (temp2.rno-temp2.id) as stop_diff , temp2.tag from (select MIN(temp.id)as rno , temp.tag ,temp1.id from (select $bus_ori[$i].id,$bus_ori[$i].tag from $bus_ori[$i],$bus_des[$j] where $bus_ori[$i].tag=$bus_des[$j].tag and $bus_ori[$i].id > ( Select $bus_ori[$i].id from $bus_ori[$i] where $bus_ori[$i].tag='$taag'))as temp ,(Select $bus_ori[$i].id from $bus_ori[$i] where $bus_ori[$i].tag='$taag')as temp1) as temp2");
		$row = mysql_fetch_assoc($result);
		//echo "<br> Stop diff  TAG   BUS <br>".$row['stop_diff']." ".$row['tag']."  ".$bus_des[$j];
		if($row['stop_diff']!=null && $row['stop_diff'] < $ans[1])    // saving content oly if stop diff is less then prev. content value
			{ 
				$ans[1]=$row['stop_diff'] ;
				$ans[2]=$row['tag'] ;
				$ans[3]=$bus_des[$j];
				$ans[4]=$bus_ori[$i];
				$ans[5]=$taag;
			}
		//echo "<br>ans contents<br>";
		//print_r($ans);
	}
	//echo "************************************************************************************************<br>";
}  
}


//print_r($ans);
$ansarray=array();
$ansarray[0]=$ans;
$res=json_encode($ans);
//print_r($res);
$res1=json_encode($ansarray);

print_r($res1);
mysql_close();
/*
echo "************************************************************************************************<br>";
echo "<br><b><strong> FINAL ANSWER </strong></b><br>";
if($continue==2) 
echo " Catch the <b> ".$ans[4]." </b> bus at the stop <b> ".$taag." </b> and you will reach your destination" ;
if($continue==1)
echo " Catch the <b> ".$ans[4]." </b> bus at the stop <b> ".$taag." </b> then get down at <b>".$ans[2]."</b> stop and catch the <b>".$ans[3]."</b> bus ,you will reach your destination" ;
echo "<br>"; 
echo "************************************************************************************************<br>";
$url = "https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php?command=predictions&a=rutgers&r=".$ans[1]."&s=".$taag;



/*
echo "<br>".$url."<br>";
//getting the next predicted time : 
$ch = curl_init();

//curl_setopt($ch,CURLOPT_URL,"http://www.google.com");
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
//echo "<br> $result <br>";
curl_close($ch);
$op=htmlentities($result);
//print_r($op);

$bus=null;
$stop=null;

$pos=strpos($op,"routeTitle=");
for($i=0;$i<17;$i++){
$pos++;}
while($op[$pos]!="&")
{
$bus=$bus.$op[$pos];
$pos++;
}

$pos=strpos($op,"stopTitle=");
for($i=0;$i<16;$i++){
$pos++;}
while($op[$pos]!="&")
{
$stop=$stop.$op[$pos];
$pos++;
}
$pos=strpos($op,"minutes=");
$i=0;
for($i=0;$i<14;$i++){
$pos++;}
if(is_numeric($op[$pos+1]))
$min=$op[$pos].$op[$pos+1] ;
else
$min=$op[$pos] ;

echo "minutes". $min;


*/
?>
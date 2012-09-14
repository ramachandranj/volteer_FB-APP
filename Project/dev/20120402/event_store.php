<?php

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

if(!isset($_FILES['image']))
    {
    echo '<b>Please select a file</b><br>';
    }
else
    {
	echo "<b> pic is sent</b><br>";
	}


echo "the event is".$eventname;
echo "<br> why is".$why;
echo "<br> when is ".$when;
echo "<br> where is".$where;
echo "<br> time is".$timing;
echo "<br> duration  is".$longn;

echo "<br> select is ".$select;
echo "<br> desc is ".$desc ;
//echo "last line";    
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
 
//$result = mysql_query("SELECT * FROM events  ");

//$num=mysql_numrows($result);
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
	 // print_r($data);
 //mysql_query("INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES ('$eventname','$why','$where','$when',null,'$select','$desc')");
 // mysql_query("INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES ('$eventname','$why','$where','$date1','$data','$select','$desc')");
    mysql_query("INSERT INTO events(name,reason,location,date,time,duration,pic,category,descr) VALUES ('$eventname','$why','$where','$date1','$timing','$longn','$data','$select','$desc')");

	echo '<img  src="picscript.php" width="100" height="110">';
 
//echo "<b><center>Events Database Output</center></b><br><br>";
//while($row = mysql_fetch_assoc($result))
//	$output[]=$row;
	//echo $output;
/*
$i=0;
while ($i < $num) {

$name=mysql_result($result,$i,"name");
$reason=mysql_result($result,$i,"reason");
$loc=mysql_result($result,$i,"location");
$date=mysql_result($result,$i,"date");
$category=mysql_result($result,$i,"category");
//$img=mysql_result($result,$i,"image");
$desc=mysql_result($result,$i,"descr");

echo "Event name : $name <br> Reason :$reason <br>Location: $loc <br>Date: $date <br>Category : $category <br>Desc: $desc<br>";

$i++;
}

*/

mysql_close();











?>

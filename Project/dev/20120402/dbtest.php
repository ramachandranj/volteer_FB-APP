<?php
//session_start();
//if(isset($_SESSION['id']))
//echo " ID is set";
//else
//$_SESSION['id']=$_POST['userID'];

//if(isset($_SESSION['name']))
//echo " name is set";
//$_SESSION['name']=$_POST['name'];




$userID = $_POST['userID'];
$name = $_POST['name'];

//echo $userID ;
//echo "  dfgdfgdfg" ;
//echo $name ;
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
//echo "Connection to the server was successful!<br/>";
   mysql_select_db("class-2012-1-16-198-675-01_bshankar");
  
mysql_query("INSERT INTO ram_test(ID,name) VALUES('$userID', '$name' ) ") 
or die(mysql_error());  

$result = mysql_query("SELECT * FROM ram_test WHERE ID = '$userID' ");

	if(!$result) {
		echo "Could not successfully run query from DB: " ;
		return False;
	}
		
	if (mysql_num_rows($result) == 0) {
 	   	// echo "No rows found";
    }
	while($row = mysql_fetch_assoc($result))
	$output[]=$row;
$testt=json_encode($output);
echo $testt;

	mysql_close()

?>
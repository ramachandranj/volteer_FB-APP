<?php 
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
 $name="ram";
 $why="siumpl";
 $where="nj,nj";
 $when="2012-03-03";
 $select="asdasd";
 
  $query = "INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES('$name','$why','$where','$when',NULL,'$select',NULL) ";
  mysql_query($query);
   mysql_query("INSERT INTO events(name,reason,location,date,pic,category,descr) VALUES ('mairu','xxx','xxxx','2012-08-12',null,'asdasd',NULL)");

//$sql = "SELECT * FROM events WHERE name='aasha' ";
 //$result=mysql_query($sql);
 //$row = mysql_fetch_assoc($result) ;
//while($row = mysql_fetch_assoc($result))
//	$output[]=$row;
	//echo $output;
  //mysql_query("INSERT INTO events (name,reason,location,date,pic,descr) VALUES ('sweami','xxx','xxxx',null,null,null) ");
 //mysql_query("INSERT INTO ram_test(ID,name) VALUES('12', 'ain' ) ") ;
mysql_close();
 ?>
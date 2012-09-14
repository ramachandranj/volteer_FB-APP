<?php
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");
 $sql = "SELECT pic FROM events WHERE name='aasha' ";
 $result=mysql_query($sql);
 $row = mysql_fetch_assoc($result) ;
print_r (mysql_fetch_assoc($result));
 //header("Content-type: image/jpeg");
 //echo $row['pic'];
?>
<?php
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");

 $query="CREATE TRIGGER `after_insert_events`  
    AFTER INSERT ON `events` FOR EACH ROW  
    BEGIN  
        INSERT INTO event_participant (userid,eventid)  
        VALUES (NEW.userid, NEW.eventid);  
    END  " ;
$rs=mysql_query($query);

mysql_close();

?>
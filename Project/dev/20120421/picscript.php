<?php
// nothing shud be printed AT ALL . only then the image will be disp , basically the header should be the 1st thing the browser gets .
mysql_connect("localhost", "bshankar", "dMFh.EwIjx5J") or die(mysql_error());
 mysql_select_db("class-2012-1-16-198-675-01_bshankar");

 $event_id = (isset($_GET['id'])) ? $_GET['id'] : 2; 
 //header("Content-type: image/jpeg");
 //echo " hola ";
 $sql = "SELECT pic FROM events  where eventid = $event_id ";
 $rs=mysql_query($sql);
 //echo mysql_num_rows($rs);
 //header("Content-type: image/jpeg");
 //echo mysql_result($rs, 0);
$row = mysql_fetch_assoc($rs);
//print_r($row);
//echo "<center><b>  echo pic detail o/p </center></b>";
 //$data=$row['pic'];
// $data = base64_decode($data);
//var_dump(gd_info());
/*
$im = imagecreatefromstring($data);
if ($im !== false) {
echo "<br><center> success !!! </center><br>";
    header('Content-Type: image/jpeg');
    imagejpeg($im);
   // imagedestroy($im);
}
else {
    echo 'An error occurred.';
}
 */
//print_r($row);
$imagebytes = $row['pic'];
header("Content-type: image/jpeg");
echo $imagebytes;
mysql_close();
?>
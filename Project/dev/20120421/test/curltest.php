<?php 
#$url = 'https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php';
$url = "https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php?command=predictions&a=rutgers&r=a&s=scott";
$fields =     array(
        'command' => 'predictions',
        'a' => 'rutgers',
       'r'=>'lx',
      's'=>'scott'
   );
   $fields_string = http_build_query($fields);

$ch = curl_init();

//curl_setopt($ch,CURLOPT_URL,"http://www.google.com");
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0);
#curl_setopt($ch,CURLOPT_POST,count($fields));
#curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

$result = curl_exec($ch);
//echo "<br> $result <br>";
curl_close($ch);
/*
$t="111";
$t1="asd2";
if(is_numeric($t))
echo $t."is numeric<br>";
if(is_numeric($t1))
echo $t."is numeric<br>";
else
echo $t1."is not<br>";
*/

//$outxml =  $result;
//$movies = new SimpleXMLElement($outxml);
//echo $movies;

$op=htmlentities($result);
print_r($op);

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
echo "<br> Bus Route  : ".$bus ;


$pos=strpos($op,"stopTitle=");
for($i=0;$i<16;$i++){
$pos++;}
while($op[$pos]!="&")
{
$stop=$stop.$op[$pos];
$pos++;
}
echo "<br> Stop  : ".$stop ;
$pos=strpos($op,"minutes=");

$i=0;
for($i=0;$i<14;$i++){
$pos++;}
if(is_numeric($op[$pos+1]))
echo "<br> Minute(s) left :".$op[$pos].$op[$pos+1] ;
else
echo "<br> Minute(s) left :".$op[$pos] ;







?>
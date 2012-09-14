<?php 
#$url = 'https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php';
$url = "https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php?command=predictions&a=rutgers&r=a&s=scott";
$fields =     array(
        'command' => 'predictions',
        'a' => 'rutgers',
       'r'=>'a',
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
//echo "adsasdsa";

//$outxml =  $result;
//$movies = new SimpleXMLElement($outxml);
//echo $movies;
$op=htmlentities($result);
print_r($op);
//$test="<xml prediction=1";
//echo"<br> $test <br> ";
//echo 'sdfdsf';
//echo $op[1];
echo "<br> <br> string explode " ;
$delim = "<prediction";
//$rs=explode($delim, $op);
//echo $rs[0]."<br>";
//echo $rs[1];
$pos=strpos($op,"seconds");
echo  "<br>". $pos;

echo $op[431] ;







?>
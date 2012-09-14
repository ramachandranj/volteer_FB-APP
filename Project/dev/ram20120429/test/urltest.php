<?php
//https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php? //command=predictions&a=rutgers&r=wknd1&s=scott
$postdata = http_build_query(
    array(
        'command' => 'predictions',
        'a' => 'rutgers',
       'r'=>'wknd1',
      's'=>'scott'
    )
);
echo $postdata ;
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);
echo $context.'/n';
//$result = file_get_contents('https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php',  //$context);
$result = post_request('https://www.cs.rutgers.edu/lcsr/research/nextbus/feed.php',$context);  
//echo  $result;
?>
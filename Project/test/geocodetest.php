<?php
//echo 'asdasd';
$where="178 b cedar lane , highland Park , NJ 08904";
$where=explode(",",$where);
$st=$where[0];
$city=$where[1];

$final="+USA&sensor=false" ;

$st1=str_replace(" ", "+", $st);
$city1=str_replace(" ", "+", $city);
$zip=str_replace(" ", "+", $where[2]);
$add=$st1.",".$city1.",".$zip.",".$final;
//echo "<br> address is : ". $st1.",".$city1.",".$zip.",".$final;
echo "<br> address is : " .$add;


$var='178+b+cedar+lane,highland+park+,nj+08901,+USA&sensor=false';
$var1='47+c+phelps+avenue,new+brunswick,nj+08901,+USA&sensor=false';
$va='178+b+cedar+lane,Highland+park+,nj+08904,+USA&sensor=false';
//echo "<br>".$var."<br>";

//$map_data='http://maps.google.com/maps/api/geocode/json?address='.$var1;
//echo '<br>',$map_data;


//$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address=178+b,+cedar+lane,+highland+park,+NJ,+08904,+USA&sensor=false');
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add);

$output= json_decode($geocode);

$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
echo "<br>".$lat;
echo'<br>';
echo $long;
/*
$no=155;
$root='<?xml version="1.0"?>';
$root.='<user_req>';
$root.='<origin>';
$root.='<no>';
$root.=$no.'</no>';
$root.='</origin>';
$root.='</user_req>';
$fp=fopen("test.xml",'w');
$write=fwrite($fp,$root);
$test=fopen("C:\Websites\rideshare\test.xml","r");
echo 'checking0';
echo $test; 
$varr='asd';
$v='root';
$dom = new DOMDocument("1.0");

// display document in browser as plain text 
// for readability purposes
header("Content-Type: text/plain");
/*
// create root element
$root = $dom->createElement("$v");
$dom->appendChild($root);
/*
// create child element
$item1 = $dom->createElement("item1");
$root->appendChild($item1);
$item11 = $dom->createElement("item11");
$item1->appendChild($item11);
$text = $dom->createTextNode("$varr");
$item11->appendChild($text);
$item2 = $dom->createElement("item2");
$root->appendChild($item2);

//$item10 = $dom->createElement("item10");
//$item1->appendChild($item10);
// create text node
//$text = $dom->createTextNode("$varr");
//$item1->appendChild($text);

//$item20 = $dom->createElement("item20");
//$item2->appendChild($item20);
// create text node
//$text = $dom->createTextNode("pepperoni");
//$item->appendChild($text);
//$text2 = $dom->createTextNode("$v");
//$item20->appendChild($text2);
// save and display tree
/*
echo 'asd ';
 $dom->save("tasd.xml");
 
 
 echo 'aaaaaaa';
/*
 
$file = "test.xml"; 

function contents($parser, $data){ 
    echo $data; 
} 

function startTag($parser, $data){ 
    echo "<b>"; 
} 

function endTag($parser, $data){ 
    echo "</b><br />"; 
} 

$xml_parser = xml_parser_create(); 

xml_set_element_handler($xml_parser, "startTag", "endTag"); 

xml_set_character_data_handler($xml_parser, "contents"); 

$fp = fopen($file, "r"); 

$data = fread($fp, 80000); 

if(!(xml_parse($xml_parser, $data, feof($fp)))){ 
    die("Error on line " . xml_get_current_line_number($xml_parser)); 
} 

xml_parser_free($xml_parser); 

fclose($fp); */



?>
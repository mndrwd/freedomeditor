<?php

//thx to http://www.bitrepository.com/extract-content-between-two-delimiters-with-php.html
// note this code was edited slightly by B. Bosma from holland, www.freedomeditor.com
// to support htmlcomments in delimeter tags by supply a 4th parameter
function findinside($start, $end, $string, $inhtmlcomments=false, $loop=false)
{
if ($inhtmlcomments!=false){
$start="<!--".$start;
$end=$end."-->";
}
if (strstr($string, $start) && strstr($string, $end)){
$pos = strpos($string, $start);
 
$str = substr($string, $pos);
 
$str_two = substr($str, strlen($start));
 
$second_pos = strrpos($str_two, $end);
 
$str_three = substr($str_two, 0, $second_pos);
 
//$unit = trim($str_three); // remove whitespaces
 $unit=$str_three;
 
 if ($loop==false){
 return $unit;
 }else{
return findinside($start, $end,$unit, $inhtmlcomments);
}
}else{return $string;}
}

?>

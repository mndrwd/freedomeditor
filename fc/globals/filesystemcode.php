<?php
#thanks to some usercmmnts @ php.net for the default arrays
#en/decode 
if (!function_exists("filesystemcode")){

function filesystemcode($string, $arr1="a", $arr2="b") {
$c=array();
  if (isset($arr1)) {
  if (!isset(${$arr1}) || !is_array(${$arr1})){
	${$arr1} = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
	}}

	if (isset($arr2)) {
	if (!isset(${$arr2}) || !is_array(${$arr2})){
    ${$arr2} = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");}else{$b='';}
}
if (isset($a) && isset($b)){
    return str_replace($a, $b, urlencode($string));
}else{return($string);}

}
}

?>

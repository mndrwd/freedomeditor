<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */


if (!function_exists("get_hex")){
	function get_hex(
	$location,
	$extensions=array('PNG', 'png', 'Png', 'JPG', 'jpg', 'Jpg', 'JPEG', 'jpeg', 'Jpeg', 'GIF', 'gif', 'Gif'),
	$postvar="myimage",
	$getvar="imgclix"
	){
if (isset($_GET[$getvar])){
	  foreach ($extensions as $var){
	    if (file_exists($location.str_replace(array("..", ".", $var), '',  html_entity_decode($_GET[$getvar])).".".$var)){
	      if (stristr($var, 'png')){
		$im = ImageCreateFromPng($location.str_replace(array("..", ".", $var), '',  html_entity_decode($_GET[$getvar])).".".$var); 
	      }elseif (stristr($var, 'gif')){
		$im = ImageCreateFromGIF($location.str_replace(array("..", ".", $var), '',  html_entity_decode($_GET[$getvar])).".".$var); 
	      }elseif (stristr($var, 'jpg') || stristr($var, 'jpeg')){
		$im = ImageCreateFromJpeg($location.str_replace(array("..", ".", $var), '',  html_entity_decode($_GET[$getvar])).".".$var); 

}else{return FALSE;}
		  
$rgb = ImageColorAt($im, $_POST[$postvar.'_x'], $_POST[$postvar.'_y']); 
$rgb = imagecolorsforindex($im, $rgb);
$hex=sprintf('#%02X%02X%02X', $rgb['red'], $rgb['green'], $rgb['blue']);
	    break;
}}}else{return FALSE;}if (!isset($hex)|| $hex==''){ return FALSE;}return $hex;
}}
?>
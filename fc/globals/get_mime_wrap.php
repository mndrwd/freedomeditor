<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */


if (!function_exists("get_mime_wrap")){
	function get_mime_wrap($loc){
    		$dir=getcwd();
		chdir(dirname($loc));
		
	  
if (function_exists('finfo_open')){

$finfo = finfo_open(FILEINFO_MIME); // return mime type ala mimetype extension
$mime= finfo_file($finfo, basename($loc));
 finfo_close($finfo);
}elseif (function_exists('mime_content_type')){
	$mime=mime_content_type(basename($loc));
}else{chdir($dir);return false;} 
	
chdir($dir);return $mime;}
}
?>
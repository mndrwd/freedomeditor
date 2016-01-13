<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("writecache")){
  function writecache($cache, $cachefile, $cachetime=60){
    $str=false;
    $do=false;
#    echo getcwd().$cachefile;die();
    if (file_exists($cachefile)){
    if  (time() - $cachetime < filemtime($cachefile)) {
      $do=true;}}else{$do=true;}
    if ($do==true){
$fp = @fopen($cachefile, 'w');
if ($fp!==false){
$str= fwrite($fp, $cache);
 fclose($fp);
} 
    }
 return $str;
  }}

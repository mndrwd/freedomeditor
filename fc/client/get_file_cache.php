<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
#inspired by http://simonwillison.net/2003/May/5/cachingWithPHP/
	 */

if (!function_exists("get_file_cache")){
  function get_file_cache($cachefile, $cachetime=60){
// Serve from the cache if it is younger than $cachetime
    if (file_exists($cachefile)){ # && time() - $cachetime < filemtime($cachefile)) {
  if (!stristr($cachefile, ".php")){
    return  file_get_contents($cachefile);}else{ob_start();include($cachefile);return (ob_get_clean());
  }}}}

?>
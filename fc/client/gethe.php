<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
#$getheprefix=getcwd();
if (!function_exists("gethe")){
  function gethe($type, $location){
    global $getheprefix;
    if ($type=="cache"){
      if (function_exists("get_cache")){
      return get_cache($location);
      }}elseif ($type=="tmpl"){
    return get_cache($location);
    }elseif($type=="cont"){
     return  get_cache($location);
    }}}

?>
<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("get_cache")){
  function get_cache($location){
    if (function_exists("get_file_cache")){
     return get_file_cache($location);}}}


?>
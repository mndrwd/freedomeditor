<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

$scrext=".php";

include "dependencys.fc".$scrext;
	$depend["get_cache"]=false;
	$depend["get_file_cache"]=false;
	$depend["gethe"]=false;
	$depend["initcfg"]=false;
	$depend["make_object"]=false;
	$depend["writecache"]=false;
#        $depend["guilang"]=false;
#	$depend["Memcache"]=true;
	startfunct($depend);
$depend=array();


?>
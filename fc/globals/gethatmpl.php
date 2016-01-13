<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */


if (!function_exists("gethatmpl")){
  function gethatmpl($klikit, $tmpl, $path=false, $tmplext=false){
    if ($tmplext==false){
	global  $tmplext;
    }
    if ($path==false){
      $tt=$GLOBALS['__the_cwd']."/".$GLOBALS['_cfg']['folders']['templates'].$GLOBALS['_cfg']['global']['default_template']."/".$tmpl.".".$tmplext;}
	if (file_exists($tt)){  
  $bfu=file_get_contents(realpath($tt));  }else{$bfu='';}

  return $bfu;}}
?>
<?php


if (!function_exists("prepare_write")){
	function prepare_write($klikit, $_l_cssfilter){
		if (!isset($string)){$string='';}
 foreach ($klikit as $aa => $bb){ #cats
   $string.="/*cat=".trim($aa)."_*/";
   if (isset($bb) && is_array($bb)){
   foreach ($bb as $aap =>$bbp){ #eles
   $bbp=esccss(trim($bbp));
   $string.=trim($aap)."{".$bbp."}";
 }
}}
   
   return str_replace(array(";;", "*/;", "{}"), array(";", ";*/", ''), $string);
   }
}   
   
?>
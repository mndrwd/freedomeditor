<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
if (!function_exists("initcfg")){
function initcfg($thiscfg=false){
  $aa="main";
  if (is_array($thiscfg)){
  foreach ($thiscfg as $aa => $bb){
    if (isset($_GET)){
    foreach ($_GET as $aaa => $bbb){
    if (isset($thiscfg[$aa]['cnt_inp']) && $thiscfg[$aa]['cnt_inp']==html_entity_decode($aaa)){
      return $aa;}
    }}}}
    return $aa;
}
}
?>
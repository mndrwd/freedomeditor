<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
if (!function_exists("initfunction")){
function initfunction($funky, $kinky=false){
  global $___workpath,$scrext,$workpathios;
  if ($kinky!=false){
    if (!class_exists($funky)){
      if (!file_exists($___workpath.$funky.$scrext)){
	die("Couldn't load class ".$funky);
      }
      include($___workpath.$funky.$scrext);}}else{
    if (!function_exists($funky)){
      if (!file_exists($___workpath.$funky.$scrext)){
	die("Couldn't load function ".$funky);
      }
      include($___workpath.$funky.$scrext);}
    }
}}

 if (!function_exists("startfunct")){
  function startfunct($dependencys){
    foreach ($dependencys as $dependency => $type){
      initfunction($dependency, $type);
    }}
 }

?>
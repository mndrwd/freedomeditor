<?php


               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("piecele")){function piecele($arr, $ele){
    $newar=array();
    if (isset($arr[$ele])){
      $arr[$ele]=esccss($arr[$ele]);}
    if (strlen($ele)>0 && isset($arr[$ele])){
$ok=explode(";", $arr[$ele]);
 foreach ($ok as $ko){
   $owk=explode(":", $ko, 2);if (isset($owk[0]) && isset($owk[1])){ $newar[trim($owk[0])]=trim($owk[1]);}}}return str_replace(array("_dotcm_", "_brace_", "_bbrace_", "_nwln_"), array(";", "{", "}", '<br />'), $newar);}}




?>
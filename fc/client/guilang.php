<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("guilang")){function guilang($string, $__lang, $opentag, $closetag){
$delimeter="/(".$opentag.")(.*)(".$closetag.")/seiU";
preg_match_all($delimeter, $string, $matches);
if (isset ($matches) && is_array($matches[2])){
 if (isset($matches[2]) && is_array($matches[2])){
 foreach ($matches[2] as $boelieboelie){
   if (isset($boelieboelie) && isset($__lang[$boelieboelie])){
   $luciferso[]=$opentag.$boelieboelie.$closetag;
   $lucifersp[]=$opentag.$__lang[$boelieboelie].$closetag;}}if (isset($lucifersp)){
 $string=str_replace($luciferso, $lucifersp, $string);}$lucifersp='';$luciferso='';unset($lucifersp, $luciferso);}}
 return str_replace(array($opentag, $closetag), "", $string);
 #cleanup unexisting entrys
}}

?>
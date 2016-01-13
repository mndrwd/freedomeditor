<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */


if (!function_exists("repl_between")){function repl_between($inp, $replm, $openingpreg, $closingpreg, $retfirst=false, $modifiers="smiU", $retpreg=false){
    $delimeter=
      "/(".($openingpreg)
.")(.*?)(".
     ($closingpreg)
.")/".$modifiers;


  #if (strstr($openingpreg,"mainmenu")){
  #echo $delimeter;
	#die();
	#}


#    echo $inp;
@set_time_limit(100);
preg_match_all($delimeter, $inp, $matches);


#   echo "<pre>";print_r($matches);echo "<hr />";
#   die();


if (isset ($matches) && is_array($matches[2])){
 if (isset($matches[2]) && is_array($matches[2])){

if ($retpreg==true){
	return $matches;}
  #  if (strstr($openingpreg,"mainmenu")){
   #   echo $delimeter;die();
    #}

 foreach ($matches[2] as $boelieboelie){
   if ($retfirst!=false && isset($boelieboelie) && strlen($boelieboelie)>0){
return $boelieboelie;} #special ajax support
   if (isset($boelieboelie) && isset($replm[$boelieboelie])){

   $luciferso[]=$openingpreg.$boelieboelie.$closingpreg;
   $lucifersp[]=$openingpreg.$replm[$boelieboelie].$closingpreg;
}}

if (isset($lucifersp)){
 $inp=str_replace($luciferso, $lucifersp, $inp);}$lucifersp='';$luciferso='';unset($lucifersp, $luciferso);}}

$return=str_replace(array($openingpreg, $closingpreg), "", $inp);
@set_time_limit(100);
return $return;
 #cleanup unexisting entrys
}}

?>

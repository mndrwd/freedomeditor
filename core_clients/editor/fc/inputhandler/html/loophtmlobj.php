<?php
# BY BART BOSMA OUDEHORNE 7-2008
# WWW.BARTBOSMA.EU

function loophtmlobj($obj, $find, $find2=false, $find3=false, $return=false, $dullcounter=0)
{
	#if $find found, check for $find, $find2 and 3 in it
	if (is_array($obj) || is_object($obj)){
	foreach ($obj->children() as $children){
		#echo "<pre>";print_r($children);die();
		if (isset($children[$find])){
			$return[$dullcounter][$find] =$children[$find];
			if ($find2!=false && isset($children[$find2])) {
				$return[$dullcounter][$find][$find2]=$children[$find2];}elseif
				 ($find3!=false && isset($children[$find3])){
				$return[$dullcounter][$find][$find3] =$children[$find3];}
				$dullcounter++;
			}
		if (isset($children)){
			if (is_array($children) || is_object($children)){
				$return=loophtmlobj($children, $find, $find2, $find3, $return, $dullcounter);		
		#$return = array_merge_recursive($return, $arr);
		}
		}
		}}
		
#print_r($return); echo "BLA<hr />";
	return $return;
}
?>

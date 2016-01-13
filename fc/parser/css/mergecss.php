<?php
function mergecss($array1, $array2){
if (is_array($array2)){
	foreach ($array2 as $name => $arrej){
		if (is_array($arrej)){
foreach ($arrej as $ak =>$ok){
$array1[$name][$ak]=$ok;}}
}}
return $array1;
}
?>